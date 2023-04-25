<?php
include_once "instructorheader.php";
include_once "config.php";

$sqlCourse = "SELECT * FROM course WHERE instructor_id = {$_SESSION['unique_id']}";
$queryCourse = mysqli_query($conn, $sqlCourse);
$arrCourse = mysqli_fetch_array($queryCourse);
$countCourse = mysqli_num_rows($queryCourse);


$month = date('m'); // the month to count, in two-digit format (e.g. '03' for March)

$courseThisMonth = 0; // initialize the count variable

if ($countCourse > 0) {
    for ($i = 0; $i < $countCourse; $i++) {

        $course_month = date('m', strtotime($arrCourse['course_date'])); // extract the month from the course_date value

        if ($course_month == $month) {
            $courseThisMonth++; // increment the count if the course was created in the desired month
        }
    }
}

$sqlPurchase = "SELECT * FROM purchasedetail WHERE course_price != 'Free' AND instructor_unique_id = {$_SESSION['unique_id']}  ORDER BY purchase_time DESC";
$queryPurchase = mysqli_query($conn, $sqlPurchase);
$arrPurchase = mysqli_fetch_array($queryPurchase);
$countPurchase = mysqli_num_rows($queryPurchase);

$purchaseThisMonth = 0; // initialize the count variable
// echo "<script>alert(" . $_SESSION['unique_id'] . ");</script>";


if ($countPurchase > 0) {

    for ($i = 0; $i < $countPurchase; $i++) {
        $purchase_month = date('m', strtotime($arrPurchase['purchase_time'])); // extract the month from the course_date value

        if ($purchase_month == $month) {
            $purchaseThisMonth++; // increment the count if the course was created in the desired month

        }
    }
}

$sqlStudent = "SELECT * FROM purchasedetail WHERE instructor_unique_id = {$_SESSION['unique_id']}  ORDER BY purchase_time DESC";
$queryStudent = mysqli_query($conn, $sqlStudent);
$arrStudent = mysqli_fetch_array($queryStudent);
$countStudent = mysqli_num_rows($queryStudent);

$studentThisMonth = 0; // initialize the count variable
// echo "<script>alert(" . $purchase_month . ");</script>";


if ($countStudent > 0) {

    for ($i = 0; $i < $countStudent; $i++) {
        $student_month = date('m', strtotime($arrStudent['purchase_time'])); // extract the month from the course_date value

        if ($student_month == $month) {
            $studentThisMonth++; // increment the count if the course was created in the desired month

        }
    }
}

$sqlAllPurchase = "SELECT * FROM purchasedetail WHERE instructor_unique_id = {$_SESSION['unique_id']}  ORDER BY purchase_time DESC LIMIT 6";
$queryAllPurchase = mysqli_query($conn, $sqlAllPurchase);
$countAllPurchase = mysqli_num_rows($queryAllPurchase);

$sqlPurchase1 = "SELECT * FROM purchasedetail WHERE course_price != 'Free' AND instructor_unique_id = {$_SESSION['unique_id']}  ORDER BY purchase_time DESC LIMIT 6";
$queryPurchase1 = mysqli_query($conn, $sqlPurchase1);
$countPurchase1 = mysqli_num_rows($queryPurchase1);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyanLearn Instructor Dashboard</title>

    <!-- Main Css File -->
    <link rel="stylesheet" href="assets/css/instructordashboard.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/variable.css">

    <!-- For icon tab -->
    <link rel="icon" href="assets/images/logomobile.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <!-- Vendor -->
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">


</head>

