<?php
include('header.php');

$urlVideoType = '';
$videoUniqueId = '';
$quizUniquePackID = '';

if (isset($_GET['CourseID']) && isset($_GET['videoUniqueId'])) {

    $GetCourseID = $_GET['CourseID'];
    $videoUniqueId = $_GET['videoUniqueId'];

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
                            WHERE video_unique_id='$videoUniqueId'  LIMIT 1 ";

    $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);
    $countcoursevideo = mysqli_num_rows($runSelectCourseVideo);
    $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);

    $urlVideoLocation = $arrCourseVideo['location'];
    $urlVideoType = $arrCourseVideo['video_type'];
    $urlyoutube_link = $arrCourseVideo['youtube_link'];


    $UserID =  $UniqueID;
    $videoUniqueId = $_GET['videoUniqueId'];
    $CourseID = $GetCourseID;
    $CourseUniqueID = $CourseUniqueID;


    $SelectComplete = "SELECT * FROM coursecomplete
                        WHERE user_unique_id='$UserID'
                        And course_unique_id = '$CourseUniqueID'
                        And video_unique_id = '$videoUniqueId'";
    $runComplete = mysqli_query($conn, $SelectComplete);
    $countComplete = mysqli_num_rows($runComplete);
    $arrMarkComplete = mysqli_fetch_array($runComplete);

    if ($countComplete > 0) {

        $disableMarkasComplete = "disabled='disabled'";
        $disableStyle = "style='background-color:grey!important; cursor:not-allowed!important;padding: 0px 10px 0px 40px; background-color: #21bf96;'";
        $MarkAsCompleteValue = 'Completed';
    } else {

        $disableMarkasComplete = "";
        $disableStyle = "style='padding: 0px 6px 0px 4px; '";
        $MarkAsCompleteValue = 'Mark As Complete';
    }
}


if (isset($_GET['CourseID']) && isset($_GET['quizUniquePackID'])) {
    $GetCourseID = $_GET['CourseID'];
    $quizUniquePackID = $_GET['quizUniquePackID'];


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



    $selectQuizContent = "SELECT * FROM coursequiz
    WHERE quizPackage_id='$quizUniquePackID' ";
    $runSelectQuizContent = mysqli_query($conn, $selectQuizContent);
    $countQuizContent = mysqli_num_rows($runSelectQuizContent);
    // echo "<script>alert(" . $countQuizContent . ");</script>";


    $quiz;
    echo "<script>const quiz;</script>";

    for ($i = 0; $i < $countQuizContent; $i++) {

        $arrQuizPack = mysqli_fetch_array($runSelectQuizContent);
        $quiz_json = $arrQuizPack['quiz_json'];

        if (empty($quiz)) {
            $quiz = $quiz_json;
            echo "<script>quiz = " . $quiz . ";</script>";
        } else {

            $quiz_array = json_decode($quiz, true);
            $quiz_json_array = json_decode($quiz_json, true);

            $merged_array = array_merge($quiz_array, $quiz_json_array);

            $quiz = json_encode($merged_array);

            echo "<script>quiz = " . $quiz . ";</script>";
        }

        // echo "<script>";
        // echo "alert(JSON.stringify(quiz));"; // Display the quiz array in an alert
        // echo "</script>";

    }



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


    $UserID =  $UniqueID;
    $quizUniquePackID = $_GET['quizUniquePackID'];
    $CourseID = $GetCourseID;
    $CourseUniqueID = $CourseUniqueID;


    $SelectComplete = "SELECT * FROM coursecomplete
                        WHERE user_unique_id='$UserID'
                        And course_unique_id = '$CourseUniqueID'
                        And quizPack_unique_id = '$quizUniquePackID'";
    $runComplete = mysqli_query($conn, $SelectComplete);
    $countComplete = mysqli_num_rows($runComplete);
    $arrMarkComplete = mysqli_fetch_array($runComplete);


    if ($countComplete > 0) {

        $disableMarkasComplete = "disabled='disabled'";
        $disableStyle = "style='background-color:grey!important; cursor:not-allowed!important;'";
        $MarkAsCompleteValue = 'Completed';
    } else {

        $disableMarkasComplete = "";
        $disableStyle = "";
        $MarkAsCompleteValue = 'Mark As Complete';
    }
}

