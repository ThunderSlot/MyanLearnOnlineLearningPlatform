<?php
include('header.php');


//define total number of results you want per page  
$results_per_page = 5;

//find the total number of results stored in the database  

$sqlPurchase1 = "SELECT * FROM purchase WHERE unique_id = {$_SESSION['unique_id']}  ORDER BY purchase_time DESC";
$queryPurchase1 = mysqli_query($conn, $sqlPurchase1);
$countPurchase1 = mysqli_num_rows($queryPurchase1);

//determine the total number of pages available  
$number_of_page = ceil($countPurchase1 / $results_per_page);
$pagLink = "";

//determine which page number visitor is currently on  
if (!isset($_REQUEST['page'])) {
    $page = 1;
} else {
    $page = $_REQUEST['page'];
}

//determine the sql LIMIT starting number for the results on the displaying page  
$page_first_result = ($page - 1) * $results_per_page;

//retrieve the selected results from database   
$sqlPurchase = "SELECT * FROM purchase WHERE unique_id = {$_SESSION['unique_id']}  ORDER BY purchase_time DESC LIMIT " . $page_first_result . ',' . $results_per_page;
$queryPurchase = mysqli_query($conn, $sqlPurchase);
$countPurchase = mysqli_num_rows($queryPurchase);




// echo "<script>alert(".$_SESSION['unique_id'].");</script>";

?>




<!DOCTYPE html>
<html>


