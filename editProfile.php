<?php
include('header.php');

$sql = mysqli_query($conn, "Select * From users Where unique_id = '{$_SESSION['unique_id']}'");
$arrUser = mysqli_fetch_array($sql);




if (isset($_POST['profilePicUpdate'])) {

    $maxFileSize = 5242880; // 5MB in bytes
    $ProfileImage_name = $_FILES['ProfileImage']['name'];
    $ProfileImage_temp = $_FILES['ProfileImage']['tmp_name'];
    $ProfileImage_size = $_FILES['ProfileImage']['size'];

    if ($ProfileImage_name != null || $ProfileImage_name != '') {
        list($width, $height) = getimagesize($ProfileImage_temp);
    }

    if ($ProfileImage_name == null || $ProfileImage_name == '') {
        echo "<script>window.alert('Please Profile Image.');</script>";
        echo "<script>window.location('editProfile.php');</script>";
    } elseif ($width > 800) {
        // Display an error message
        echo "<script>alert('The image width is too big. Please choose an image that is less than 800px wide.');</script>";
    } elseif ($_FILES['ProfileImage']['size'] > $maxFileSize) {
        // File size is too big
        echo "<script>alert('File size is too big (max 5MB)');</script>";
    } else {
        $imageFile = explode('.', $ProfileImage_name);
        $imageFileEnd = end($imageFile);

        $allowed_ext_img = array('jpg', 'jpeg', 'gif', 'png');


        $uniqueProfileImageName = date("Ymd") . time() . $_SESSION['unique_id'];

        $locationProfileImage = 'assets/files/' . $uniqueProfileImageName . "." . $imageFileEnd;
        if (move_uploaded_file($ProfileImage_temp, $locationProfileImage)) {

            $uploadeProfileImage = "UPDATE users
                                    set
                                    image = '$locationProfileImage'                                             
                                    WHERE unique_id='{$_SESSION['unique_id']}'";


            $sqlImageProfile = mysqli_query($conn, $uploadeProfileImage);

            if ($sqlImageProfile) {


                echo "<script>window.alert('Image Profile Has been updated!')</script>";
                echo "<script>window.location = 'editProfile.php'</script>";
            } else {
                echo mysqli_error($conn);
                echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
            }
        }
    }
}



if (isset($_POST['profilePicDelete'])) {



    $uploadeProfileImage = "UPDATE users
                            set
                            image = 'assets/images/DefaultProfile.jpg'                                             
                            WHERE unique_id='{$_SESSION['unique_id']}'";


    $sqlImageProfile = mysqli_query($conn, $uploadeProfileImage);

    if ($sqlImageProfile) {


        echo "<script>window.alert('Image Profile Has been deleted!')</script>";
        echo "<script>window.location = 'editProfile.php'</script>";
    } else {
        echo mysqli_error($conn);
        echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
    }
}

