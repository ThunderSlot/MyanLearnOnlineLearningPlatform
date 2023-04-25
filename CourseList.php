<?php

include_once "instructorheader.php";
include_once "config.php";


$user_id = $_SESSION['instructor_id'];

if (!isset($_SESSION['instructor_id']) || $_SESSION['instructor_id'] == '' || $_SESSION['instructor_id'] == null) {
    echo "<script>window.alert('User Session Expired. Please Log in again!');</script>";
    echo "<script>window.location='login.php'</script>";
}








?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Lists | MyanLearn Instructor</title>

    <!-- Main Css File -->
    <link rel="stylesheet" href="assets/css/instructordashboard.css">
    <link rel="stylesheet" href="assets/css/createNewCourse.css">
    <link rel="stylesheet" href="assets/css/variable.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/variable.css">

    <!-- For icon tab -->
    <link rel="icon" href="assets/images/logomobile.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <!-- Vendor -->
    <link href="assets\vendor\bootstrap\css\bootstrap.css" rel="stylesheet">
    <link href="assets\vendor\bootstrap\css\bootstrap-grid.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <!-- For data table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" />



    <style>
        .visible {
            display: block;
        }

        .CoverPhoto::before,
        .CoverPhoto::after {
            display: none !important;
        }
        td{
            vertical-align: middle;
        }
    </style>

</head>

<body>



    <section class="home">
        <div class="text"></div>

        <main id="main" class="main">

            <div class="pagetitle">
                <h1><img src="assets/images/Courses.svg" alt="" style="margin-right: 5px; width: 32px; height: 32px;">Courses</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="instructordashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Course List</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->


            <div class="container mt-4">

                <div class="row my-4">
                    <div class="col-lg-6">
                        <button class="main-btn color btn-hover ml-left" type="button" onclick="location.href='createNewCourse.php';">Create New Courses</button>
                    </div>
                </div>

                <div class="row mt-30">
                    <div class="col-lg-12 col-md-12">

                        <?php

                        $SelectCourse = "SELECT * FROM course
                                            WHERE instructor_id='$user_id'";
                        $runSelectCourse = mysqli_query($conn, $SelectCourse);
                        $countrunSelectCourse = mysqli_num_rows($runSelectCourse);

                        if ($countrunSelectCourse == 0) {
                            echo "<p style='font-weight:600; font-size:18px; margin-bottom: 20px; color:#666666;'>Currently, there is no Course Package Created !</p>";
                        } else {


                        ?>

                            <div class="container dataTable">
                                <div class="row">
                                    <div class="mb-4 mt-3" style="overflow-x:auto;">
                                        <table id="example" class="display table table-responsive hover" style="width:100%">
                                            <thead style="background-color: #FFECEC;">
                                                <tr>
                                                    <th class="CoverPhoto">Cover Photo</th>
                                                    <th>Title</th>
                                                    <th>Language</th>
                                                    <th>Level</th>
                                                    <th>Total Duration</th>
                                                    <th>Latest Date</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                for ($i = 0; $i < $countrunSelectCourse; $i++) {


                                                    $arrCourse = mysqli_fetch_array($runSelectCourse);


                                                    $course_unique_id = $arrCourse['course_unique_id'];
                                                    $course_id = $arrCourse['course_id'];
                                                    $preview_image = $arrCourse['preview_image'];
                                                    $course_title = $arrCourse['course_title'];
                                                    $course_date = $arrCourse['course_latest_date'];
                                                    $course_category = $arrCourse['course_category'];
                                                    $course_status = $arrCourse['course_status'];
                                                    $course_langugae = $arrCourse['course_langugae'];
                                                    $course_level = $arrCourse['course_level'];

                                                    $categorySelect = "SELECT * from category WHERE category_id = {$course_category};";
                                                    $queryCat = mysqli_query($conn, $categorySelect);
                                                    $arrCat = mysqli_fetch_array($queryCat);



                                                    $selectVideo = "SELECT *,SUM(runTime) AS total_duration FROM coursevideo
                                                                        WHERE course_id='$course_id'";
                                                    $runSelectVideo = mysqli_query($conn, $selectVideo);
                                                    $arrVideo = mysqli_fetch_array($runSelectVideo);

                                                    $total_duration = $arrVideo['total_duration'];



                                                    echo "<tr>";

                                                    if ($preview_image == "" || $preview_image == null) {
                                                        echo  "<td><img src='assets/images/PreviewImage.jpg' alt='' style='width:130px; border-radius:10px;'></td>";
                                                    } else {
                                                        echo  "<td><img src='" . $preview_image . "' alt='' style='width:130px;border-radius:10px;'></td>";
                                                    }

                                                    echo  "<td>$course_title</td>";
                                                    echo  "<td>$course_langugae</td>";
                                                    echo  "<td>$course_level</td>";
                                                    echo  "<td>" . $total_duration . " Minutes</td>";
                                                    echo  "<td>$course_date</td>";
                                                    echo '<td>' . ((strlen($arrCat['category_name']) > 11) ? substr($arrCat['category_name'], 0, 11) . '..' : $arrCat['category_name']) . '</td>';

                                                    if ($course_status == "published") {
                                                        echo  "<td class='text-success'>Published</td>";
                                                    } else {
                                                        echo  "<td class='text-danger'>Pending</td>";
                                                    }
                                                    echo  "<td class=\"d-flex justify-content-around\">

                                                        <button type='button' class=\"btn btn-primary m-1 mt-2\" style=\" background-color: #0d6efd!important;\"  name=\"editCourseBtn\" data-target-edit='" . $course_unique_id . "' onclick='onClickEdit(this)' ><i class=\"fas fa-edit\"></i></button>
                                                        <button type='button' class=\"btn btn-danger m-1 mt-2\" style=\" background-color: #dc3545!important;\" name=\"deleteCourseBtn\" data-target-delete='" . $course_unique_id . "' onclick='onClickDelete(this)' ><i class=\"far fa-trash-alt\"></i></button>
                                                        ";


                                                    echo "</td>";




                                                    echo "</tr>";
                                                }

                                                ?>

                                            </tbody>

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


        </main><!-- End #main -->

    </section>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pagingType: 'full_numbers',
            });


        });
    </script>

    <script>
        function onClickEdit(btn) {
            var editCourseid = btn.getAttribute('data-target-edit');
            window.location.href = 'createNewCourse.php?editCourseid=' + editCourseid;

        }
        function onClickDelete(btn) {
            var deleteCourseid = btn.getAttribute('data-target-delete');
            window.location.href = 'courseDelete.php?deleteCourseid=' + deleteCourseid;

        }
    </script>


</body>

</html>