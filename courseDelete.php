<?php
session_start();
include_once "config.php";


$user_id = $_SESSION['instructor_id'];

if (!isset($_SESSION['instructor_id']) || $_SESSION['instructor_id'] == '' || $_SESSION['instructor_id'] == null) {
    echo "<script>window.alert('User Session Expired. Please Log in again!');</script>";
    echo "<script>window.location='login.php'</script>";
}

if (isset($_GET['deleteCourseid'])) {
    $deleteCourseid = $_GET['deleteCourseid'];

    $selectCourse = mysqli_query($conn, "SELECT * FROM course
    WHERE course_unique_id = '{$deleteCourseid}'");

    $courseRow = mysqli_fetch_array($selectCourse);
    $courseID = $courseRow['course_id'];

    $displayBlockQuiz = "visible";

    $deleteCourse = mysqli_query($conn, "DELETE FROM course
                                        WHERE course_unique_id = '{$deleteCourseid}';
                                        ");
    if (!$deleteCourse) {
        die("Delete query failed: " . mysqli_error($conn));
    }
    else{
    echo "<script>alert('Delete Success!');</script>";
    echo "<script>window.location='CourseList.php';</script>";

    }

    // $deleteCourseVideo = mysqli_query($conn, "DELETE FROM course
    // WHERE course_id = '{$courseID}';
    // ");
    // if (!$deleteCourseVideo) {
    //     die("Delete query failed: " . mysqli_error($conn));
    // }

    // $selectQuizPack = mysqli_query($conn, "SELECT * FROM quizpackage
    // WHERE course_id = '{$courseID}'");

    // $quizPackRow = mysqli_fetch_array($selectQuizPack);
    // $quizPackUniqueID = $quizPackRow['quizPackage_unique_id'];



    // $deleteCourseQuiz = mysqli_query($conn, "DELETE FROM coursequiz
    // WHERE quizPackage_id = '{$quizPackUniqueID}';
    // ");
    // if (!$deleteCourseQuiz) {
    //     die("Delete query failed: " . mysqli_error($conn));
    // }

    // $deleteQuizPack = mysqli_query($conn, "DELETE FROM quizpackage
    // WHERE course_id = '{$courseID}';
    // ");
    // if (!$deleteQuizPack) {
    //     die("Delete query failed: " . mysqli_error($conn));
    // }



} else {
    echo "<script>alert('something went wrong, try again!');</script>";
}
