<?php
include('header.php');
include('shoppingCartFunction.php');


if (isset($_GET['CourseID'])) {
    $GetCourseID = $_GET['CourseID'];

    $SelectPublishedCourse = "SELECT * FROM course
                                WHERE course_id = '$GetCourseID'";
    $runPublishedCourse = mysqli_query($conn, $SelectPublishedCourse);
    $arrPublishedCourse = mysqli_fetch_array($runPublishedCourse);

    $InstructorID = $arrPublishedCourse['instructor_id'];
    $SelectInstructor = "SELECT * FROM users
                     WHERE unique_id='$InstructorID'";
    $runSelectInstructor = mysqli_query($conn, $SelectInstructor);
    $arrInstructor = mysqli_fetch_array($runSelectInstructor);

    $CourseID = $arrPublishedCourse['course_id'];
    $CourseUniqueID = $arrPublishedCourse['course_unique_id'];
    $SelectCourseVideo = "SELECT * FROM coursevideo
                     WHERE course_id='$CourseID'";
    $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);

    $countvideo = mysqli_num_rows($runSelectCourseVideo);
    $TotalDuration = 0;

    for ($i = 1; $i <= $countvideo; $i++) {

        $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);
        $Duration = intval($arrCourseVideo['runTime']);
        $TotalDuration = $TotalDuration + $Duration;
    }

    $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';
    $TotalDurationHours1 = floor($TotalDuration / 60) . ':' . ($TotalDuration % 60) . ':00';
    $Price = $arrPublishedCourse['course_price'];
    $CourseLevel = $arrPublishedCourse['course_level'];
    $CourseLanguage = $arrPublishedCourse['course_langugae'];
    $CourseImage = $arrPublishedCourse['preview_image'];
    $CoursePreviewVideo = $arrPublishedCourse['preview_video'];
    $CourseTitle = $arrPublishedCourse['course_title'];
    $CourseRequirement = $arrPublishedCourse['course_requirement'];
    $CourseDescription = $arrPublishedCourse['course_description'];
    $CourseSubtitle = $arrPublishedCourse['course_subtitle'];
    $CourseLatestDate = $arrPublishedCourse['course_latest_date'];
    $FullName = $arrInstructor['fullName'];
    if ($arrInstructor['image']) {
        $InstructorImage = $arrInstructor['image'];
    } else {
        $InstructorImage = "assets/images/DefaultProfile.jpg";
    }

    $CourseOutcome = $arrPublishedCourse['course_teaching_outcome'];

    $pattern = '/[!\\.]/'; // matches "!" and "."

    $splicedOutcome = preg_split($pattern, $CourseOutcome);

    $SelectCourseVideo = "SELECT * FROM coursevideo
                            WHERE course_id='$CourseID'  LIMIT 1 ";

    $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);
    $countcoursevideo = mysqli_num_rows($runSelectCourseVideo);
    $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);

    $videoUniqueId = $arrCourseVideo['video_unique_id'];
}

if (isset($_POST['AddCartBtn'])) {
    $CourseID = $_POST['CourseID'];

    $index = IndexOf($CourseID);

    if ($index != -1) //this course is in cart 
    {
        echo "<script>window.location='ShoppingCart.php'</script>";
    } elseif ($index == -1) //not added to cart
    {
        AddProduct($CourseID);
    }
}

if (!isset($_SESSION['Shopping_Cart_Functions']) or count($_SESSION['Shopping_Cart_Functions']) < 1) {
    $CartBtnText = 'Add to Cart <i class="icon-3"></i>';
} elseif (isset($_SESSION['Shopping_Cart_Functions']) or count($_SESSION['Shopping_Cart_Functions']) > 0) {
    $index = IndexOf($CourseID);


    if ($index != -1) //this course is in cart 
    {
        $CartBtnText = 'Go to Cart <i class="icon-3"></i>';
    } elseif ($index == -1) //not added to cart
    {
        $CartBtnText = 'Add to Cart <i class="icon-3"></i>';
    }
}