<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyanLearn | Purchased History Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
    <!-- CSS
   ============================================ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-t7xuJLek72R7JeOQd/mxlVvxWoJ1hEg6rtgU0C0LhZoBQZoF5r5rTyg5M1yfaKSNwv+z38L4W8c9/1BGxoyfIw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">


    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css">

    <!-- For data table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" />




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

        /* Table Design */

        td {
            vertical-align: middle;
            border: none;
        }

        table {
            border-collapse: collapse;
            margin: 50px auto;
        }

        th {
            opacity: 0.7;
            font-weight: bold;
        }

        td,
        th {
            padding: 10px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            text-align: left;
            font-size: 19px;
        }

        .noBorder {
            border: none;
        }

        .labels {
            font-weight: bold;
        }

        .label tr td label {
            display: block;
        }


        [data-toggle="toggle"] {
            display: none;
        }


        /*Pagination Horizontal scroller style*/
        .pv3 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }


        .horizontal_scroll {
            display: block;
            position: relative;
            overflow-y: hidden;
            width: 200px;
            overflow-x: scroll;
            -webkit-overflow-scrolling: touch;
            display: block;
            position: relative;
            white-space: nowrap;
            margin-bottom: -35px;
            padding-right: 24px;
            padding-bottom: 16px;
            padding-top: 2px;
            display: inline-block;
        }

        .horizontal_scroll::-webkit-scrollbar {
            display: none;
            /*To hide horizontal scroll bar*/
        }

        .horizontal_scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .Prev_Next {
            display: inline-block;
            margin-left: 1px;
            border: 1px solid #dfdfdf;
            color: black;
            border-radius: 4px;
            transition: all 0.3s ease-in-out;
            padding: 10px 18px;
            font-size: 14px;

        }

        /* Pagination
-------------------------------------------------------------- */
        .blog-pagination .flat-pagination li {
            border: 1px solid #dfdfdf;
            color: #000;
            border-radius: 4px;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .blog-pagination .flat-pagination li:hover {
            border: 1px solid #ffaa30;
            border-radius: 4px;
        }

        .blog-pagination .flat-pagination li {
            display: inline-block;
            margin-left: 1px;
        }

        .blog-pagination .flat-pagination li a {
            display: inline-block;
            line-height: 23px;
            font-size: 14px;
            padding: 10px 18px;
            font-family: "Montserrat", sans-serif;
            color: #333;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .blog-pagination .flat-pagination .active {
            line-height: 23px;
            font-size: 14px;
            padding: 10px 19px;
        }

        .blog-pagination .flat-pagination li a:hover,
        .blog-pagination .flat-pagination .active {
            color: #fff;
            background-color: #ffaa30;
            border-radius: 4px;
            display: inline-block;
        }

        .blog-pagination .flat-pagination li.next a:hover {
            color: #fff;
        }

        .blog-pagination .flat-pagination li.next i {
            font-weight: 700;
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -ms-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
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



                <h3 style="font-weight: 1000; font-size: 26px;">Purchased History</h3>




                <div class="col-12 col-md-12 col-lg-12 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Total Price</th>
                                <th>Payment Type</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>




                            <?php
                            // echo "<script>alert(".$countPurchase.");</script>";

                            for ($i = 0; $i < $countPurchase; $i++) {
                                $arrPurchase = mysqli_fetch_array($queryPurchase);

                                $sqlPurchaseDetail = "SELECT * FROM purchasedetail WHERE user_unique_id = '{$_SESSION['unique_id']}' AND purchase_unique_id = '{$arrPurchase['purchase_unique_id']}'  ORDER BY purchase_time DESC";
                                $queryPurchaseDetail = mysqli_query($conn, $sqlPurchaseDetail);

                                if (mysqli_num_rows($queryPurchaseDetail) > 1) //there are more than one course in purchase
                                {

                            ?>
                        <tbody>
                            <tr>
                                <td class="labels">
                                    <div class="d-flex">
                                        <i class="bi bi-cart mt-5" style="margin-top: 0px!important; margin-right: 5px;"></i>
                                        <div class="row">
                                            <label style="cursor: pointer;">
                                                <?php echo mysqli_num_rows($queryPurchaseDetail) ?> courses
                                                purchased
                                            </label>
                                            <label for="accounting" style="color: var(--color-primary); cursor: pointer; text-decoration: underline;">
                                                View all courses
                                            </label>
                                        </div>
                                    </div>

                                    <input type="checkbox" name="accounting" id="accounting" data-toggle="toggle">
                                </td>
                                <td>
                                    <?php echo $arrPurchase['purchase_time']; ?>
                                </td>
                                <td>$
                                    <?php echo $arrPurchase['total_amount']; ?>
                                </td>
                                <td>
                                    <?php echo $arrPurchase['payment_type']; ?>
                                </td>
                                <td><a href="viewReceipt.php?PurchaseID=<?php echo $arrPurchase['purchase_unique_id'] ?>" class="btn btn-primary" style="font-size: 15px;">Recepit
                                        Overview</a></td>

                            </tr>
                        </tbody>
                        <tbody class="hide" style="display: none;">

                            <?php
                                    for ($j = 0; $j < mysqli_num_rows($queryPurchaseDetail); $j++) {

                                        $arrPuchaseDetail = mysqli_fetch_array($queryPurchaseDetail);

                                        $sqlCourse = "SELECT * FROM course WHERE course_id = '{$arrPuchaseDetail['course_id']}' ";
                                        $queryCourse = mysqli_query($conn, $sqlCourse);
                                        $arrCourse = mysqli_fetch_array($queryCourse);





                            ?>


                                <tr>
                                    <td style="color: var(--color-primary); left: 5%; position:relative;">
                                        <a href="courseviewdetail.php?CourseID=<?php echo $arrCourse['course_id'] ?>" style="color: var(--color-primary);"> <?php echo $arrCourse['course_title']; ?></a>
                                    </td>
                                    <td></td>
                                    <td style="color: black;">
                                        <?php echo $arrPuchaseDetail['course_price'] ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>



                            <?php

                                    }
                                    echo "</tbody>";
                                } else //there is only one course in a purchase
                                {
                                    $arrPuchaseDetail = mysqli_fetch_array($queryPurchaseDetail);


                                    $sqlCourse = "SELECT * FROM course WHERE course_id = '{$arrPuchaseDetail['course_id']}' ";
                                    $queryCourse = mysqli_query($conn, $sqlCourse);
                                    $arrCourse = mysqli_fetch_array($queryCourse);


                            ?>

                        <tbody>
                            <tr>
                                <td class="labels" style="color: var(--color-primary); ">
                                    <i class="bi bi-cart mt-5"></i>
                                    <a href="courseviewdetail.php?CourseID=<?php echo $arrCourse['course_id'] ?>" style="color: var(--color-primary);"> <?php echo $arrCourse['course_title']; ?></a>
                                </td>
                                <td>
                                    <?php echo $arrPurchase['purchase_time'] ?>
                                </td>
                                <td>
                                    <?php echo $arrPuchaseDetail['course_price'] ?>
                                </td>
                                <td>
                                    <?php echo ($arrPuchaseDetail['course_price'] === 'Free') ? 'Free' : $arrPurchase['payment_type']; ?>
                                </td>
                                <td><a href="viewReceipt.php?PurchaseID=<?php echo $arrPurchase['purchase_unique_id'] ?>" class="btn btn-primary" style="font-size: 15px;">Recepit
                                        Overview</a></td>
                            </tr>
                        </tbody>

                    <?php
                                }

                    ?>

                <?php

                            }
                ?>

                </tbody>




                    </table>
                </div>

                <div class="blog-pagination" style="display: flex; flex-wrap: wrap; flex-flow: row nowrap;">
                    <div class="pv3 d-flex">
                        <?php
                        //display the link of the pages in URL  
                        if ($page >= 2) {
                            echo "<a href='purchasedHistory.php?page=" . ($page - 1) . "' style=\" font-family: 'Itim', cursive; margin-top: 13px;\" class=\"Prev_Next\" >  Prev </a>";
                        }
                        ?>

                        <div class='horizontal_scroll'>


                            <ul class="flat-pagination" style="margin: 0px!important;">



                                <?php



                                for ($i = 1; $i <= $number_of_page; $i++) {
                                    if ($i == $page) {
                                        $pagLink .= "<li><a class = 'active' style = 'font-family: 'Itim', cursive;' href='purchasedHistory.php?page="
                                            . $i . "'>" . $i . " </a></li>";
                                    } else {
                                        $pagLink .= "<li><a style = 'font-family: 'Itim', cursive;' href='purchasedHistory.php?page=" . $i . "'>   
                                                " . $i . " </a></li>";
                                    }
                                };
                                echo $pagLink;




                                ?>


                            </ul><!-- /.flat-pagination -->

                        </div>
                        <?php

                        if ($page < $number_of_page) {
                            echo "<a href='purchasedHistory.php?page=" . ($page + 1) . "'  style=\" font-family: 'Itim', cursive; margin-top: 13px;\" class=\"Prev_Next\" >  Next </a>";
                        }

                        ?>
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
        $(document).ready(function() {
            $('[data-toggle="toggle"]').change(function() {
                $(this).parents().next('.hide').toggle();
            });
        });
    </script>




</body>

</html>