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
$revenueThisMonth = 0;


if ($countPurchase > 0) {

    for ($i = 0; $i < $countPurchase; $i++) {
        $purchase_month = date('m', strtotime($arrPurchase['purchase_time'])); // extract the month from the course_date value

        if ($purchase_month == $month) {
            $purchaseThisMonth++; // increment the count if the course was created in the desired month
            $purchasePrice = $arrPurchase['course_price'];
            $CoursePriceSimple = str_replace('$', '', $purchasePrice);
            $CoursePriceInt = intval(str_replace('.', '', $CoursePriceSimple));
            $CoursePriceFloat = $CoursePriceInt / 100;

            $revenueThisMonth += $CoursePriceFloat;
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

$sqlInstructor = "SELECT * FROM instructors WHERE unique_id = {$_SESSION['unique_id']}";
$queryInstructor = mysqli_query($conn, $sqlInstructor);
$arrInstructor = mysqli_fetch_array($queryInstructor);
$countInstructor = mysqli_num_rows($queryInstructor);

$topSelling = "SELECT *, course_id, COUNT(*) AS sales_count
                FROM purchasedetail
                WHERE instructor_unique_id = {$_SESSION['unique_id']}
                GROUP BY course_id
                ORDER BY sales_count DESC
                LIMIT 5;";
$queryTopSelling = mysqli_query($conn, $topSelling);
$countTopSelling = mysqli_num_rows($queryTopSelling);



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
                <h1>Revenue </h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Revenue</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                                        <h5 class="card-title">Sales <span>| Total</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-cash-coin"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?php echo $countCourse; ?></h6>
                                                <span class="text-success small pt-1 fw-bold"><?php echo $purchaseThisMonth; ?></span> <span class="text-muted small pt-2 ps-1"> sale this month</span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                                        <h5 class="card-title">Revenue <span>| This Month </span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-chart-line"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?php echo "$" . $revenueThisMonth; ?></h6>
                                                <!-- <span class="text-success small pt-1 fw-bold"><?php echo $purchaseThisMonth; ?></span> <span class="text-muted small pt-2 ps-1"> purchase this month</span> -->

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Revenue Card -->

                            <!-- Customers Card -->
                            <div class="col-xxl-4 col-xl-12">

                                <div class="card info-card customers-card">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
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
                                        <h5 class="card-title">Wallet <span>| Total </span></h5>

                                        <div class="d-flex align-items-center">
                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-piggy-bank"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6><?php echo "$" . $arrInstructor['profile_networth']; ?></h6>
                                                <span class="text-success small pt-1 fw-bold"><?php echo "$" . $revenueThisMonth ?><i class="fa-solid fa-arrow-trend-up"></i></span> <span class="text-muted small pt-2 ps-1"> this month </span>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><!-- End Customers Card -->



                            <!-- Recent Sales -->
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">

                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Sales Report Chart</h5>

                                                    <?php
                                                    $current_year = date("Y");
                                                    // Create an array to hold the total course_price for each month
                                                    $monthly_totals = array_fill(0, 12, 0);

                                                    // Loop through each month from January to December
                                                    for ($month = 1; $month <= 12; $month++) {
                                                        // Query the database for the total course_price of purchases in this month and year
                                                        $query = "SELECT SUM(REPLACE(course_price, '$', '') * 1) AS total FROM purchasedetail WHERE instructor_unique_id = '{$_SESSION['unique_id']}' AND purchase_year = '$current_year' AND purchase_month = '" . date("M", mktime(0, 0, 0, $month, 1, $current_year)) . "'";
                                                        $result = mysqli_query($conn, $query);

                                                        // Get the total course_price for this month
                                                        $row = mysqli_fetch_assoc($result);
                                                        $count = mysqli_num_rows($result);



                                                        if (!empty($row['total'])) {
                                                            $monthly_totals[$month - 1] = $row['total'];
                                                        } else {
                                                            $monthlyTotal[] = 0;
                                                        }
                                                        

                                                //   echo "<script>alert('".$_SESSION['unique_id'] ."');</script>";


                                                    }


                                                    ?>

                                                    <!-- Line Chart -->
                                                    <div id="lineChart"></div>

                                                    <!-- <?php echo "<script>alert(".json_encode($monthly_totals).");</script>" ?> -->

                                                    <script>
                                                        var monthlyTotals = <?php echo json_encode($monthly_totals); ?>;
                                                    </script>


                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", () => {
                                                            new ApexCharts(document.querySelector("#lineChart"), {
                                                                series: [{
                                                                    name: "Sales",
                                                                    data: monthlyTotals
                                                                }],
                                                                chart: {
                                                                    height: 350,
                                                                    type: 'line',
                                                                    zoom: {
                                                                        enabled: false
                                                                    }
                                                                },
                                                                dataLabels: {
                                                                    enabled: false
                                                                },
                                                                stroke: {
                                                                    curve: 'straight'
                                                                },
                                                                grid: {
                                                                    row: {
                                                                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                                                        opacity: 0.5
                                                                    },
                                                                },
                                                                xaxis: {
                                                                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                                                }
                                                            }).render();
                                                        });
                                                    </script>
                                                    <!-- End Line Chart -->

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div><!-- End Recent Sales -->






                        </div>


                    </div><!-- End Left side columns -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Selling <span>| All Time</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Image</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Enrollment</th>
                                            <th scope="col">Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php for ($i = 0; $i < $countTopSelling; $i++) {

                                            $arrTopSelling = mysqli_fetch_array($queryTopSelling);


                                            $sqlUser = "SELECT * FROM users WHERE unique_id = {$arrTopSelling['user_unique_id']}";
                                            $queryUser = mysqli_query($conn, $sqlUser);
                                            $arrUser = mysqli_fetch_array($queryUser);
                                            $countUser = mysqli_num_rows($queryUser);

                                            $sqlCourse1 = "SELECT * FROM course WHERE instructor_id = {$_SESSION['unique_id']} AND course_id = {$arrTopSelling['course_id']} ";
                                            $queryCourse1 = mysqli_query($conn, $sqlCourse1);
                                            $arrCourse1 = mysqli_fetch_array($queryCourse1);
                                            $countCourse1 = mysqli_num_rows($queryCourse1);

                                      
                                        ?>
                                            <tr>
                                                <th scope="row"><a href="#"><img src="<?php echo $arrCourse1['preview_image'] ?>" alt=""></a></th>
                                                <td><a href="#" class="text-primary fw-bold"><?php echo $arrCourse1['course_title']; ?></a></td>
                                                <td><?php echo $arrCourse1['course_price']; ?></td>
                                                <td class="fw-bold"><?php echo $arrTopSelling['sales_count']; ?></td>
                                                <td>$<?php echo intval(str_replace('$', '', $arrTopSelling['course_price'] )) * $arrTopSelling['sales_count'] ?></td>
                                            </tr>
                                        <?php
                                        } ?>

                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Top Selling -->



                </div>
            </section>

        </main><!-- End #main -->



    </section>

    <script src="assets/js/instructordashboard.js"></script>
    <script src="assets/js/vendor/jquery.min.js"></script>


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>








</body>

</html>