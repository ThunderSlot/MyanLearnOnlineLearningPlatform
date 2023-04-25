<?php
include('header.php');

if ($_GET['PurchaseID']) {
    $reqPurID = $_GET['PurchaseID'];


    //retrieve the selected results from database   
    $sqlPurchase = "SELECT * FROM purchase WHERE unique_id = {$_SESSION['unique_id']} AND purchase_unique_id = '{$reqPurID}'  ORDER BY purchase_time DESC ";
    $queryPurchase = mysqli_query($conn, $sqlPurchase);
    $queryPurchase1 = mysqli_query($conn, $sqlPurchase);
    $arrPurchase1 = mysqli_fetch_array($queryPurchase1);
    $countPurchase = mysqli_num_rows($queryPurchase);

    // echo "<script>alert(".$countPurchase.");</script>";


    $arrPurchase = mysqli_fetch_array($queryPurchase);

    $sqlPurchaseDetail = "SELECT * FROM purchasedetail WHERE user_unique_id = '{$_SESSION['unique_id']}' AND purchase_unique_id = '{$arrPurchase['purchase_unique_id']}'  ORDER BY purchase_time DESC";
    $queryPurchaseDetail = mysqli_query($conn, $sqlPurchaseDetail);





} else {
    echo "<script>alert('Something went wrong with processing');</script>";
    echo "<script>window.location='purchasedHistory.php';</script>";
}




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
            /* border-top: 1px solid #ccc; */
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

        /* Pagination------*/
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



                <h3 style="font-weight: 1000; font-size: 26px;">Receipt</h3>

                <div class="row row--30">
                    <div class="col-lg-8">
                        <h3 style="font-weight: 600; font-size: 16px;">Receipt - <?php echo date("d M Y", strtotime($arrPurchase1['purchase_time']))  ?></h3>
                        <h3 style="font-weight: 600; font-size: 16px;">Sold to : <?php echo $_SESSION['unique_id']  ?></h3>
                        <h3 style="font-weight: 600; font-size: 15px; color: var(--light-gradient);">MyanLearn, Inc.</h3>

                    </div>
                    <div class="col-lg-4">
                        <h3 style="font-weight: 600; font-size: 16px;">Date - <?php echo date("d M Y", strtotime($arrPurchase1['purchase_time']))  ?></h3>
                        <h3 style="font-weight: 600; font-size: 16px;">Purchase#:- <?php echo $arrPurchase1['purchase_unique_id'] ?></h3>
                    </div>
                </div>




                <div class="col-12 col-md-12 col-lg-12 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Ordered</th>
                                <th>Price</th>
                                <th>Payment</th>
                                <th>Total</th>
                            </tr>
                        </thead>


                        <?php
                        // echo "<script>alert(".mysqli_num_rows($queryPurchaseDetail).");</script>";

                        for ($i = 0; $i < mysqli_num_rows($queryPurchaseDetail); $i++) {

                            $arrPuchaseDetail = mysqli_fetch_array($queryPurchaseDetail);


                            $sqlCourse = "SELECT * FROM course WHERE course_id = '{$arrPuchaseDetail['course_id']}' ";
                            $queryCourse = mysqli_query($conn, $sqlCourse);
                            $arrCourse = mysqli_fetch_array($queryCourse);


                        ?>

                            <tbody>
                                <tr>
                                    <td>
                                        <a href="courseviewdetail.php?CourseID=<?php echo $arrCourse['course_id'] ?>"> <?php echo $arrCourse['course_title']; ?></a>
                                    </td>
                                    <td>
                                        <?php echo date("d M Y", strtotime($arrPurchase['purchase_time']))  ?>
                                    </td>
                                    <td>
                                        <?php echo $arrPuchaseDetail['course_price'] ?>
                                    </td>
                                    <td>
                                        <?php echo ($arrPuchaseDetail['course_price'] === 'Free') ? 'Free' : $arrPurchase['payment_type']; ?>
                                    </td>
                                    <td><?php echo ($arrPuchaseDetail['course_price'] === 'Free') ? '$0.0' : $arrPuchaseDetail['course_price']; ?></td>
                                </tr>
                            </tbody>


                        <?php
                        }
                        ?>

                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                   <b style="font-size: 15px; color: orange;">VAT</b>
                                </td>
                                <td>$<?php echo $arrPurchase['VAT']; ?></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                   <b style="font-size: 15px; color: orange;">Grand Total</b>
                                </td>
                                <td>$<?php echo ($arrPurchase['grand_total'] == '0') ? '0.0' : $arrPurchase['grand_total']; ?></td>
                            </tr>
                        </tbody>



                    </table>
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