if (isset($_POST['profileUpdate'])) {

    $fullName = $_POST['userName'];
    $about = $_POST['about'];
    $job = $_POST['job'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
    $linkedin = $_POST['linkedin'];



    if (!empty($fullName)) {

        echo "<script>window.alert(" . $fullName . ")</script>";

        $updateProfile = "UPDATE users
        set
        fullName = '$fullName',                                             
        about = '$about',                                             
        job = '$job',                                             
        contact_phone = '$phone',                                             
        contact_email = '$email',                                             
        address = '$address',                                             
        twitter = '$twitter',                                             
        facebook = '$facebook',                                             
        youtube = '$youtube',                                             
        linkedin = '$linkedin'                                                     
        WHERE unique_id='{$_SESSION['unique_id']}'";


        $updateProfile = mysqli_query($conn, $updateProfile);

        if ($updateProfile) {


            echo "<script>window.alert('Your Profile Has been updated!')</script>";
            echo "<script>window.location = 'editProfile.php'</script>";
        } else {
            echo mysqli_error($conn);
            echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<script>window.alert('Your Name should not be empty!')</script>";
        echo "<script>window.location = 'editProfile.php'</script>";
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
        input[type=email],
        input[type=text] {
            width: 60% !important;
            height: 40px !important;
        }

        textarea {
            width: 60% !important;
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

        .profileCard {
            background-color: var(--color-white);
            border-radius: 10px;
            margin-top: -15%;
            padding: 20px;
            position: relative;
            box-shadow: 0px 10px 50px 0px rgba(26, 46, 85, 0.07);
        }

        .section-gap-equal {
            padding: 110px 0 !important;
        }

        @media only screen and (max-width: 1140px) {
            .profileCard {
                margin-top: -17%;
            }
        }

        @media only screen and (max-width: 930px) {
            .profileCard {
                margin-top: -20%;
            }
        }

        @media only screen and (max-width: 675px) {
            .profileCard {
                margin-top: -30%;
            }
        }

        @media only screen and (max-width: 500px) {
            .profileCard {
                margin-top: -40%;
            }

            input[type=password],
            input[type=email],
            input[type=text] {
                width: 90% !important;
                height: 40px !important;
            }

            textarea {
                width: 90% !important;
            }

        }

        @media only screen and (max-width: 325px) {
            .profileCard {
                margin-top: -70%;
            }
        }

        /*Upload Button Style*/

        .upload-btn-wrapper {
            cursor: pointer;
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btnUploadMedia {
            border: 2px solid gray !important;
            color: gray !important;
            background-color: white !important;
            padding: 8px 20px !important;
            border-radius: 8px !important;
            font-size: 14px !important;
            font-weight: bold !important;
            cursor: pointer !important;
        }

        .upload-btn-wrapper input[type=file] {
            /*   width: 0;*/
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            margin: 0 0 17px;
            box-shadow: 0px 2px 3px 0px rgb(20 47 219 / 11%);
        }

        .upload-btn-wrapper input[type=file]:active {

            color: black;
            transform: scale(0.95);
        }

        .thumb-dt {
            padding: 20px 20px 17px;
        }

        .thumb-item {
            width: 100%;
            border: 1px solid #efefef;
            text-align: center;
            border-radius: 3px;
            margin-bottom: 30px;
            background: #fff;
        }

        .thumb-item img {
            max-width: 100%;
        }



        .previewVideoBtn {
            width: 350px;
            max-width: 100%;
            color: #444;
            padding: 5px;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #555;
        }

        .previewVideoBtn::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #084cdf;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        .previewVideoBtn::file-selector-button:hover {
            background: #0d45a5;
        }

        @media (max-width: 768px) {
            .thumb-item {
                flex-direction: column;
            }

            .mediaContainer {
                display: flex;
                align-items: center;
                justify-content: center;
            }

        }

        @media (min-width: 768px) {
            .normalFontSize {
                font-size: 15px !important;
            }

        }

        .team-details-thumb .thumbnail {
            max-width: 80%;
            margin: auto;
            margin-bottom: 30px;
        }
        #search{
            border: 0px solid!important;
        }
        .search{
            border: 1px solid;
        }
    </style>

</head>

<body class="sticky-header ">




    <div class="edu-breadcrumb-area breadcrumb-style-3">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="col-md-4 col-lg-4 d-flex" style="margin: 40px 40px 10px;">

                    <h3><i class="bi bi-person-check" style="margin-right: 10px; font-size: 30px; font-weight: 600;"></i>Edit Profile</h3>

                </div>




            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1">
                <span></span>
            </li>
            <li class="shape-2 scene"><img data-depth="2" src="assets/images/shape-13.png" alt="shape"></li>
            <li class="shape-3 scene"><img data-depth="-2" src="assets/images/shape-15.png" alt="shape"></li>
            <li class="shape-4">
                <span></span>
            </li>
            <li class="shape-5 scene"><img data-depth="2" src="assets/images/shape-07.png" alt="shape"></li>
        </ul>
    </div>

    <!--=====================================-->
    <!--=        Team Area Start            =-->
    <!--=====================================-->
    <div class="edu-team-details-area section-gap-equal ">
        <div class="container profileCard col-lg-11 col-md-11 col-sm-11 col-11">
            <div class="row row--40">
                <div class="col-lg-4">
                    <div class="team-details-thumb">
                        <div class="thumbnail">
                            <img src="<?php echo $arrUser['image'] ?>" alt="team">
                        </div>
                        <ul class="social-share">
                            <li><a target="_blank" href='https://www.facebook.com/sharer/sharer.php?u=<?php echo $arrUser['facebook'] ?>' class="shareBtn"><i class="icon-facebook"></i></a></li>
                            <li><a target="_blank" href='https://twitter.com/intent/tweet?url=<?php echo $arrUser['twitter'] ?>' class="shareBtn"><i class="icon-twitter"></i></a></li>
                            <li><a target="_blank" href='https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $arrUser['linkedin'] ?>'  class="shareBtn"><i class="icon-linkedin2"></i></a></li>
                            <li><a target="_blank" href='https://www.youtube.com/share?url=<?php echo $arrUser['youtube'] ?>' class="shareBtn"><i class="icon-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="team-details-content">
                        <div class="main-info">
                            <span class="subtitle">MyanLearner</span>
                            <h3 class="title"><?php echo $arrUser['fullName'] ?></h3>
                            <span class="designation"><?php echo $arrUser['job'] ?></span>
                            <ul class="team-meta">
                                <!-- <li><i class="icon-25"></i>20 Course</li> -->

                            </ul>
                        </div>
                        <div class="bio-describe">
                            <h4 class="title">About Me</h4>
                            <p><?php echo $arrUser['about'] ?></p>
                        </div>
                        <div class="contact-info">
                            <h4 class="title">Contact Me</h4>
                            <ul>
                                <li><span>Address:</span><?php echo $arrUser['address'] ?></li>
                                <li><span>Email:</span><a href="mailto:<?php echo $arrUser['contact_email'] ?>" target="_blank"><?php echo $arrUser['contact_email'] ?></a></li>
                                <li><span>Phone:</span><a href="tel:<?php echo $arrUser['contact_phone'] ?>"><?php echo $arrUser['contact_phone'] ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            <div class="col-lg-3 col-md-4 col-sm-10 col-10">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Change Profile</button>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="course-tab-content">
                                        <div class="course-overview">

                                            <!-- Profile Edit Form -->
                                            <form class="container col-11 col-md-11 col-sm-11 col-lg-11" action="editProfile.php" method="post" enctype="multipart/form-data">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">

                                                            <div class="row mt-30">
                                                                <div class="col-lg-8 col-md-11 col-sm-8 sol-8">

                                                                    <label><b>Profile Image </b></label>

                                                                    <div class="thumb-item d-flex">

                                                                        <div class="col-lg-4 col-md-5 ">
                                                                            <div class="mediaContainer">
                                                                                <?php

                                                                                echo "<img src=" . $arrUser['image'] . " alt='Thumbnail Profile' id='preview'>";


                                                                                ?>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-lg-8 col-md-5 ">
                                                                            <div class="p-3 text-muted normalFontSize">
                                                                                For Profile Picture, Upload here.
                                                                                It
                                                                                must meet our image quality
                                                                                standards to be accepted. Important
                                                                                guidelines: .jpg, .jpeg,. gif, or
                                                                                .png. File size max : 5MB
                                                                                no text on the image.</div>


                                                                            <div class="upload-btn-wrapper">
                                                                                <button class="btnUploadMedia" type="button" style="">Upload
                                                                                    Profile Image</button>
                                                                                <input type="file" name="ProfileImage" id="PreviewImage" onchange="previewImage();">
                                                                            </div>

                                                                        </div>




                                                                        <!-- Preview image function -->

                                                                        <script type="text/javascript">
                                                                            function previewImage() {
                                                                                var file = document.getElementById("PreviewImage").files;

                                                                                if (file.length > 0) {

                                                                                    var fileReader = new FileReader();

                                                                                    fileReader.onload = function(event) {

                                                                                        var fileInputImg = document.getElementById('PreviewImage');
                                                                                        var filePathImg = fileInputImg.value;

                                                                                        // Allowing file type
                                                                                        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

                                                                                        if (!allowedExtensions.exec(filePathImg)) {
                                                                                            alert('Invalid file type');
                                                                                            fileInputImg.value = '';
                                                                                            return false;
                                                                                        } else {
                                                                                            document.getElementById("preview").setAttribute("src", event.target.result);
                                                                                        }

                                                                                    };

                                                                                    fileReader.readAsDataURL(file[0]);

                                                                                } else {
                                                                                    window.alert('Image file size is zero. Please choose another image file!');
                                                                                }
                                                                            }
                                                                        </script>

                                                                    </div>


                                                                </div>

                                                                <div style="margin-top: 20px; margin-bottom:20px;">
                                                                    <button type="submit" name="profilePicUpdate" class="btn btn-warning" style="font-size: 15px;padding: 10px;">Update</button>
                                                                    <button type="submit" name="profilePicDelete" class="btn btn-danger" style="font-size: 15px;padding: 10px;">Delete</button>
                                                                </div>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                            <form class="container col-11 col-md-11 col-sm-11 col-lg-11" action="editProfile.php" method="post" enctype="multipart/form-data">


                                                <div class="row mb-3">
                                                    <label for="userName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="userName" type="text" class="form-control" id="userName" placeholder="Mr.Ryan" value="<?php echo $arrUser['fullName'] ?>">

                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <textarea name="about" class="form-control" id="about" style="height: 100px" placeholder="Your brief biography"><?php echo $arrUser['about'] ?> </textarea>
                                                    </div>
                                                </div>


                                                <div class="row mb-3">
                                                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="job" type="text" class="form-control" id="Job" placeholder="Web Designer" value="<?php echo $arrUser['job'] ?>">
                                                    </div>
                                                </div>



                                                <div class="row mb-3">
                                                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="address" type="text" class="form-control" id="Address" placeholder="A108 Adam Street, New York, NY 535022" value="<?php echo $arrUser['address'] ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Contact
                                                        Phone</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="phone" type="text" class="form-control" id="Phone" placeholder="(436) 486-3538 x29071" value="<?php echo $arrUser['contact_phone'] ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Contact
                                                        Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="email" type="email" class="form-control" id="Email" placeholder="k.anderson@example.com" value="<?php echo $arrUser['contact_email'] ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="twitter" type="text" class="form-control" id="Twitter" placeholder="https://twitter.com/#" value="<?php echo $arrUser['twitter'] ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="facebook" type="text" class="form-control" id="Facebook" placeholder="https://facebook.com/#" value="<?php echo $arrUser['facebook'] ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Youtube" class="col-md-4 col-lg-3 col-form-label">Youtube
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="youtube" type="text" class="form-control" id="Youtube" placeholder="https://www.youtube.com/@" value="<?php echo $arrUser['youtube'] ?>">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin
                                                        Profile</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input name="linkedin" type="text" class="form-control" id="Linkedin" placeholder="https://linkedin.com/#" value="<?php echo $arrUser['linkedin'] ?>">
                                                    </div>
                                                </div>

                                                <div style="margin-top: 20px;">
                                                    <button type="submit" name="profileUpdate" class="btn btn-primary" style="font-size: 15px;padding: 10px;">Save Changes</button>
                                                </div>
                                            </form>
                                            <!-- End Profile Edit Form -->


                                        </div>
                                    </div>
                                </div>



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

    



</body>


</html>