if (isset($_POST['EnrollNowBtn'])) {
    $UserUniqueID = $_SESSION['unique_id'];
    $purchase_unique_id = uniqid('Purchase');
    $today_day = date('d');
    $today_month = date('M');
    $today_year = date('Y');
    $time = time();

    $CourseID = $_POST['CourseID'];

    $SelectCourseVideo = "SELECT * FROM coursevideo
                         WHERE course_id='$CourseID'  LIMIT 1 ";

    $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);
    $countcoursevideo = mysqli_num_rows($runSelectCourseVideo);
    $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);

    $videoUniqueId = $arrCourseVideo['video_unique_id'];

    $InstructorID = $_POST['instructorId'];


    $Insert1 = "INSERT INTO purchase
				(purchase_unique_id, unique_id, user_id, total_amount, VAT, grand_total, payment_type, status, purchase_day, purchase_month, purchase_year)
			  VALUES 
			  ('$purchase_unique_id', '$UserUniqueID', '$UserID', 'Free', 'Free', 'Free', 'Free', 'succeeded', '$today_day', '$today_month', '$today_year')
			";

    $result1 = mysqli_query($conn, $Insert1);

    $Insert2 = "INSERT INTO purchasedetail (purchase_unique_id, course_id, course_price, purchase_day, purchase_month, purchase_year, user_unique_id, instructor_unique_id) 
				  VALUES
				  ('$purchase_unique_id', '$CourseID', 'Free', '$today_day', '$today_month', '$today_year', '$UserUniqueID', '$InstructorID')
				  ";
    $result2 = mysqli_query($conn, $Insert2);

    echo "<script>alert('Course have been enrolled!');</script>";
    echo "<script>window.location.href = 'CourseWatch.php?CourseID=" . $CourseID . "&videoUniqueId=" . $videoUniqueId . " ';</script>";
}

?>

<!DOCTYPE html>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyanLearn | Course Details</title>
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
    </style>

</head>

