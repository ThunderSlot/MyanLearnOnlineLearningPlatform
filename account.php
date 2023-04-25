<?php
include('header.php');

if (isset($_POST['changePassword'])) {

    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $renewpassword = $_POST['renewpassword'];

    if (strlen($newpassword) < 8) {
        echo "<script>alert('Password must contain at least 8 characters.');</script>";
    } elseif (!preg_match('/[A-Za-z]/', $newpassword)) {
        echo "<script>alert('Password must contain at least one alphabetic character.');</script>";
    } elseif (!preg_match('/\d/', $newpassword)) {
        echo "<script>alert('Password must contain at least one numeric character.);</script>";
    } elseif ($newpassword != $renewpassword) {
        echo "<script>alert('New Password does not match with confirm new password');</script>";
    } else {
        $checkPassword = "SELECT * FROM users WHERE password = md5('$password')";
        $runCheckPassword = mysqli_query($conn, $checkPassword);
        $countCheckPassword = mysqli_num_rows($runCheckPassword);

        if ($countCheckPassword < 1) {
            echo "<script>alert('Your Current Password does not match. Try Again.');</script>";
        } else {

           

            $updatePassword = "UPDATE users
                                SET
                                password = md5('$newpassword'),
                                confirmPassword = md5('$renewpassword')
                                WHERE unique_id = '{$_SESSION['unique_id']}'";

            $runUpdatePassword = mysqli_query($conn, $updatePassword);
            if ($runUpdatePassword) {
              

                echo "<script>window.alert('Password has been updated!')</script>";
                echo "<script>window.location='account.php'</script>";

               

            } else {
                echo mysqli_error($conn);
                echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
            }
        }
    }
}

if (isset($_POST['changeEmail'])) {

    $email = $_POST['email'];
    $mailPassword = $_POST['mailPassword'];

   
    
    $checkPassword = "SELECT * FROM users WHERE password = md5('$mailPassword') ";
    $runCheckPassword = mysqli_query($conn, $checkPassword);
    $countCheckPassword = mysqli_num_rows($runCheckPassword);



    if ($countCheckPassword < 1) {
        echo "<script>alert('Your Current Password does not match. Try Again.');</script>";
    } else {
       
        
        $updateEmail = "UPDATE users
                                SET
                                email = '$email'
                                WHERE unique_id = '{$_SESSION['unique_id']}'";

        $runUpdateEmail = mysqli_query($conn, $updateEmail);
        if ($runUpdateEmail) {
            echo "<script>window.alert('Email has been updated!')</script>";
            echo "<script>window.location='account.php'</script>";
        } else {
            echo mysqli_error($conn);
            echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
        }
    }
}


?>

<!DOCTYPE html>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyanLearn | Account Settings</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
    <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/videoplayer.css">

    <style>
        .shareBtn {
            height: 40px;
            width: 40px;
            line-height: 40px;
            border: 1px solid var(--color-border);
            border-radius: 50%;
            width: 46px;
            height: 46px;
            line-height: 46px;
            display: inline-block;
            font-size: 16px;
            color: var(--color-body);
            -webkit-transition: 0.3s;
            transition: 0.3s;
            text-align: center;
        }

        .edu-section-gap {
            padding: 0px 0 120px;
        }

        input[type=password],
        input[type=email] {
            width: 60% !important;
            height: 40px !important;
        }

        #password-input {
            padding-right: 50px;
        }

        #toggle-password {
            position: absolute;
            right: 0;
            top: 0;
            margin: 10px;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }

        #toggle-password:focus {
            outline: none;
        }

        .fa-eye-slash:before {
            content: "\f070";
        }

        .fa-eye:before {
            content: "\f06e";
        }
    </style>

</head>

