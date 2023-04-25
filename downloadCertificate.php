<?php

session_start();
include('config.php');


$allowed_pages = array('createNewCourse.php', 'createCurriculum.php', 'uploadMedia.php', 'setPrice.php');

if (!in_array(basename($_SERVER['PHP_SELF']), $allowed_pages)) {
    unset($_SESSION['course_unique_id']);
    unset($_SESSION['editCourseid']);
}

if (!isset($_SESSION['unique_id'])) {
    header("location: signup.php");
} else {

    $UniqueID = $_SESSION['unique_id'];

    $SelectUserID = "SELECT * FROM users
                     WHERE unique_id ='$UniqueID'";
    $runSelectUserID = mysqli_query($conn, $SelectUserID);
    $countSelectUserID = mysqli_num_rows($runSelectUserID);
    $arrUserID = mysqli_fetch_array($runSelectUserID);

    $UserID = $arrUserID['user_id'];
    $fullName = $arrUserID['fullName'];
}


if (isset($_GET['courseUniqueID'])) {

    $courseUniqueID = $_GET['courseUniqueID'];

    $SelectPublishedCourse = "SELECT * FROM course
                                WHERE course_unique_id = '$courseUniqueID'";
    $runPublishedCourse = mysqli_query($conn, $SelectPublishedCourse);
    $arrPublishedCourse = mysqli_fetch_array($runPublishedCourse);


    $CourseID = $arrPublishedCourse['course_id'];
    $course_title = $arrPublishedCourse['course_title'];

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

    $SelectCertificate = "SELECT * FROM certificate_completion
                            WHERE user_unique_id='$UniqueID'
                            And course_unique_id = '$courseUniqueID'";
    $runSelectCertificate = mysqli_query($conn, $SelectCertificate);
    $countSelectCertificate = mysqli_num_rows($runSelectCertificate);

    $arrCourseComplete = mysqli_fetch_array($runSelectCertificate);

    $date_complete = $arrCourseComplete['date_complete'];
    $certificate_unique_id = $arrCourseComplete['certificate_unique_id'];
}






header('content-type:image/jpeg');
$font =  realpath('Brushsci.ttf');
$image = imagecreatefromjpeg("certificate.jpg");
$color = imagecolorallocate($image, 19, 21, 22);
$name = $fullName;
imagettftext($image, 140, 0, 1100, 1000, $color, $font, $name);
$date = $date_complete;
$font1 =  realpath('AGENCYR.TTF');
imagettftext($image, 50, 0, 750, 1485, $color, $font1, $date);
$font2 = realpath('Raleway-BoldItalic.ttf');
$Course = $course_title; //Limit the course name to 40 characters
$Duration = $TotalDurationHours;
$Textual = $Course . " " . "• " . $Duration . " Hours";
imagettftext($image, 35, 0, 800, 1100, $color, $font2, $Textual);

imagejpeg($image);
// imagejpeg($image, "Certificate/" . $certificate_unique_id . ".jpg");
imagedestroy($image);

?>