if (isset($_POST['MarkAsComplete'])) {

    $UserID =  $UniqueID;
    $inputVideoUniqueId = $_POST['InputvideoUniqueId'];
    $quizUniquePackID = $_POST['quizUniquePackID'];
    $CourseID = $_POST['CourseID'];
    $CourseUniqueID = $_POST['CourseUniqueID'];


    if ($inputVideoUniqueId != '' && $quizUniquePackID == null) {


        $insertComplete = "INSERT INTO coursecomplete(`user_unique_id`, `course_unique_id`, `video_unique_id`) 
                            VALUES 
                            ('$UserID','$CourseUniqueID','$inputVideoUniqueId')";

        // echo "<script>alert(" . $inputVideoUniqueId . ");</script>";


        $runInsertComplete = mysqli_query($conn, $insertComplete);
        if ($runInsertComplete) {
            echo "<script>window.alert('The Current Video is marked as Complete!')</script>";
            echo "<script>window.location='CourseWatch.php?CourseID=" . $CourseID . "&videoUniqueId=" . $inputVideoUniqueId . "'</script>";
        } else {
            echo mysqli_error($conn);
            echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
        }
    } else if ($videoUniqueId == null && $quizUniquePackID != '') {

        // echo "<script>window.alert('Quiz')</script>";

        $CourseMaterialUniqueID = $quizUniquePackID;

        $insertComplete = "INSERT INTO coursecomplete(`user_unique_id`, `course_unique_id`, `quizPack_unique_id`) 
        VALUES 
        ('$UserID','$CourseUniqueID','$CourseMaterialUniqueID')";

        $runInsertComplete = mysqli_query($conn, $insertComplete);
        if ($runInsertComplete) {
            echo "<script>window.alert('The Current Course Quiz is marked as Complete!')</script>";
            echo "<script>window.location='CourseWatch.php?CourseID=" . $CourseID . "&quizUniquePackID=" . $CourseMaterialUniqueID . "'</script>";
        } else {
            echo mysqli_error($conn);
            echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
        }
    }
}

