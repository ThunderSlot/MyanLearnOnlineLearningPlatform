<?php
include_once "header.php";
include_once "config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: signup.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registering for Instructor</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- For icon tab -->
    <link rel="icon" href="assets/images/logomobile.png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <link href="assets/vendor/lightbox/css/lightbox.min.css" rel="stylesheet">


    <!-- Flaticon Font -->
    <link href="assets/vendor/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/instructorsignup.css" rel="stylesheet">


    <style>
        .courseCategory {
            float: none !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            line-height: 1 !important;
            color: white !important;
            text-shadow: 0 1px 0 #fff;
            opacity: 1 !important;
        }

        /* The actual timeline (the vertical ruler) */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* The actual timeline (the vertical ruler) */
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: orange;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }

        /* Container around content */
        .containerTimeline {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            color: white;
            width: 50%;
        }

        .containerTimeline .content h2 {
            color: white;
        }

        /* The circles on the timeline */
        .containerTimeline::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -12px;
            background-color: white;
            border: 4px solid #FF9F55;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        /* Place the container to the left */
        .left {
            left: 0;
        }

        /* Place the container to the right */
        .right {
            left: 50%;
        }

        /* Add arrows to the left container (pointing right) */
        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid orange;
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent orange;
        }

        /* Add arrows to the right container (pointing left) */
        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid orange;
            border-width: 10px 10px 10px 0;
            border-color: transparent orange transparent transparent;
        }

        /* Fix the circle for containers on the right side */
        .right::after {
            left: -12px;
        }

        /* The actual content */
        .content {
            padding: 20px 30px;
            background-color: orange;
            position: relative;
            border-radius: 6px;
        }

        /* Media queries - Responsive timeline on screens less than 600px wide */
        @media screen and (max-width: 600px) {

            /* Place the timelime to the left */
            .timeline::after {
                left: 31px;
            }

            /* Full-width containers */
            .containerTimeline {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            /* Make sure that all arrows are pointing leftwards */
            .containerTimeline::before {
                left: 60px;
                border: medium solid orange;
                border-width: 10px 10px 10px 0;
                border-color: transparent orange transparent transparent;
            }

            /* Make sure all circles are at the same spot */
            .left::after,
            .right::after {
                left: 15px;
            }

            /* Make all right containers behave like the left ones */
            .right {
                left: 0%;
            }
        }
    </style>
</head>

<body>



    <!-- Header Start -->
    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
        <div class="row align-items-center px-3">
            <div class="col-lg-6 text-center text-lg-left">
                <h4 class="text-white mb-4 mt-5 mt-lg-0">Myan Learning Online Teaching Platform</h4>
                <h1 class="display-3 font-weight-bold text-white">Grab a chance to come teach with us!</h1>
                <p class="text-white mb-4">Be a great instructors and start make life changing moment - including your own .</p>
                <a href="instructordashboard.php" class="btn btn-secondary mt-1 py-3 px-5">Get started</a>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <img class="img-fluid mt-5" src="assets/images/HeroPicture.png" alt="">
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Facilities Start -->
    <div class="container-fluid pt-5">
        <div class="container pb-3">
            <div style="text-align : center;">
                <p class="section-title px-5"><span class="px-2">Why to start as Instructor?</span></p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class=".flaticon-033-blocks h1 font-weight-normal text-primary mb-3">
                            <img src="assets/images/ChalkboardWriting.png" style="width: 50px">
                        </i>

                        <div class="pl-4">
                            <h4>Teach with the best way!</h4>
                            <p class="m-0">Publishing best own course content and always upgrading.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class=" h1 font-weight-normal text-primary mb-3">
                            <img src="assets/images/competence.png" style="width: 50px">
                        </i>
                        <div class="pl-4">
                            <h4>Inspire the learners!</h4>
                            <p class="m-0">Help developing the world by leading learners to their intrests and advanced their skills.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class=" h1 font-weight-normal text-primary mb-3">
                            <img src="assets/images/star.png" style="width: 50px">
                        </i>
                        <div class="pl-4">
                            <h4>Get earned!</h4>
                            <p class="m-0">Builld your own network of professional and get paid.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Facilities Start -->




    <!-- Class Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">At the beginning!</span></p>
                <h1 class="mb-4">How to get started</h1>
            </div>

        </div>

        <div style="width: 100%;">
            <div class="timeline">
                <div class="containerTimeline left">
                    <div class="content">
                        <h2>1. Create Curriculum</h2>
                        <p>Lorem ipsum dolor sit amet, quo ei simul congue exerci, ad nec admodum perfecto mnesarchum, vim ea mazim fierent detracto. Ea quis iuvaret expetendis his, te elit voluptua dignissim per, habeo iusto primis ea eam.</p>
                    </div>
                </div>
                <div class="containerTimeline right">
                    <div class="content">
                        <h2>2. Make Course Video</h2>
                        <p>Lorem ipsum dolor sit amet, quo ei simul congue exerci, ad nec admodum perfecto mnesarchum, vim ea mazim fierent detracto. Ea quis iuvaret expetendis his, te elit voluptua dignissim per, habeo iusto primis ea eam.</p>
                    </div>
                </div>
                <div class="containerTimeline left">
                    <div class="content">
                        <h2>3. Launch the Course</h2>
                        <p>Lorem ipsum dolor sit amet, quo ei simul congue exerci, ad nec admodum perfecto mnesarchum, vim ea mazim fierent detracto. Ea quis iuvaret expetendis his, te elit voluptua dignissim per, habeo iusto primis ea eam.</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- Class End -->




    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container p-0">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">From our instructors</span></p>
                <h1 class="mb-4">What they Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="https://thispersondoesnotexist.com/image" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Frank Dave</h5>
                            <i>Data Science and IT professional</i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="https://thispersondoesnotexist.com/image" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Frank Dave</h5>
                            <i>Data Science and IT professional</i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="https://thispersondoesnotexist.com/image" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Frank Dave</h5>
                            <i>Data Science and IT professional</i>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item px-3">
                    <div class="bg-light shadow-sm rounded mb-4 p-4">
                        <h3 class="fas fa-quote-left text-primary mr-3"></h3>
                        Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem. Dolor tempor ipsum clita
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="rounded-circle" src="https://thispersondoesnotexist.com/image" style="width: 70px; height: 70px;" alt="Image">
                        <div class="pl-3">
                            <h5>Frank Dave</h5>
                            <i>Data Science and IT professional</i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Latest Blog</span></p>
                <h1 class="mb-4">Latest Articles From Blog</h1>
            </div>

            <div style="width: 200px; margin:auto;">
                <a href="instructordashboard.php" class="btn btn-secondary mt-1 py-3 px-5">Get started</a>
            </div>


        </div>
    </div>
    <br><br>
    <hr>
    <!-- Blog End -->


    <!-- Footer Start -->

    <?php include_once "footer.php"; ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/easing/easing.min.js"></script>
    <script src="assets/vendor/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/instructorsignup.js"></script>
</body>

</html>