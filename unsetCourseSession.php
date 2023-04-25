
<?php
    session_start();
    include_once "../config.php";

    $allowed_pages = array('createNewCourse.php', 'createCurriculum.php', 'uploadMedia.php', 'setPrice.php');

    if (!in_array($_SERVER['PHP_SELF'], $allowed_pages)) {
        unset($_SESSION['course_unique_id']);
    }


?>