<body>



    <section class="home">

        <main id="main" class="main">

            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Courses <span>| Total</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-journal-bookmark"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>
                                                    <?php echo $countCourse; ?>
                                                </h6>
                                                <span class="text-success small pt-1 fw-bold">
                                                    <?php echo $courseThisMonth; ?>
                                                </span> <span class="text-muted small pt-2 ps-1"> new this month</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Sales <span>| Total </span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cash-coin"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>
                                                    <?php echo $countPurchase; ?>
                                                </h6>
                                                <span class="text-success small pt-1 fw-bold">
                                                    <?php echo $purchaseThisMonth; ?>
                                                </span> <span class="text-muted small pt-2 ps-1"> purchase this
                                                    month</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Revenue Card -->

                            <!-- Customers Card -->
                            <div class="col-xxl-4 col-xl-12">

                                <div class="card info-card customers-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Students <span>| Total </span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-add"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>
                                                    <?php echo $countStudent; ?>
                                                </h6>
                                                <span class="text-danger small pt-1 fw-bold">
                                                    <?php echo $studentThisMonth ?>
                                                </span> <span class="text-muted small pt-2 ps-1"> new this month</span>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><!-- End Customers Card -->



                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">

                                    <div class="card-body">
                                        <h5 class="card-title">Recent Enrollement of courses <span></span></h5>

                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Student</th>
                                                    <th scope="col">Course</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($countAllPurchase > 0) {
                                                    for ($i = 0; $i < $countAllPurchase; $i++) {
                                                        $arrAllPurchase = mysqli_fetch_array($queryAllPurchase);

                                                        $sqlUser = "SELECT * FROM users WHERE unique_id = {$arrAllPurchase['user_unique_id']}";
                                                        $queryUser = mysqli_query($conn, $sqlUser);
                                                        $arrUser = mysqli_fetch_array($queryUser);
                                                        $countUser = mysqli_num_rows($queryUser);

                                                        $sqlCourse1 = "SELECT * FROM course WHERE instructor_id = {$_SESSION['unique_id']} AND course_id = {$arrAllPurchase['course_id']} ";
                                                        $queryCourse1 = mysqli_query($conn, $sqlCourse1);
                                                        $arrCourse1 = mysqli_fetch_array($queryCourse1);
                                                        $countCourse1 = mysqli_num_rows($queryCourse1);

                                                        ?>
                                                        <tr>
                                                            <th scope="row"><span style="color: blue;">
                                                                    <?php echo $arrAllPurchase['purchase_unique_id']; ?>
                                                                </span></th>
                                                            <td>
                                                                <?php echo $arrUser['fullName'];
                                                                ; ?>
                                                            </td>
                                                            <td><a href="#" class="text-primary">
                                                                    <?php echo $arrCourse1['course_title']; ?>
                                                                </a></td>
                                                            <td>
                                                                <?php echo $arrAllPurchase['course_price']; ?>
                                                            </td>
                                                            <td><span class="badge bg-success">
                                                                    <?php echo date("d M Y", strtotime($arrAllPurchase['purchase_time'])); ?>
                                                                </span></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <h5><b style="color: var(--bs-table-bg);">There is no purchase of your
                                                            courses yet!</b></h5>
                                                    <?php

                                                }
                                                ?>


                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div><!-- End Recent Sales -->


                        </div>
                    </div><!-- End Left side columns -->

                    <!-- Right side columns -->
                    <div class="col-lg-4">

                        <!-- Recent Activity -->
                        <div class="card">


                            <div class="card-body">
                                <h5 class="card-title">Recent Purchase Activity <span></span></h5>

                                <div class="activity">

                                    <?php
                                    if ($countPurchase1 > 0) {
                                        for ($i = 0; $i < $countPurchase1; $i++) {

                                            $arrPurchase1 = mysqli_fetch_array($queryPurchase1);

                                            $sqlUser = "SELECT * FROM users WHERE unique_id = '{$arrPurchase1['user_unique_id']}'";
                                            $queryUser = mysqli_query($conn, $sqlUser);
                                            $arrUser = mysqli_fetch_array($queryUser);
                                            $countUser = mysqli_num_rows($queryUser);

                                            $sqlCourse1 = "SELECT * FROM course WHERE instructor_id = {$_SESSION['unique_id']} AND course_id = '{$arrPurchase1['course_id']}' ";
                                            $queryCourse1 = mysqli_query($conn, $sqlCourse1);
                                            $arrCourse1 = mysqli_fetch_array($queryCourse1);
                                            $countCourse1 = mysqli_num_rows($queryCourse1);

                                            $color = ['text-success', 'text-danger', 'text-warning', 'text-muted', 'text-info', 'text-primary'];
                                            $randomColor = $color[array_rand($color)];

                                            $purchase_time = $arrPurchase1['purchase_time'];
                                            $purchase_timestamp = strtotime($purchase_time);
                                            $current_timestamp = time();

                                            $seconds_ago = $current_timestamp - $purchase_timestamp;

                                            if ($seconds_ago < 60) {
                                                $time_ago = $seconds_ago . ' sec ago';
                                            } elseif ($seconds_ago < 3600) {
                                                $minutes_ago = floor($seconds_ago / 60);
                                                $time_ago = $minutes_ago . ' min ago';
                                            } elseif ($seconds_ago < 86400) {
                                                $hours_ago = floor($seconds_ago / 3600);
                                                $time_ago = $hours_ago . ' hrs ago';
                                            } else {
                                                $days_ago = floor($seconds_ago / 86400);
                                                $time_ago = $days_ago . ' day ago';
                                            }




                                            ?>

                                            <div class="activity-item d-flex">
                                                <div class="activite-label"><?php echo $time_ago ?></div>
                                                <i
                                                    class='bi bi-circle-fill activity-badge <?php echo $randomColor; ?> align-self-start'></i>
                                                <div class="activity-content">
                                                    <?php echo $arrUser['fullName']; ?> just bought
                                                    <?php echo $arrCourse1['course_title']; ?> Course <a href="#"
                                                        class="fw-bold text-success">(
                                                        <?php echo $arrPurchase1['course_price']; ?>+
                                                    </a>)</a>
                                                </div>
                                            </div><!-- End activity item-->

                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <h5><b style="color: var(--bs-table-bg);">No purchase of your course yet!</b></h5>

                                        <?php
                                    }
                                    ?>


                                </div>

                            </div>
                        </div><!-- End Recent Activity -->





                    </div><!-- End Right side columns -->

                </div>
            </section>

        </main><!-- End #main -->



    </section>

    <script src="assets/js/instructordashboard.js"></script>
    <script src="assets/js/vendor/jquery.min.js"></script>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>







</body>

</html>