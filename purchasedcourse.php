<?php
include('header.php');



?>

<!DOCTYPE html>
<html>


<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyanLearn | My Learning Page</title>
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
    <link rel="stylesheet" href="assets/css/checkout.css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css">

    <!-- For data table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" />



    <style>
        .ml-10px {
            margin-left: 10px;
        }

        .badge_num {
            background: var(--primary-color);
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            position: absolute;
            left: 30%;
            border-radius: 3px;
            height: 35px;
            top: 58%;
            width: 35px;
            font-size: 12px;
            padding: 9px 11px;
            margin: 36px 5px 0px 0px;
            display: flex;
            justify-content: center;
        }

        .ms-value-input {
            display: none;
        }

        .ms-dd .ms-dd-option-image,
        .ms-dd .ms-dd-selected-img {
            max-width: 40px;
        }

        .container-box {
            border: 2px solid blue;
            padding: 20px;
            margin-top: 20px;
        }

        .centered-line {
            line-height: 0.1em;
            margin: 10px 0 20px;
        }

        .centered-line span {
            background-color: white;
            padding: 0 10px;
        }

        td {
            vertical-align: middle;
        }
    </style>

</head>

<body class="sticky-header ">


    <div id="main-wrapper" class="main-wrapper">


        <!--=====================================-->
        <!--=       Checkout Area Start         =-->
        <!--=====================================-->
        <section class="checkout-page-area section-gap-equal" style="padding: 60px 0;">
            <div class="container">

                <!-- Display errors returned by checkout session -->
                <div id="paymentResponse" class="hidden"></div>

                <div class="row row--15">
                    <div class="col-lg-12">
                        <div class="checkout-billing">
                            <h3 style="font-weight: 1000; font-size: 26px;">My Learning</h3>

                            <div class="checkout-tabs">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a id="CreditCartTrigger" class="nav-link active" style="cursor: pointer;">
                                            <i class="fa-solid fa-arrow-trend-up"
                                                style="color: orange; font-size: 18px;"></i>
                                            <span><b>On Progress</b></span>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="BankTrigger" class="nav-link" style="cursor: pointer;">
                                            <svg width="18px" height="18px" viewBox="0 0 36 36"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="iconify iconify--twemoji" preserveAspectRatio="xMidYMid meet">
                                                <path fill="#BB1A34"
                                                    d="M1.728 21c-.617 0-.953-.256-1.127-.471c-.171-.211-.348-.585-.225-1.165L3.104 6.658l-1.714.097h-.013c-.517 0-.892-.168-1.127-.459a1.144 1.144 0 0 1-.221-.98c.15-.702.883-1.286 1.667-1.329l4.008-.227a3.42 3.42 0 0 1 .217-.008c.147 0 .536 0 .783.306c.252.312.167.709.139.839L3.719 19.454c-.187.884-.919 1.489-1.866 1.542L1.728 21zm10.743-2c-1.439 0-2.635-.539-3.459-1.559c-1.163-1.439-1.467-3.651-.878-6.397c1.032-4.812 4.208-8.186 7.902-8.395c1.59-.089 2.906.452 3.793 1.549c1.163 1.439 1.467 3.651.878 6.397c-1.032 4.81-4.208 8.184-7.904 8.394a4.66 4.66 0 0 1-.332.011zm3.414-13.746l-.137.004c-1.94.111-3.555 2.304-4.32 5.866c-.478 2.228-.381 3.899.272 4.707c.297.368.717.555 1.249.555l.14-.004c1.94-.109 3.554-2.301 4.318-5.864c.478-2.228.382-3.9-.27-4.708c-.296-.369-.718-.556-1.252-.556zm11.591 12.107c-1.439 0-2.637-.539-3.462-1.56c-1.163-1.439-1.467-3.651-.878-6.397c1.033-4.813 4.209-8.186 7.903-8.394c1.603-.09 2.903.453 3.79 1.549c1.163 1.439 1.467 3.651.878 6.396c-1.031 4.809-4.206 8.183-7.902 8.396c-.112.008-.221.01-.329.01zm3.411-13.747l-.136.004c-1.941.111-3.556 2.304-4.32 5.865c-.478 2.229-.381 3.901.272 4.708c.297.368.719.555 1.251.555l.14-.004c1.939-.109 3.554-2.302 4.318-5.864c.479-2.227.383-3.899-.27-4.707c-.298-.37-.72-.557-1.255-.557zM11 35.001a2.001 2.001 0 0 1-.703-3.874c.337-.126 8.399-3.108 20.536-4.12a2 2 0 0 1 .332 3.986c-11.59.966-19.386 3.851-19.464 3.88c-.23.086-.468.128-.701.128zM2.001 29a2 2 0 0 1-.719-3.866c.542-.209 13.516-5.126 32.612-6.131a1.987 1.987 0 0 1 2.103 1.892a2 2 0 0 1-1.892 2.103c-18.423.97-31.261 5.821-31.389 5.87a2.017 2.017 0 0 1-.715.132z">
                                                </path>
                                            </svg>
                                            <span><b>Completed</b></span>

                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="active" id="credit_method_tab" role="tabpanel" style="display:block;">


                                    <p>These are the Courses that are not completed learning. Continue Learning to get
                                        the certificate!</p>

                                    <?php

                                    $UserUniqueId = $_SESSION['unique_id'];

                                    // echo "<script>alert(" . $UserUniqueId . ");</script>";
                                    
                                    $sql = "SELECT * FROM purchasedetail WHERE user_unique_id = {$UserUniqueId}  ORDER BY purchase_time DESC";
                                    $query = mysqli_query($conn, $sql);
                                    $countPurchase = mysqli_num_rows($query);

                                    if ($countPurchase == 0) {
                                        echo "<p style='font-weight:600; font-size:18px; margin-bottom: 20px; color:#666666;'>Currently, there is no Course !</p>";
                                    } else {


                                        ?>

                                        <div class="container dataTable">
                                            <div class="row">
                                                <div class="mb-4 mt-3" style="overflow-x:auto;">
                                                    <table id="example" class="display table table-responsive hover"
                                                        style="width:100%">

                                                        <tbody>

                                                            <thead style="background-color: #FFECEC;">
                                                                <tr class="trProgress">
                                                                    <th class="CoverPhoto">Cover Photo</th>
                                                                    <th>Title</th>
                                                                    <th>Level</th>
                                                                    <th>Total Duration</th>
                                                                    <th>Purchased Date</th>
                                                                    <th>Category</th>
                                                                    <th>Progress</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>

                                                            <?php
                                                            $countProgressCourse = 0;

                                                            // echo "<script>alert(".$countPurchase.");</script>";
                                                            for ($z = 0; $z < $countPurchase; $z++) {


                                                                $arrPurCourse = mysqli_fetch_array($query);
                                                                $PurCourseId = $arrPurCourse['course_id'];                                                            

                                                                $sqlCourse = "SELECT * FROM course WHERE course_id = '$PurCourseId'";
                                                                $queryCourse = mysqli_query($conn, $sqlCourse);
                                                                $arrCourse = mysqli_fetch_array($queryCourse);
                                                                $countCourse = mysqli_num_rows($queryCourse);



                                                                $courseUniqueId = $arrCourse['course_unique_id'];
                                                                $checkComplete = "SELECT * FROM certificate_completion WHERE course_unique_id = '$courseUniqueId' && user_unique_id = '$UserUniqueId' ";
                                                                $queryComplete = mysqli_query($conn, $checkComplete);
                                                                $arrComplete = mysqli_fetch_array($queryComplete);
                                                                $countComplete = mysqli_num_rows($queryComplete);

                                                                // echo "<script>alert(".$countComplete.");</script>";
                                                                // echo "<script>alert(".$UserUniqueId.");</script>";
                                                                // echo "<script>alert('".$courseUniqueId."');</script>";


                                                                if ($countComplete < 1) //mean this course is still in progress
                                                                {

                                                                    $categorySelect = "SELECT * from category WHERE category_id = {$arrCourse['course_category']};";
                                                                    $queryCat = mysqli_query($conn, $categorySelect);
                                                                    $arrCat = mysqli_fetch_array($queryCat);

                                                                    $SelectCourseVideo = "SELECT * FROM coursevideo
                                                                                      WHERE course_id={$PurCourseId} ";
                                                                    $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);

                                                                    $countvideo = mysqli_num_rows($runSelectCourseVideo);

                                                                    $TotalDuration = 0;

                                                                    for ($l = 1; $l <= $countvideo; $l++) {

                                                                        $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);
                                                                        $Duration = intval($arrCourseVideo['runTime']);
                                                                        $TotalDuration = $TotalDuration + $Duration;
                                                                    }

                                                                    $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';
                                                                    ;

                                                                    $SelectTotalQuizPack = "SELECT * FROM quizpackage
                                                                                         WHERE course_id={$PurCourseId} ";
                                                                    $runTotalQuizPack = mysqli_query($conn, $SelectTotalQuizPack);
                                                                    $countQuizPack = mysqli_num_rows($runTotalQuizPack);

                                                                    $SelectCourseVdo = "SELECT * FROM coursevideo
                                                                                    WHERE course_id='$PurCourseId' ";
                                                                    $runTotalVdo = mysqli_query($conn, $SelectCourseVdo);
                                                                    $arrCourseVdo = mysqli_fetch_array($runTotalVdo);
                                                                    $countTotalVdo = mysqli_num_rows($runTotalVdo);

                                                                    $totalCourseMaterial = $countQuizPack + $countTotalVdo; //Total Course Material
                                                        
                                                                    $TotalComplete = "SELECT * FROM coursecomplete
                                                                                    Where course_unique_id = '$courseUniqueId' && user_unique_id ='" . $_SESSION['unique_id'] . "' ";
                                                                    $runTotalComplete = mysqli_query($conn, $TotalComplete);
                                                                    $countTotalComplete = mysqli_num_rows($runTotalComplete); // Total Complete
                                                        
                                                                    $TotalComplete100 = $countTotalComplete * 100;
                                                                    $PercentageComplete = $TotalComplete100 / $totalCourseMaterial;

                                                                    // echo "<script>alert(".$countComplete.");</script>";
                                                        



                                                                    $selectVideo = "SELECT *,SUM(runTime) AS total_duration FROM coursevideo
                                                                    WHERE course_id='$PurCourseId'";
                                                                    $runSelectVideo = mysqli_query($conn, $selectVideo);
                                                                    $arrVideo = mysqli_fetch_array($runSelectVideo);

                                                                    $total_duration = $arrVideo['total_duration'];



                                                                    echo "<tr>";

                                                                    if ($arrCourse['preview_image'] == "" || $arrCourse['preview_image'] == null) {
                                                                        echo "<td><img src='assets/images/PreviewImage.jpg' alt='' style='width:130px; border-radius:10px;'></td>";
                                                                    } else {
                                                                        echo "<td><img src='" . $arrCourse['preview_image'] . "' alt='' style='width:130px;border-radius:10px;'></td>";
                                                                    }

                                                                    echo "<td>" . $arrCourse['course_title'] . "</td>";
                                                                    echo "<td>" . $arrCourse['course_level'] . "</td>";
                                                                    echo "<td>$TotalDurationHours</td>";
                                                                    echo "<td>" . date("d M Y", strtotime($arrPurCourse['purchase_time'])) . "</td>";
                                                                    echo '<td>' . ((strlen($arrCat['category_name']) > 11) ? substr($arrCat['category_name'], 0, 11) . '..' : $arrCat['category_name']) . '</td>';
                                                                    echo "<td>" . (($PercentageComplete == 0) ? "Course Not in touch" : $PercentageComplete . "%") . "</td>";

                                                                    echo "<td><a href='CourseWatch.php?CourseID=" . $PurCourseId . "&videoUniqueId=" . $arrCourseVdo['video_unique_id'] . "' class='btn btn-warning'><i class='fas fa-eye'></i> View Course</a></td>";




                                                                    echo "</tr>";

                                                                    echo "</tbody>";
                                                                } else {

                                                                    $countProgressCourse += 1;
                                                                }
                                                            } //for loop
                                                        
                                                            if ($countPurchase = 0) {

                                                                echo "<script>document.querySelector('.trProgress').style.display = 'none';</script>";

                                                                ?>
                                                                <h1 style="color: var(--light-gradient);">There is no Courses
                                                                    enrolled yet.</h1>
                                                                <?php
                                                            }

                                                            if ($countPurchase == $countProgressCourse && $countProgressCourse != 0) {



                                                                echo "<script>document.querySelector('.trProgress').style.display = 'none';</script>";

                                                                ?>
                                                                <h1 style="color: var(--light-gradient);">There is no Courses in
                                                                    progress. Check for complete Courses.</h1>
                                                                <?php
                                                            }

                                                            ?>




                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>


                                </div>



                                <div id="bank_method_tab" role="tabpanel" style="display:none;">
                                    <p>Courses Finished. You can rewatch the course material or download the course
                                        certificate! </p>

                                    <?php

                                    $UserUniqueId = $_SESSION['unique_id'];

                                    // echo "<script>alert(" . $UserUniqueId . ");</script>";
                                    
                                    $sql = "SELECT * FROM purchasedetail WHERE user_unique_id = {$UserUniqueId}  ORDER BY purchase_time DESC";
                                    $query = mysqli_query($conn, $sql);
                                    $countPurchase = mysqli_num_rows($query);

                                    if ($countPurchase == 0) {
                                        echo "<p style='font-weight:600; font-size:18px; margin-bottom: 20px; color:#666666;'>Currently, there is no Course !</p>";
                                    } else {


                                        ?>

                                        <div class="container dataTable">
                                            <div class="row">
                                                <div class="mb-4 mt-3" style="overflow-x:auto;">
                                                    <table id="example" class="display table table-responsive hover"
                                                        style="width:100%">

                                                        <tbody>

                                                            <thead style="background-color: #FFECEC;">
                                                                <tr class="trComplete">
                                                                    <th class="CoverPhoto">Cover Photo</th>
                                                                    <th>Title</th>
                                                                    <th>Level</th>
                                                                    <th>Total Duration</th>
                                                                    <th>Purchased Date</th>
                                                                    <th>Category</th>
                                                                    <th>Progress</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>

                                                            <?php
                                                            $countProgressCourse = 0;





                                                            for ($i = 0; $i < $countPurchase; $i++) {


                                                                $arrPurCourse = mysqli_fetch_array($query);
                                                                $PurCourseId = $arrPurCourse['course_id'];

                                                                $sqlCourse = "SELECT * FROM course WHERE course_id = {$PurCourseId}";
                                                                $queryCourse = mysqli_query($conn, $sqlCourse);
                                                                $arrCourse = mysqli_fetch_array($queryCourse);

                                                                $courseUniqueId = $arrCourse['course_unique_id'];
                                                                $checkComplete = "SELECT * FROM certificate_completion WHERE course_unique_id = '$courseUniqueId' && user_unique_id = '$UserUniqueId' ";
                                                                $queryComplete = mysqli_query($conn, $checkComplete);
                                                                $arrComplete = mysqli_fetch_array($queryComplete);
                                                                $countComplete = mysqli_num_rows($queryComplete);

                                                                $categorySelect = "SELECT * from category WHERE category_id = {$arrCourse['course_category']};";
                                                                $queryCat = mysqli_query($conn, $categorySelect);
                                                                $arrCat = mysqli_fetch_array($queryCat);

                                                                $SelectCourseVideo = "SELECT * FROM coursevideo
                                                                                    WHERE course_id={$PurCourseId} ";
                                                                $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);

                                                                $countvideo = mysqli_num_rows($runSelectCourseVideo);

                                                                for ($l = 1; $l <= $countvideo; $l++) {

                                                                    $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);
                                                                    $Duration = intval($arrCourseVideo['runTime']);
                                                                    $TotalDuration = 0;
                                                                    $TotalDuration = $TotalDuration + $Duration;
                                                                }

                                                                $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';
                                                                ;

                                                                $SelectTotalQuizPack = "SELECT * FROM quizpackage
                                                                                        WHERE course_id={$PurCourseId} ";
                                                                $runTotalQuizPack = mysqli_query($conn, $SelectTotalQuizPack);
                                                                $countQuizPack = mysqli_num_rows($runTotalQuizPack);

                                                                $SelectCourseVdo = "SELECT * FROM coursevideo
                                                                                    WHERE course_id='$PurCourseId' ";
                                                                $runTotalVdo = mysqli_query($conn, $SelectCourseVdo);
                                                                $arrCourseVdo = mysqli_fetch_array($runTotalVdo);
                                                                $countTotalVdo = mysqli_num_rows($runTotalVdo);

                                                                $totalCourseMaterial = $countQuizPack + $countTotalVdo; //Total Course Material
                                                        
                                                                $TotalComplete = "SELECT * FROM coursecomplete
                                                                                Where course_unique_id = '$courseUniqueId' && user_unique_id ='" . $_SESSION['unique_id'] . "' ";
                                                                $runTotalComplete = mysqli_query($conn, $TotalComplete);
                                                                $countTotalComplete = mysqli_num_rows($runTotalComplete); // Total Complete
                                                        
                                                                $TotalComplete100 = $countTotalComplete * 100;
                                                                $PercentageComplete = $TotalComplete100 / $totalCourseMaterial;




                                                                if ($countComplete > 0) //mean this course is still in progress
                                                                {

                                                                    $selectVideo = "SELECT *,SUM(runTime) AS total_duration FROM coursevideo
                                                                                    WHERE course_id='$PurCourseId'";
                                                                    $runSelectVideo = mysqli_query($conn, $selectVideo);
                                                                    $arrVideo = mysqli_fetch_array($runSelectVideo);

                                                                    $total_duration = $arrVideo['total_duration'];



                                                                    echo "<tr>";

                                                                    if ($arrCourse['preview_image'] == "" || $arrCourse['preview_image'] == null) {
                                                                        echo "<td><img src='assets/images/PreviewImage.jpg' alt='' style='width:130px; border-radius:10px;'></td>";
                                                                    } else {
                                                                        echo "<td><img src='" . $arrCourse['preview_image'] . "' alt='' style='width:130px;border-radius:10px;'></td>";
                                                                    }

                                                                    echo "<td>" . $arrCourse['course_title'] . "</td>";
                                                                    echo "<td>" . $arrCourse['course_level'] . "</td>";
                                                                    echo "<td>$TotalDurationHours</td>";
                                                                    echo "<td>" . date("d M Y", strtotime($arrPurCourse['purchase_time'])) . "</td>";
                                                                    echo '<td>' . ((strlen($arrCat['category_name']) > 11) ? substr($arrCat['category_name'], 0, 11) . '..' : $arrCat['category_name']) . '</td>';
                                                                    echo "<td>" . (($PercentageComplete == 0) ? "Course Not in touch" : $PercentageComplete . "%") . "</td>";

                                                                    echo "<td><a href='CourseWatch.php?CourseID=" . $PurCourseId . "&videoUniqueId=" . $arrCourseVdo['video_unique_id'] . "' class='btn btn-warning'><i class='fas fa-eye'></i> View Course</a>
                                                                            <a href='downloadCertificate.php?courseUniqueID=" . $courseUniqueId . "' class='btn btn-primary'><i class='fa-solid fa-download'></i>Certificate</a></td>";




                                                                    echo "</tr>";

                                                                    echo "</tbody>";
                                                                } else {

                                                                    $countProgressCourse += 1;
                                                                }
                                                            } //for loop
                                                        
                                                            if ($countPurchase = 0) {

                                                                echo "<script>document.querySelector('.trComplete').style.display = 'none';</script>";

                                                                ?>
                                                                <h1 style="color: var(--light-gradient);">There is no Courses
                                                                    enrolled yet.</h1>
                                                                <?php
                                                            }

                                                            if ($countPurchase == $countProgressCourse && $countProgressCourse != 0) {

                                                                echo "<script>document.querySelector('.trComplete').style.display = 'none';</script>";

                                                                ?>
                                                                <h1 style="color: var(--light-gradient);">There is no Courses
                                                                    that has not finished. Check for complete Courses.</h1>
                                                                <?php
                                                            }

                                                            ?>




                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>



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

    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>






    <script>
        // Get the modal
        var credit_method_tab = document.getElementById("credit_method_tab");
        var bank_method_tab = document.getElementById("bank_method_tab");

        // Get trigger
        var CreditCartTrigger = document.getElementById("CreditCartTrigger");
        var BankTrigger = document.getElementById("BankTrigger");



        CreditCartTrigger.onclick = function () {
            bank_method_tab.style.display = "none";
            credit_method_tab.style.display = "block";
            document.getElementById("BankTrigger").classList.remove("active");
            document.getElementById("CreditCartTrigger").classList.add("active");

        }
        BankTrigger.onclick = function () {
            bank_method_tab.style.display = "block";
            credit_method_tab.style.display = "none";
            document.getElementById("CreditCartTrigger").classList.remove("active");
            document.getElementById("BankTrigger").classList.add("active");
        }
        PaypalTrigger.onclick = function () {
            bank_method_tab.style.display = "none";
            credit_method_tab.style.display = "none";
            document.getElementById("CreditCartTrigger").classList.remove("active");
            document.getElementById("BankTrigger").classList.remove("active");
        }
    </script>





</body>

</html>