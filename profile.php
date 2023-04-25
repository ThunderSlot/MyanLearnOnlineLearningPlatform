<?php
include('header.php');



if (isset($_GET['unique_id'])) {
    $uniqueId = $_GET['unique_id'];

    $sql = mysqli_query($conn, "Select * From users Where unique_id = '{$uniqueId}'");
    $arrUser = mysqli_fetch_array($sql);
} else {

    $sql = mysqli_query($conn, "Select * From users Where unique_id = '{$_SESSION['unique_id']}'");
    $arrUser = mysqli_fetch_array($sql);
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

        #search {
            border: 0px solid !important;
        }

        .search {
            border: 1px solid;
        }
    </style>

</head>

<body class="sticky-header ">




    <div class="edu-breadcrumb-area breadcrumb-style-3">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="col-md-4 col-lg-4 d-flex" style="margin: 40px 40px 10px;">

                    <h3><i class="bi bi-person-square" style="margin-right: 10px; font-size: 30px; font-weight: 600;"></i>Profile</h3>

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
                            <li><a target="_blank" href='https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $arrUser['linkedin'] ?>' class="shareBtn"><i class="icon-linkedin2"></i></a></li>
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