<body class="sticky-header ">

   
        <!-- Display errors returned by checkout session -->
        

        <div class="col-md-4 col-lg-4 d-flex" style="margin: 40px 40px 10px;">
            <i class="bi bi-gear" style="margin-right: 10px; font-size: 18px;"></i>
            <h5>Account Settings</h5>

        </div>

        <div id="main-wrapper" class="main-wrapper">



            <!--=====================================-->
            <!--=     Courses Details Area Start    =-->
            <!--=====================================-->
            <section class="edu-section-gap course-details-area">
                <div class="container">
                    <div class="row row--30">
                        <div class="col-lg-12">
                            <div class="course-details-content">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Change Password</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="carriculam-tab" data-bs-toggle="tab" data-bs-target="#carriculam" type="button" role="tab" aria-controls="carriculam" aria-selected="false">Change Email</button>
                                    </li>
                                    <!-- <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor" aria-selected="false">Close Account</button>
                                    </li> -->


                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                        <div class="course-tab-content">
                                            <div class="course-overview">

                                                <!-- Change Password Form -->
                                                <form action="account.php" method="post" enctype="multipart/form-data">

                                                    <div class="row mb-3">
                                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="password" type="password" class="form-control" id="currentPassword password-input" required>
                                                            <button id="toggle-password" type="button" onclick="togglePasswordVisibility()"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                                                    </div>
                                                </form><!-- End Change Password Form -->

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                                        <div class="course-tab-content">
                                            <div class="course-curriculam">

                                                <!-- Change Email Form -->
                                                <form action="account.php" method="post" enctype="multipart/form-data">

                                                    <div class="row mb-3">
                                                        <label for="newEmail" class="col-md-4 col-lg-3 col-form-label">New Email</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="email" type="email" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                        <div class="col-md-8 col-lg-9">
                                                            <input name="mailPassword" type="password" class="form-control" id="newPassword" required>
                                                        </div>
                                                    </div>



                                                    <div>
                                                        <button type="submit" name="changeEmail" class="btn btn-primary">Change Email</button>
                                                    </div>
                                                </form><!-- End Change Email Form -->


                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                        <div class="course-tab-content">
                                            <div class="course-instructor">

                                            </div>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>





        </div>

   

    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>


    <!-- Footer Section -->
    <?php include_once "footer.php"; ?>

    <!-- JS
    ============================================ -->
    <!-- Jquery Js -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/backtotop.min.js"></script>
    <script src="assets/js/vendor/magnifypopup.min.js"></script>
    <script src="assets/js/vendor/imageloaded.min.js"></script>
    <script src="assets/js/vendor/lightbox.min.js"></script>
    <script src="assets/js/vendor/paralax.min.js"></script>
    <script src="assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="assets/js/videoplayer.js"></script>

    <!-- Strip js library -->
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        $(document).ready(function() {
            $(".play-btn").click(function() {
                $("#myModal").modal();
            });
        });
    </script>

    <script>
        function shareOnFacebook() {

            event.preventDefault();

            // Get the current page URL
            var url = window.location.href;

            // Construct the Facebook share URL
            var shareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url);

            // Open the share dialog in a new window
            window.open(shareUrl, 'Share on Facebook', 'width=600,height=400');
        }
    </script>

    <script>
        function shareOnTwitter(event) {
            // Prevent the link from navigating to the href URL
            event.preventDefault();

            // Get the current page URL and title
            var url = window.location.href;
            var title = document.title;

            // Construct the Twitter share URL
            var shareUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(url) + '&text=' + encodeURIComponent(title);

            // Open the share dialog in a new window
            window.open(shareUrl, 'Share on Twitter', 'width=600,height=400');
        }
    </script>

    <script>
        function shareOnLinkedIn(event) {
            // Prevent the link from navigating to the href URL
            event.preventDefault();

            // Get the current page URL and title
            var url = window.location.href;
            var title = document.title;

            // Construct the LinkedIn share URL
            var shareUrl = 'https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title);

            // Open the share dialog in a new window
            window.open(shareUrl, 'Share on LinkedIn', 'width=600,height=400');
        }
    </script>

    <script>
        function shareOnYouTube(event) {
            // Prevent the link from navigating to the href URL
            event.preventDefault();

            // Get the current page URL
            var url = window.location.href;

            // Construct the YouTube share URL
            var shareUrl = 'https://www.youtube.com/share?url=' + encodeURIComponent(url);

            // Open the share dialog in a new window
            window.open(shareUrl, 'Share on YouTube', 'width=600,height=400');
        }

        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password-input");
            var toggleButton = document.getElementById("toggle-password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
            } else {
                passwordInput.type = "password";
                toggleButton.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
            }
        }
    </script>



</body>


</html>