<body class="sticky-header ">

    <form action="courseviewdetail.php" method="post" enctype="multipart/form-data">
        <!-- Display errors returned by checkout session -->
        <input type="hidden" name="instructorId" value="<?php echo $InstructorID ?>">
        <div id="paymentResponse" class="hidden"></div>

        <input type="hidden" name="CourseID" value="<?php echo $CourseID; ?>">

        <div id="main-wrapper" class="main-wrapper">


            <!--=====================================-->
            <!--=       Breadcrumb Area Start      =-->
            <!--=====================================-->


            <div class="edu-breadcrumb-area breadcrumb-style-3">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <ul class="edu-breadcrumb">
                            <li class="breadcrumb-item"><a href="index-one.html">Home</a></li>
                            <li class="separator"><i class="icon-angle-right"></i></li>
                            <li class="breadcrumb-item"><a href="course-one.html">Courses</a></li>
                            <li class="separator"><i class="icon-angle-right"></i></li>
                            <li class="breadcrumb-item active" aria-current="page">Course Details</li>
                        </ul>
                        <div class="page-title">
                            <h1 class="title">
                                <?php echo $CourseTitle; ?>
                            </h1>
                            <p>
                                <?php echo $CourseSubtitle; ?>
                            </p>
                        </div>
                        <ul class="course-meta">
                            <li><i class="icon-58"></i>by
                                <?php echo $FullName; ?>
                            </li>
                            <li><i class="icon-59"></i>
                                <?php echo $CourseLanguage; ?>
                            </li>
                            <li> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                    <rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
                                    <rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
                                </svg>
                                <span class="align-middle">
                                    <?php echo $CourseLevel; ?>
                                </span>
                            </li>

                        </ul>
                        <ul class="course-meta">
                            <li>Latest Update: <span style="color: var(--light-gradient);">
                                    <?php echo " " . $CourseLatestDate; ?>
                                </span></li>
                        </ul>
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
            <!--=     Courses Details Area Start    =-->
            <!--=====================================-->
            <section class="edu-section-gap course-details-area">
                <div class="container">
                    <div class="row row--30">
                        <div class="col-lg-8">
                            <div class="course-details-content">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="carriculam-tab" data-bs-toggle="tab" data-bs-target="#carriculam" type="button" role="tab" aria-controls="carriculam" aria-selected="false">Curriculum</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor" aria-selected="false">Instructor</button>
                                    </li>


                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                        <div class="course-tab-content">
                                            <div class="course-overview">
                                                <h3 class="heading-title">Course Description</h3>
                                                <p>
                                                    <?php echo $CourseDescription; ?>
                                                </p>
                                                <h3 class="heading-title">Prerequisites</h3>
                                                <p class="mb--60">
                                                    <?php echo $CourseRequirement; ?>
                                                </p>
                                                <h5 class="title">What You’ll Learn?</h5>
                                                <ul class="mb--60">
                                                    <?php
                                                    $count = count($splicedOutcome);
                                                    for ($i = 0; $i < $count - 1; $i++) {
                                                        echo "<li>" . $splicedOutcome[$i] . "</li>";
                                                    }
                                                    ?>
                                                </ul>
                                                <!-- <p>Consectetur adipisicing elit, sed do eiusmod tempor inc idid unt ut labore et dolore magna aliqua enim ad minim veniam quis nostrud exerec tation ullamco laboris nis aliquip commodo consequat duis aute irure dolor.</p> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                                        <div class="course-tab-content">
                                            <div class="course-curriculam">
                                                <h3 class="heading-title">Course Curriculum</h3>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <p><b>
                                                                <?php echo $countvideo; ?> <span style="color: var(--light-gradient);">Lectures</span>
                                                            </b></p>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <p><b>
                                                                <?php echo $TotalDurationHours1; ?> <span style="color: var(--light-gradient);">Course
                                                                    Duration</span>
                                                            </b></p>
                                                    </div>
                                                </div>
                                                <div class="course-lesson">
                                                    <h5 class="title">
                                                        <?php echo $CourseTitle; ?>
                                                    </h5>
                                                    <p>
                                                        <?php echo $CourseSubtitle; ?>
                                                    </p>
                                                    <ul>

                                                        <?php

                                                        $selectOrderToShowContent = "SELECT * FROM order_toshow_content
                                                                                WHERE course_unique_id='$CourseUniqueID'
                                                                                ORDER BY order_toshow_content ASC;";
                                                        $runOrderToShowContent = mysqli_query($conn, $selectOrderToShowContent);
                                                        $countOrderContent = mysqli_num_rows($runOrderToShowContent);


                                                        if ($countOrderContent == 0) {
                                                            echo "<p>There is no lecture content list to show related with this course!</p>";
                                                        } else {
                                                            for ($i = 0; $i < $countOrderContent; $i++) {

                                                                $arrOrderContent = mysqli_fetch_array($runOrderToShowContent);

                                                                $OrderlyCourseUniqueId = $arrOrderContent['course_unique_id'];
                                                                $video_unique_id = $arrOrderContent['video_unique_id'];
                                                                $quizPackage_unique_id = $arrOrderContent['quizPackage_unique_id'];
                                                                $contentType = $arrOrderContent['content_type'];



                                                                $selectCourse = "SELECT * FROM course
                                                                            WHERE course_unique_id='$OrderlyCourseUniqueId'";
                                                                $runSelectCourse = mysqli_query($conn, $selectCourse);
                                                                $arrSelectCourse = mysqli_fetch_array($runSelectCourse);
                                                                $courseId = $arrSelectCourse['course_id'];


                                                                if ($contentType == "video") {


                                                                    $Selectvideo = "SELECT * FROM coursevideo
                                                                                WHERE course_id='$courseId' && video_unique_id = '$video_unique_id'";
                                                                    $runSelectvideo = mysqli_query($conn, $Selectvideo);
                                                                    $countSelectvideo = mysqli_num_rows($runSelectvideo);

                                                                    for ($j = 0; $j < $countSelectvideo; $j++) {

                                                                        $arrSelectvideo = mysqli_fetch_array($runSelectvideo);

                                                                        $TableVideoId = $arrSelectvideo['video_id'];
                                                                        $TableVideoName = $arrSelectvideo['video_name'];
                                                                        $TableDuration = $arrSelectvideo['runTime'];
                                                                        $TableUploadDate = $arrSelectvideo['update_date'];
                                                                        $videoType = $arrSelectvideo['video_type'];

                                                                        echo "<li>
                                                                        <div class=\"text\"><i class=\"fas fa-video-camera\"></i>" . $TableVideoName . "</div>
                                                                        <div class=\"icon\"><span class=\"badge badge-secondary\">" . $TableDuration . " Minutes</span><i class=\"icon-68\"></i></div>
                                                                    </li>";
                                                                    }
                                                                }

                                                                if ($contentType == "quiz") {

                                                                    $selectQuizPack = "SELECT * FROM quizpackage
                                                                                WHERE course_id='$courseId' && quizPackage_unique_id='$quizPackage_unique_id'";
                                                                    $runSelectQuizPack = mysqli_query($conn, $selectQuizPack);
                                                                    $countQuizPack = mysqli_num_rows($runSelectQuizPack);

                                                                    for ($k = 0; $k < $countQuizPack; $k++) {

                                                                        $arrQuizPack = mysqli_fetch_array($runSelectQuizPack);

                                                                        $TableQuizPackId = $arrQuizPack['quizPackage_unique_id'];
                                                                        $TableQuizPackName = $arrQuizPack['quizPackage_name'];
                                                                        $TableUploadDate = $arrQuizPack['update_date'];


                                                                        $selectQuizContent = "SELECT * FROM coursequiz
                                                                                    WHERE quizPackage_id='$TableQuizPackId' ";
                                                                        $runSelectQuizContent = mysqli_query($conn, $selectQuizContent);
                                                                        $countQuizContent = mysqli_num_rows($runSelectQuizContent);

                                                                        echo "<li>
                                                                        <div class=\"text\"><i class=\"icon-65\"></i>" . $TableQuizPackName . "</div>
                                                                        <div class=\"icon\"><span class=\"badge badge-primary\">" . $countQuizContent . " Question</span><i class=\"icon-68\"></i></div>
                                                                    </li>";
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        ?>

                                                        <!-- <li>
                                                        <div class="text"><i class="fas fa-video-camera"></i> Introduction</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Course Overview</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Local Development Environment Tools</div>
                                                        <div class="badge-list">
                                                            <span class="badge badge-primary">0 Question</span>
                                                            <span class="badge badge-secondary">10 Minutes</span>
                                                        </div>
                                                    </li> -->



                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                        <div class="course-tab-content">
                                            <div class="course-instructor">
                                                <div class="thumbnail">
                                                    <img src="<?php echo $InstructorImage; ?>" alt="Author Images">
                                                </div>
                                                <div class="author-content">
                                                    <h6 class="title">
                                                        <?php echo $FullName; ?>
                                                    </h6>
                                                    <span class="subtitle"><?php echo $arrInstructor['job']; ?></span>
                                                    <p><?php echo $arrInstructor['about']; ?>
                                                    </p>
                                                    <ul class="social-share">
                                                        <li><a target="_blank" href='https://www.facebook.com/sharer/sharer.php?u=<?php echo $arrInstructor['facebook'] ?>' class="shareBtn"><i class="icon-facebook"></i></a></li>
                                                        <li><a target="_blank" href='https://twitter.com/intent/tweet?url=<?php echo $arrInstructor['twitter'] ?>' class="shareBtn"><i class="icon-twitter"></i></a></li>
                                                        <li><a target="_blank" href='https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $arrInstructor['linkedin'] ?>' class="shareBtn"><i class="icon-linkedin2"></i></a></li>
                                                        <li><a target="_blank" href='https://www.youtube.com/share?url=<?php echo $arrInstructor['youtube'] ?>' class="shareBtn"><i class="icon-youtube"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="course-sidebar-3 sidebar-top-position">
                                <div class="edu-course-widget widget-course-summery">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <img src="<?php echo $CourseImage; ?>" alt="Courses">
                                            <a class="play-btn" onclick="document.getElementById('previewVideoModal').style.display='block';"><i class="icon-18"></i></a>
                                        </div>
                                        <div class="content">
                                            <h4 class="widget-title">Course Includes:</h4>
                                            <ul class="course-item">
                                                <li>
                                                    <span class="label"><i class="icon-60"></i>Price:</span>
                                                    <span class="value price">
                                                        <?php echo $Price; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="label"><i class="icon-62"></i>Instrutor:</span>
                                                    <span class="value">
                                                        <?php echo $FullName; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="label"><i class="icon-61"></i>Duration:</span>
                                                    <span class="value">
                                                        <?php echo $TotalDurationHours; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="label">
                                                        <i class="fas fa-film"></i>Lessons:</span>
                                                    <span class="value">
                                                        <?php echo $countvideo; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="label"><i class="icon-63"></i>Enrolled:</span>
                                                    <span class="value">65 students</span>
                                                </li>
                                                <li>
                                                    <span class="label"><i class="icon-59"></i>Language:</span>
                                                    <span class="value">
                                                        <?php echo $CourseLanguage; ?>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="label"><i class="icon-64"></i>Certificate:</span>
                                                    <span class="value">Yes</span>
                                                </li>
                                            </ul>
                                            <div class="read-more-btn">
                                                <div class="row">
                                                    <?php
                                                    $selectCoursePurchase = "Select * from purchasedetail where course_id = '$GetCourseID' && user_unique_id = '$UniqueID'";
                                                    $runSelectCoursePruchase = mysqli_query($conn, $selectCoursePurchase);
                                                    $countCoursePurchase = mysqli_num_rows($runSelectCoursePruchase);

                                                    // echo "<script>alert(" . $countCoursePurchase . ");</script>";

                                                    if ($countCoursePurchase > 0) {

                                                    ?>
                                                        <div class="col-sm-12">
                                                            <a href="CourseWatch.php?CourseID=<?php echo $CourseID ?>&videoUniqueId=<?php echo $videoUniqueId; ?> " class="edu-btn btn-medium checkout-btn">Go to Course<i class="icon-4"></i></a>
                                                        </div>

                                                    <?php

                                                    } else if ($Price == 'Free' && $countCoursePurchase > 0) {
                                                    ?>
                                                        <div class="col-sm-12">
                                                            <a href="CourseWatch.php?CourseID=<?php echo $CourseID ?>&videoUniqueId=<?php echo $videoUniqueId; ?>  " class="edu-btn btn-medium checkout-btn">Go to Course<i class="icon-4"></i></a>
                                                        </div>
                                                    <?php


                                                    } else if ($Price == 'Free') {

                                                    ?>
                                                        <div class="col-sm-12">
                                                            <button type="submit" name="EnrollNowBtn" id="EnrollNowBtn" class="edu-btn">Enroll Now<i class="icon-4"></i></button>

                                                        </div>

                                                    <?php
                                                    } else if ($arrInstructor['unique_id'] == $_SESSION['unique_id']) {
                                                    ?>
                                                        <div class="col-sm-12">
                                                            <h5 style="text-align: center; border: 1px solid black; padding: 10px;"><i class="bi bi-info-circle"></i> This is your course.</h5>
                                                        </div>
                                                    <?php

                                                    } else {


                                                    ?>
                                                        <div class="col-sm-12">
                                                            <!-- <a href="#" class="edu-btn">Add to Cart <i class="icon-4"></i></a> -->
                                                            <button type="submit" name="AddCartBtn" class="edu-btn">
                                                                <?php echo $CartBtnText; ?>
                                                            </button>
                                                        </div>


                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="share-area">
                                                <h4 class="title">Share On:</h4>
                                                <ul class="social-share">
                                                    <li><button type="button" class="shareBtn"><i class="icon-facebook" onclick="shareOnFacebook()"></i></button></li>
                                                    <li><button type="button" class="shareBtn" onclick="shareOnTwitter(event)"><i class="icon-twitter"></i></button></li>
                                                    <li><button type="button" class="shareBtn" onclick="shareOnLinkedIn(event)"><i class="icon-linkedin2"></i></button></li>
                                                    <li><button type="button" class="shareBtn" onclick="shareOnYouTube(event)"><i class="icon-youtube"></i></button></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- The Modal -->
            <div class="modal" id="previewVideoModal" style="background-color: rgba(128, 128, 128, 0.5);;">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <?php echo $CourseTitle; ?>
                            </h4>
                            <a class="play-btn" style="font-size: 30px; cursor: pointer;" onclick="document.getElementById('previewVideoModal').style.display='none';">&times;</a>

                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="video-container paused" data-volume-level="high" style="margin-bottom: 50px;">
                                <img class="thumbnail-img">
                                <div class="video-controls-container">
                                    <div class="timeline-container">
                                        <div class="timeline">
                                            <img class="preview-img">
                                            <div class="thumb-indicator"></div>
                                        </div>
                                    </div>
                                    <div class="controls">
                                        <button class="play-pause-btn" type="button">
                                            <svg class="play-icon" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M8,5.14V19.14L19,12.14L8,5.14Z" />
                                            </svg>
                                            <svg class="pause-icon" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M14,19H18V5H14M6,19H10V5H6V19Z" />
                                            </svg>
                                        </button>
                                        <div class="volume-container">
                                            <button class="mute-btn" type="button">
                                                <svg class="volume-high-icon" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M14,3.23V5.29C16.89,6.15 19,8.83 19,12C19,15.17 16.89,17.84 14,18.7V20.77C18,19.86 21,16.28 21,12C21,7.72 18,4.14 14,3.23M16.5,12C16.5,10.23 15.5,8.71 14,7.97V16C15.5,15.29 16.5,13.76 16.5,12M3,9V15H7L12,20V4L7,9H3Z" />
                                                </svg>
                                                <svg class="volume-low-icon" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M5,9V15H9L14,20V4L9,9M18.5,12C18.5,10.23 17.5,8.71 16,7.97V16C17.5,15.29 18.5,13.76 18.5,12Z" />
                                                </svg>
                                                <svg class="volume-muted-icon" viewBox="0 0 24 24">
                                                    <path fill="currentColor" d="M12,4L9.91,6.09L12,8.18M4.27,3L3,4.27L7.73,9H3V15H7L12,20V13.27L16.25,17.53C15.58,18.04 14.83,18.46 14,18.7V20.77C15.38,20.45 16.63,19.82 17.68,18.96L19.73,21L21,19.73L12,10.73M19,12C19,12.94 18.8,13.82 18.46,14.64L19.97,16.15C20.62,14.91 21,13.5 21,12C21,7.72 18,4.14 14,3.23V5.29C16.89,6.15 19,8.83 19,12M16.5,12C16.5,10.23 15.5,8.71 14,7.97V10.18L16.45,12.63C16.5,12.43 16.5,12.21 16.5,12Z" />
                                                </svg>
                                            </button>
                                            <input class="volume-slider" type="range" min="0" max="1" step="any" value="1">
                                        </div>
                                        <div class="duration-container">
                                            <div class="current-time">0:00</div>
                                            /
                                            <div class="total-time"></div>
                                        </div>
                                        <button class="captions-btn" type="button">
                                            <svg viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M18,11H16.5V10.5H14.5V13.5H16.5V13H18V14A1,1 0 0,1 17,15H14A1,1 0 0,1 13,14V10A1,1 0 0,1 14,9H17A1,1 0 0,1 18,10M11,11H9.5V10.5H7.5V13.5H9.5V13H11V14A1,1 0 0,1 10,15H7A1,1 0 0,1 6,14V10A1,1 0 0,1 7,9H10A1,1 0 0,1 11,10M19,4H5C3.89,4 3,4.89 3,6V18A2,2 0 0,0 5,20H19A2,2 0 0,0 21,18V6C21,4.89 20.1,4 19,4Z" />
                                            </svg>
                                        </button>
                                        <button class="speed-btn wide-btn" type="button">
                                            1x
                                        </button>
                                        <button class="mini-player-btn" type="button">
                                            <svg viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M21 3H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H3V5h18v14zm-10-7h9v6h-9z" />
                                            </svg>
                                        </button>
                                        <button class="theater-btn" type="button">
                                            <svg class="tall" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 6H5c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 10H5V8h14v8z" />
                                            </svg>
                                            <svg class="wide" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 7H5c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm0 8H5V9h14v6z" />
                                            </svg>
                                        </button>
                                        <button class="full-screen-btn" type="button">
                                            <svg class="open" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z" />
                                            </svg>
                                            <svg class="close" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>


                                <video src="<?php echo $CoursePreviewVideo; ?>">
                                    <track kind="captions" srclang="en" src="assets/subtitles.vtt">
                                </video>
                            </div>
                            <p>
                                <?php echo $CourseDescription; ?>
                            </p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <a class="btn btn-danger" style="font-size: 15px; cursor: pointer;" onclick="document.getElementById('previewVideoModal').style.display='none';">Close</a>
                        </div>

                    </div>
                </div>
            </div>

            <!--=====================================-->
            <!--=     More Courses Area Start    =-->
            <!--=====================================-->
            <!-- Start Course Area  -->
            <div class="gap-bottom-equal">
                <div class="container">
                    <div class="section-title section-left" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <h3 class="title">More Courses for You</h3>
                    </div>
                    <div class="row g-5">


                        <?php
                        $moreCourse = "SELECT * FROM course 
                                    WHERE course_status = 'published' 
                                    ORDER BY RAND() LIMIT 3;";

                        $runMoreCourse = mysqli_query($conn, $moreCourse);
                        $countMoreCourse = mysqli_num_rows($runMoreCourse);

                        // echo "<script>alert(".$countMoreCourse.");</script>";

                        for ($i = 0; $i < $countMoreCourse; $i++) {

                            $rowMoreCourse = mysqli_fetch_array($runMoreCourse);

                            $categorySelect = "SELECT * from category WHERE category_id = {$rowMoreCourse['course_category']};";
                            $queryCat = mysqli_query($conn, $categorySelect);
                            $arrCat = mysqli_fetch_array($queryCat);

                            $SelectCourseVideo = "SELECT * FROM coursevideo
                            WHERE course_id='$rowMoreCourse[course_id]'";

                            $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);

                            $countvideo = mysqli_num_rows($runSelectCourseVideo);

                            $TotalDuration = 0;

                            for ($j = 1; $j <= $countvideo; $j++) {

                                $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);
                                $Duration = intval($arrCourseVideo['runTime']);
                                $TotalDuration = $TotalDuration + $Duration;
                            }

                            $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';
                            $TotalDurationHours1 = floor($TotalDuration / 60) . ':' . ($TotalDuration % 60) . ':00';




                        ?>

                            <!-- Start Single Course  -->
                            <div class="col-12 col-xl-4 col-lg-6 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-course course-style-5 inline" data-tipped-options="inline: 'inline-tooltip-1'">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <a href='courseviewdetail.php?CourseID=<?php echo $rowMoreCourse['course_id'] ?>'>
                                                <img src="<?php echo $rowMoreCourse['preview_image'] ?>" alt="Course Meta">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="course-price price-round">
                                                <?php echo $rowMoreCourse['course_price'] ?>
                                            </div>
                                            <span class="course-level"><?php echo $arrCat['category_name'] ?></span>
                                            <h5 class="title">
                                                <a href="course-details.html"><?php echo $rowMoreCourse['course_title'] ?>
                                                    Class</a>
                                            </h5>
                                            <!-- <div class="course-rating">
                                                <div class="rating">
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                </div>
                                                <span class="rating-count">(5)</span>
                                            </div> -->
                                            <p><a href="course-details.html"><?php echo $rowMoreCourse['course_subtitle'] ?>.</p>
                                            <ul class="course-meta">
                                                <li><i class="icon-24"></i><?php echo $countvideo; ?> vidoes</li>
                                                <li><i class="icon-25"></i><?php echo $TotalDurationHours ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="inline-tooltip-1" style="display:none">
                                    <div class="course-layout-five-tooltip-content">
                                        <div class="content">
                                            <span class="course-level">Cooking</span>
                                            <h5 class="title">
                                                <a href="course-details.html">Healthy Sushi Roll - Japanese Popular Cooking
                                                    Class</a>
                                            </h5>
                                            <div class="course-rating">
                                                <div class="rating">
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                    <i class="icon-23"></i>
                                                </div>
                                                <span class="rating-count">(5)</span>
                                            </div>
                                            <ul class="course-meta">
                                                <li>15 Lessons</li>
                                                <li>35 hrs</li>
                                                <li>Beginner</li>
                                            </ul>
                                            <div class="course-feature">
                                                <h6 class="title">What You’ll Learn?</h6>
                                                <ul>
                                                    <li>Professional Japanese cooking from beginners to experts</li>
                                                    <li>Will be able to cook authentic Italian recipes in their own kitchen
                                                    </li>
                                                    <li>Understand the HOW of cooking, before thinking of the WHAT to cook.
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="button-group">
                                                <a href="#" class="edu-btn btn-medium">Add to Cart</a>
                                                <a href="#" class="wishlist-btn btn-outline-dark"><i class="icon-22"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Course  -->


                        <?php
                        }
                        ?>




                    </div>
                </div>
            </div>
            <!-- End Course Area -->


        </div>

    </form>

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
    </script>

</body>


</html>