if (isset($_GET['CourseID'])) {

    // Progress Bar Calculation
    $courseID = $_GET['CourseID'];

    $SelectPublishedCourse = "SELECT * FROM course
                                WHERE course_id = '$courseID'";
    $runPublishedCourse = mysqli_query($conn, $SelectPublishedCourse);
    $arrPublishedCourse = mysqli_fetch_array($runPublishedCourse);

    $courseUniqueId = $arrPublishedCourse['course_unique_id'];

    $SelectTotalQuizPack = "SELECT * FROM quizpackage
                        WHERE course_id='$courseID' ";
    $runTotalQuizPack = mysqli_query($conn, $SelectTotalQuizPack);
    $countQuizPack = mysqli_num_rows($runTotalQuizPack);

    $SelectCourseVdo = "SELECT * FROM coursevideo
                        WHERE course_id='$courseID' ";
    $runTotalVdo = mysqli_query($conn, $SelectCourseVdo);
    $countTotalVdo = mysqli_num_rows($runTotalVdo);

    $totalCourseMaterial = $countQuizPack + $countTotalVdo; //Total Course Material


    $TotalComplete = "SELECT * FROM coursecomplete
                        WHERE course_unique_id = '$courseUniqueId' && user_unique_id = '" . $_SESSION['unique_id'] . "'";

    $runTotalComplete = mysqli_query($conn, $TotalComplete);
    $countTotalComplete = mysqli_num_rows($runTotalComplete); // Total Complete

    $TotalComplete100 = $countTotalComplete * 100;
    $PercentageComplete = $TotalComplete100 / $totalCourseMaterial;
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
    <link rel="stylesheet" href="assets/css/quizStyle.css">


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

        .Content_Active {
            background-color: rgba(42, 65, 232, 0.07);
            color: orange !important;
        }

        .steps_btn:active {

            transform: scale(0.95) !important;
            color: orange;
        }

        svg[role="progressbar"] {

            width: 136px;
        }
    </style>

</head>

<body class="sticky-header ">

    <form action="CourseWatch.php" method="post" enctype="multipart/form-data">


        <input type="hidden" name="InputvideoUniqueId" value="<?php echo $videoUniqueId ?>">
        <input type="hidden" name="quizUniquePackID" value="<?php echo $quizUniquePackID ?>">
        <input type="hidden" name="CourseID" value="<?php echo $CourseID ?>">
        <input type="hidden" name="CourseUniqueID" value="<?php echo $CourseUniqueID ?>">

        <!-- Display errors returned by checkout session -->
        <div id="paymentResponse" class="hidden"></div>


        <div id="main-wrapper" class="main-wrapper">


            <!--=====================================-->
            <!--=       Breadcrumb Area Start      =-->
            <!--=====================================-->

            <?php
            if ($urlVideoType != '' && $urlVideoType == 'UploadedVideo') {


            ?>


                <div class="video-container paused" data-volume-level="high" style="margin-bottom: 50px; margin-top: 50px;">
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


                    <video src="<?php echo $urlVideoLocation; ?>">
                        <track kind="captions" srclang="en" src="assets/subtitles.vtt">
                    </video>
                </div>


                <div class="row justify-content-between">
                    <div class="col-5 col-lg-2 col-md-3 col-sm-3" style="margin-left: 3%;">
                        <button type="submit" class="edu-btn steps_btn" name="MarkAsComplete" <?php echo $disableStyle;
                                                                                                echo $disableMarkasComplete; ?>>
                            <strong><?php echo $MarkAsCompleteValue; ?></strong>
                            <i class="fas fa-check"></i>

                        </button>

                    </div>
                    <?php


                    if ($countTotalComplete == $totalCourseMaterial) {
                      

                        $CourseCertificate = 'Certificate for completion of ' . $CourseTitle;
                        $CertificateUniqueID =  uniqid('Certificate') . date("Ymd") . time() . $CourseUniqueID . $UniqueID;


                        $date_complete = date("jS  F Y ");

                        $SelectCertificate = "SELECT * FROM certificate_completion
                                            WHERE user_unique_id='$UniqueID'
                                            And course_unique_id = '$CourseUniqueID'";
                        $runSelectCertificate = mysqli_query($conn, $SelectCertificate);
                        $countSelectCertificate = mysqli_num_rows($runSelectCertificate);

                        echo "<script>alert('" .$countSelectCertificate. "');</script>";

                        if ($countSelectCertificate < 1) {

                            $font =  realpath('Brushsci.ttf');
                            $image = imagecreatefromjpeg("certificate.jpg");
                            $color = imagecolorallocate($image, 19, 21, 22);
                            $name = $UserFullName;
                            imagettftext($image, 140, 0, 1100, 1000, $color, $font, $name);
                            $date = $date_complete;
                            $font1 =  realpath('AGENCYR.TTF');
                            imagettftext($image, 50, 0, 750, 1485, $color, $font1, $date);
                            $font2 = realpath('Raleway-BoldItalic.ttf');
                            $Course = $CourseTitle; //Limit the course name to 40 characters
                            $Duration = $TotalDurationHours;
                            $Textual = $Course . " " . "• " . $Duration . " Hours";
                            imagettftext($image, 35, 0, 800, 1100, $color, $font2, $Textual);

                            imagejpeg($image, "Certificate/" . $CertificateUniqueID . ".jpg");
                            $certificateImgLocation = "Certificate/" . $CertificateUniqueID . ".jpg";

                            $InsertCertificate = "INSERT INTO certificate_completion ( certificate_unique_id ,certificate_name, date_complete, user_unique_id, course_unique_id, certificate_img)
                                                VALUES
                                                ('$CertificateUniqueID','$CourseCertificate','$date_complete','$UniqueID', '$CourseUniqueID', '$certificateImgLocation') ";

                            $runInsertCertificate = mysqli_query($conn, $InsertCertificate);

                            if ($runInsertCertificate) {
                                echo "<script>window.alert('Congrats on completion of " . $CourseTitle . " Course. You can download the certificate!')</script>";
                            } else {
                                echo mysqli_error($conn);
                                echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
                            }
                        }






                    ?>
                        <div class="col-6 col-lg-2 col-md-3 col-sm-3" style="margin-right: 3%;">
                            <button type="button" class="edu-btn steps_btn" name="DownloadCertificate" style="font-size: 13px; padding: 0px 6px 0px 4px;" onclick="window.open('downloadCertificate.php?courseUniqueID=<?php echo $CourseUniqueID ?>', '_blank');">
                                <strong>Download Certificate</strong>
                                <i class="fas fa-download" style="font-size: 18px;"></i>

                            </button>

                        </div>

                    <?php
                    } else {

                    ?>
                        <div class="col-6 col-lg-3 col-md-3 col-sm-3" style="margin-right: 3%;">

                            <p style="font-size: 10px;">Complete all course material to download certificate</p>
                        </div>

                    <?php
                    }

                    ?>


                </div>



            <?php
            } else if ($urlVideoType == 'youtubeVideo') {

                $url = $urlyoutube_link;
                $parts = parse_url($url);
                parse_str($parts['query'], $query);
                $video_id = $query['v'];

            ?>

                <div style="margin-bottom: 50px; margin-top: 50px;position: relative; width: 100%; height:100%; display: flex; justify-content: center;">
                    <iframe width="1060" height="515" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

                </div>

                <div class="row justify-content-between">
                    <div class="col-5 col-lg-2 col-md-3 col-sm-3" style="margin-left: 3%;">
                        <button type="submit" class="edu-btn steps_btn" name="MarkAsComplete" <?php echo $disableStyle;
                                                                                                echo $disableMarkasComplete; ?>>
                            <strong><?php echo $MarkAsCompleteValue; ?></strong>
                            <i class="fas fa-check"></i>

                        </button>

                    </div>
                    <?php
                    if ($countTotalComplete == $totalCourseMaterial) {

                        $CourseCertificate = 'Certificate for completion of ' . $CourseTitle;
                        $CertificateUniqueID =  uniqid('Certificate') . date("Ymd") . time() . $CourseUniqueID . $UniqueID;


                        $date_complete = date("jS  F Y ");

                        $SelectCertificate = "SELECT * FROM certificate_completion
                                            WHERE user_unique_id='$UniqueID'
                                            And course_unique_id = '$CourseUniqueID'";
                        $runSelectCertificate = mysqli_query($conn, $SelectCertificate);
                        $countSelectCertificate = mysqli_num_rows($runSelectCertificate);

                        if ($countSelectCertificate < 1) {

                            $font =  realpath('Brushsci.ttf');
                            $image = imagecreatefromjpeg("certificate.jpg");
                            $color = imagecolorallocate($image, 19, 21, 22);
                            $name = $UserFullName;
                            imagettftext($image, 140, 0, 1100, 1000, $color, $font, $name);
                            $date = $date_complete;
                            $font1 =  realpath('AGENCYR.TTF');
                            imagettftext($image, 50, 0, 750, 1485, $color, $font1, $date);
                            $font2 = realpath('Raleway-BoldItalic.ttf');
                            $Course = $CourseTitle; //Limit the course name to 40 characters
                            $Duration = $TotalDurationHours;
                            $Textual = $Course . " " . "• " . $Duration . " Hours";
                            imagettftext($image, 35, 0, 800, 1100, $color, $font2, $Textual);

                            imagejpeg($image, "Certificate/" . $CertificateUniqueID . ".jpg");
                            $certificateImgLocation = "Certificate/" . $CertificateUniqueID . ".jpg";

                            $InsertCertificate1 = "INSERT INTO certificate_completion ( certificate_unique_id ,certificate_name, date_complete, user_unique_id, course_unique_id, certificate_img)
                                                VALUES
                                                ('$CertificateUniqueID','$CourseCertificate','$date_complete','$UniqueID', '$CourseUniqueID', '$certificateImgLocation') ";

                            $runInsertCertificate1 = mysqli_query($conn, $InsertCertificate1);

                            if ($runInsertCertificate1) {
                                echo "<script>window.alert('Congrats on completion of " . $CourseTitle . " Course. You can download the certificate!')</script>";
                            } else {
                                echo mysqli_error($conn);
                                echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
                            }
                        }



                    ?>
                        <div class="col-6 col-lg-2 col-md-3 col-sm-3" style="margin-right: 3%;">
                            <button type="button" class="edu-btn steps_btn" name="DownloadCertificate" style="font-size: 13px; padding: 0px 6px 0px 4px;" onclick="window.open('downloadCertificate.php?courseUniqueID=<?php echo $CourseUniqueID ?>', '_blank');">
                                <strong>Download Certificate</strong>
                                <i class="fas fa-download" style="font-size: 18px;"></i>

                            </button>

                        </div>

                    <?php
                    } else {

                    ?>
                        <div class="col-6 col-lg-3 col-md-3 col-sm-3" style="margin-right: 3%;">

                            <p style="font-size: 10px;">Complete all course material to download certificate</p>
                        </div>

                    <?php
                    }

                    ?>


                </div>



            <?php

            } else {

            ?>

                <div class="quizContainer">
                    <div class="quizBox col-lg-6 col-md-8">
                        <div class="home-box custom-box">
                            <h3>Instruction:</h3>
                            <p>Total number of questions: <span class="total-question"></span></p>
                            <button type="button" class="btnQuiz" onclick="startQuiz()">Start Quiz</button>
                        </div>

                        <div class="quiz-box custom-box hide">
                            <div class="question-number">

                            </div>
                            <div class="question-text">

                            </div>
                            <div class="option-container">

                            </div>
                            <div class="next-question-btn">
                                <button type="button" class="btnQuiz answerNotChosen" onclick="next()">Next</button>
                            </div>
                            <div class="answers-indicator">

                            </div>


                        </div>

                        <span class="notAnswerNoti hide">
                            Answer the question to continue!
                        </span>




                        <div class="result-box custom-box hide">
                            <h1>Quiz Result</h1>
                            <table>
                                <tr>
                                    <td>Total Question</td>
                                    <td><span class="total-question"></span></td>
                                </tr>
                                <tr>
                                    <td>Attempt</td>
                                    <td><span class="total-attempt"></span></td>
                                </tr>
                                <tr>
                                    <td>Correct</td>
                                    <td><span class="total-correct"></span></td>
                                </tr>
                                <tr>
                                    <td>Wrong</td>
                                    <td><span class="total-wrong"></span></td>
                                </tr>
                                <tr>
                                    <td>Percentage</td>
                                    <td><span class="percentage"></span></td>
                                </tr>
                                <tr>
                                    <td>Your Total Score</td>
                                    <td><span class="total-score"><span></td>
                                </tr>
                            </table>
                            <button type="button" class="btnQuiz" onclick="goToHome()">Try Again<i class="fas fa-redo"></i></button>
                            <button type="submit" class="btnQuiz" name="MarkAsComplete" <?php echo $disableStyle;
                                                                                        echo $disableMarkasComplete; ?>>
                                <?php echo $MarkAsCompleteValue; ?>
                                <i class="fas fa-check"></i>

                            </button>
                            <?php
                            if ($countTotalComplete == $totalCourseMaterial) {

                                $CourseCertificate = 'Certificate for completion of ' . $CourseTitle;
                                $CertificateUniqueID =  uniqid('Certificate') . date("Ymd") . time() . $CourseUniqueID . $UniqueID;


                                $date_complete = date("jS  F Y ");

                                $SelectCertificate = "SELECT * FROM certificate_completion
                                                    WHERE user_unique_id='$UniqueID'
                                                    And course_unique_id = '$CourseUniqueID'";
                                $runSelectCertificate = mysqli_query($conn, $SelectCertificate);
                                $countSelectCertificate = mysqli_num_rows($runSelectCertificate);


                                if ($countSelectCertificate < 1) {

                                    $font =  realpath('Brushsci.ttf');
                                    $image = imagecreatefromjpeg("certificate.jpg");
                                    $color = imagecolorallocate($image, 19, 21, 22);
                                    $name = $UserFullName;
                                    imagettftext($image, 140, 0, 1100, 1000, $color, $font, $name);
                                    $date = $date_complete;
                                    $font1 =  realpath('AGENCYR.TTF');
                                    imagettftext($image, 50, 0, 750, 1485, $color, $font1, $date);
                                    $font2 = realpath('Raleway-BoldItalic.ttf');
                                    $Course = $CourseTitle; //Limit the course name to 40 characters
                                    $Duration = $TotalDurationHours;
                                    $Textual = $Course . " " . "• " . $Duration . " Hours";
                                    imagettftext($image, 35, 0, 800, 1100, $color, $font2, $Textual);

                                    imagejpeg($image, "Certificate/" . $CertificateUniqueID . ".jpg");

                                    $certificateImgLocation = "Certificate/" . $CertificateUniqueID . ".jpg";

                                    // $InsertCertificate2 = "INSERT INTO certificate_completion ( certificate_unique_id ,certificate_name, date_complete, user_unique_id, course_unique_id, certificate_img)
                                    //                     VALUES
                                    //                     ('$CertificateUniqueID','$CourseCertificate','$date_complete','$UniqueID', '$CourseUniqueID', '$certificateImgLocation') ";

                                    // $runInsertCertificate2 = mysqli_query($conn, $InsertCertificate2);

                                    // echo "<script>window.alert('hihihih')</script>";


                                    // if ($runInsertCertificate2) {
                                    //     echo "<script>window.alert('Congrats on completion of " . $CourseTitle . " Course. You can download the certificate!')</script>";
                                    // } else {
                                    //     echo mysqli_error($conn);
                                    //     echo "<p>Something went wrong in " . mysqli_error($conn) . "</p>";
                                    // }
                                }



                            ?>
                                <button type="button" class="btnQuiz" name="DownloadCertificate" style="margin-top: 10px;" onclick="window.open('downloadCertificate.php?courseUniqueID=<?php echo $CourseUniqueID ?>', '_blank');">
                                    Download Certificate
                                    <i class="fas fa-download"></i>

                                </button>




                            <?php
                            }

                            ?>



                        </div>
                    </div>
                </div>

            <?php
            }
            ?>


            <!--=====================================-->
            <!--=     Courses Details Area Start    =-->
            <!--=====================================-->
            <section class="edu-section-gap course-details-area" style="padding: 0px!important;">
                <div class="container">
                    <div class="row row--30">
                        <div class="col-lg-12">
                            <div class="course-details-content" style="margin-bottom: 50px;">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="carriculam-tab" data-bs-toggle="tab" data-bs-target="#carriculam" type="button" role="tab" aria-controls="carriculam" aria-selected="false">Curriculum</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link " id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Overview</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor" aria-selected="false">Instructor</button>
                                    </li>


                                </ul>

                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                                        <div class="course-tab-content">
                                            <div class="course-curriculam">

                                                <div class="container mb-5">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <div class="pie" data-pie='{ "speed": 30, "percent": <?php echo $PercentageComplete; ?>, "colorSlice": "#ffb429", "colorCircle": "#f1f1f1", "round": true }'></div>

                                                        </div>
                                                        <div class="col-md-5 d-flex align-items-center">
                                                            <div class="d-flex flex-column">
                                                                <h3 class="heading-title"><?php echo round($PercentageComplete, 0) . "% Complete out of"; ?></h3>

                                                                <div class="mt-auto" style="font-size: 20px;"><?php echo $countTotalVdo . ' '; ?><span style="color: var(--color-primary);">Videos</span> & <?php echo $countQuizPack . ' '; ?><span style="color: var(--color-primary);">Quiz</span></div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>



                                                <h3 class="heading-title"><?php echo $CourseTitle . " Course"; ?></h3>
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-md-2  col-sm-3">
                                                                <p><b><?php echo $countvideo; ?> <span style="color: var(--light-gradient);">Lectures</span></b></p>
                                                            </div>
                                                            <div class="col-md-2  col-sm-3">
                                                                <?php
                                                                $selectQuizPack = "SELECT * FROM quizpackage WHERE course_id='$GetCourseID'";
                                                                $runSelectQuizPack = mysqli_query($conn, $selectQuizPack);
                                                                $countQuizPack = mysqli_num_rows($runSelectQuizPack);
                                                                if ($countQuizPack > 0) {
                                                                ?>
                                                                    <p><b><?php echo $countQuizPack; ?> <span style="color: var(--light-gradient);">Quiz</span></b></p>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-sm-3 text-right">
                                                        <p><b><?php echo $TotalDurationHours1; ?> <span style="color: var(--light-gradient);">Course Duration</span></b></p>
                                                    </div>

                                                </div>
                                                <div class="course-lesson">
                                                    <h5 class="title"><?php echo $CourseTitle; ?></h5>
                                                    <p><?php echo $CourseSubtitle; ?></p>
                                                    <ul style="cursor:pointer;">

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
                                                                        $TableVideoUniqueID = $arrSelectvideo['video_unique_id'];
                                                                        $TableVideoName = $arrSelectvideo['video_name'];
                                                                        $TableDuration = $arrSelectvideo['runTime'];
                                                                        $TableUploadDate = $arrSelectvideo['update_date'];
                                                                        $videoType = $arrSelectvideo['video_type'];
                                                                        $active = '';
                                                                        if ($videoUniqueId == $TableVideoUniqueID && $videoUniqueId != '') {

                                                                            $active = 'Content_Active';
                                                                        } else {
                                                                            $active = '';
                                                                        }


                                                                        $SelectComplete = "SELECT * FROM coursecomplete
                                                                                            Where video_unique_id = '$TableVideoUniqueID' && user_unique_id='" . $_SESSION['unique_id'] . "' ";
                                                                        $runComplete = mysqli_query($conn, $SelectComplete);
                                                                        $countComplete = mysqli_num_rows($runComplete);

                                                                        if ($countComplete > 0) {

                                                                            $showStatus = "style='display:block;'";
                                                                            $statusText = "Completed";
                                                                        } else {

                                                                            $showStatus = "style='display:none;'";
                                                                            $statusText = "";
                                                                        }

                                                                        //    echo "<script>alert(".$TableVideoId.");</script>";

                                                                        echo "<li class='" . $active . "'>";


                                                                        echo " <a href='CourseWatch.php?CourseID=" . $courseId . "&videoUniqueId=" . $video_unique_id . "  ' class=\"text " . $active . " \"><i class=\"fas fa-video-camera\"></i>" . $TableVideoName . "</a>";

                                                                        echo "
                                                                                <div class=\"icon\" " . $showStatus . " ><span class=\"badge badge-warning\">" . $statusText . " </span></div>
                                                                                <div class=\"icon\"><span class=\"badge badge-secondary\">" . $TableDuration . " Minutes</span><i class=\"fa-solid fa-chevron-right\" style=\" margin-left:40px; \"></i></div>

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

                                                                        $active = '';
                                                                        if ($quizUniquePackID == $TableQuizPackId && $quizUniquePackID != '') {

                                                                            $active = 'Content_Active';
                                                                        } else {
                                                                            $active = '';
                                                                        }

                                                                        $SelectComplete = "SELECT * FROM coursecomplete
                                                                                            Where quizPack_unique_id = '$TableQuizPackId' && user_unique_id='" . $_SESSION['unique_id'] . "' ";
                                                                        $runComplete = mysqli_query($conn, $SelectComplete);
                                                                        $countComplete = mysqli_num_rows($runComplete);

                                                                        if ($countComplete > 0) {

                                                                            $showStatus = "style='display:block;'";
                                                                            $statusText = "Completed";
                                                                        } else {

                                                                            $showStatus = "style='display:none;'";
                                                                            $statusText = "";
                                                                        }


                                                                        $selectQuizContent = "SELECT * FROM coursequiz
                                                                                    WHERE quizPackage_id='$TableQuizPackId' ";
                                                                        $runSelectQuizContent = mysqli_query($conn, $selectQuizContent);
                                                                        $countQuizContent = mysqli_num_rows($runSelectQuizContent);



                                                                        echo "<li class='" . $active . "'>";


                                                                        echo " <a href='CourseWatch.php?CourseID=" . $courseId . "&quizUniquePackID=" . $TableQuizPackId . "  ' class=\"text " . $active . " \"><i class=\"icon-65\"></i>" . $TableQuizPackName . "</a>";

                                                                        echo "
                                                                            <div class=\"icon\" " . $showStatus . " ><span class=\"badge badge-warning\">" . $statusText . " </span></div>

                                                                            <div class=\"icon\"><span class=\"badge badge-primary\">" . $countQuizContent . " Question</span><i class=\"fa-solid fa-chevron-right\" style=\" margin-left:40px; \"></i></div>

                                                                         </li>";
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        ?>





                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                        <div class="course-tab-content">
                                            <div class="course-overview">
                                                <h3 class="heading-title">Course Description</h3>
                                                <p><?php echo $CourseDescription; ?></p>
                                                <h3 class="heading-title">Prerequisites</h3>
                                                <p class="mb--60"><?php echo $CourseRequirement; ?></p>
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
                                    <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                        <div class="course-tab-content">
                                            <div class="course-instructor">
                                                <div class="thumbnail">
                                                    <img src="<?php echo $InstructorImage; ?>" alt="Author Images">
                                                </div>
                                                <div class="author-content">
                                                    <h6 class="title"><?php echo $FullName; ?></h6>
                                                    <span class="subtitle">Founder & CEO</span>
                                                    <p>Consectetur adipisicing elit, sed do eiusmod tempor incididunt labore et dolore magna aliqua enim minim veniam quis nostrud exercitation ulla mco laboris nisi ut aliquip ex ea commodo consequat. duis aute irure dolor in reprehenderit in voluptate.</p>
                                                    <ul class="social-share">
                                                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                        <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                                        <li><a href="#"><i class="icon-youtube"></i></a></li>
                                                    </ul>
                                                </div>
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

    </form>

    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>


    <!-- Footer Section -->
    <?php include_once "footer.php";  ?>

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
    <script src="assets/js/quizFunction.js"></script>
    <script src="assets/js/circularprogressbar.js"></script>

    <!-- Stripe js library -->
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

    <!-- Circular Progress bar Script -->
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            // update circle when range change
            const pie = document.querySelectorAll(".pie");



            // start the animation when the element is in the page view
            const elements = [].slice.call(document.querySelectorAll(".pie"));
            const circle = new CircularProgressBar("pie");

            // circle.initial();

            if ("IntersectionObserver" in window) {
                const config = {
                    root: null,
                    rootMargin: "0px",
                    threshold: 0.75,
                };

                const ovserver = new IntersectionObserver((entries, observer) => {
                    entries.map((entry) => {
                        if (entry.isIntersecting && entry.intersectionRatio >= 0.75) {
                            circle.initial(entry.target);
                            observer.unobserve(entry.target);
                        }
                    });
                }, config);

                elements.map((item) => {
                    ovserver.observe(item);
                });
            } else {
                elements.map((element) => {
                    circle.initial(element);
                });
            }

            setInterval(() => {
                const typeFont = [100, 200, 300, 400, 500, 600, 700];
                const colorHex = `#${Math.floor(
            (Math.random() * 0xffffff) << 0
          ).toString(16)}`;
                const options = {
                    index: 17,
                    percent: Math.floor(Math.random() * 100 + 1),
                    colorSlice: colorHex,
                    fontColor: colorHex,
                    fontSize: `${Math.floor(Math.random() * (1.4 - 1 + 1) + 1)}rem`,
                    fontWeight: typeFont[Math.floor(Math.random() * typeFont.length)],
                };
                circle.animationTo(options);
            }, 3000);




        });
    </script>




</body>


</html>