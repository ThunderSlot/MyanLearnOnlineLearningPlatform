<?php
include('header.php');
include('shoppingCartFunction.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == "remove") {
        $CourseID = $_GET['CourseID'];
        RemoveProduct($CourseID);
    } elseif ($action == "clearall") {
        ClearAll();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MyanLearn | Shopping Cart Page</title>
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

</head>

<body>


    <div id="main-wrapper" class="main-wrapper">
        <form action="ShoppingCart.php" method="post" enctype="multipart/form-data">

            <!--=====================================-->
            <!--=           Cart Area Start         =-->
            <!--=====================================-->
            <section class="cart-page-area edu-section-gap">
                <div class="container">
                    <h3>Shopping Cart</h3>
                    <?php
                    if (isset($_SESSION['Shopping_Cart_Functions'])) {
                        $count = count($_SESSION['Shopping_Cart_Functions']);


                    ?>
                        <p>There are <b style="color: orange;"><?php echo $count; ?></b> Courses in Cart.</p>

                    <?php } ?>

                    <?php

                    if (!isset($_SESSION['Shopping_Cart_Functions']) or count($_SESSION['Shopping_Cart_Functions']) < 1) {
                        echo "<p>Your Cart is Empty.</p>";
                        echo " <div class=\"input-group update-btn\">
                                    <a href='home.php' class='edu-btn btn-border btn-medium disabled' style='background-color:var(--light-gradient);'>Browse More Course <i class='icon-4'></i></a>
                                </div>";

                        echo "<script>window.alert('Your Cart is Empty')</script>";
                    } else {

                    ?>

                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="product-remove"></th>
                                        <th scope="col" class="product-thumbnail"></th>
                                        <th scope="col" class="product-title">Course Name</th>
                                        <th scope="col" class="product-instructor">Instructor</th>
                                        <th scope="col" class="product-price">Category</th>
                                        <th scope="col" class="product-price">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $LoopingTime = $count;
                                    for ($i = 0; $i < $LoopingTime; $i++) {

                                        $CourseID = $_SESSION['Shopping_Cart_Functions'][$i]['CourseID'];
                                        $CourseTitle = $_SESSION['Shopping_Cart_Functions'][$i]['CourseTitle'];
                                        $CoursePrice = $_SESSION['Shopping_Cart_Functions'][$i]['CoursePrice'];
                                        $PreviewImage = $_SESSION['Shopping_Cart_Functions'][$i]['PreviewImage'];


                                        $CourseCategory = $_SESSION['Shopping_Cart_Functions'][$i]['CourseCategory'];
                                        $InstructorID = $_SESSION['Shopping_Cart_Functions'][$i]['InstructorID'];


                                        $CategorySelect = "SELECT s.subcategory_name, c.category_name
                                                            FROM subcategory s
                                                            JOIN category c ON s.category_id = c.category_id
                                                            WHERE s.category_id = '$CourseCategory'  ";
                                        $resultCategory = mysqli_query($conn, $CategorySelect);
                                        $CategoryRows = mysqli_fetch_array($resultCategory);

                                        $subcatName = $CategoryRows['subcategory_name'];
                                        $catName = $CategoryRows['category_name'];

                                        $InstructorSelect = "SELECT * from users where unique_id = '$InstructorID' ";
                                        $resultInstructors = mysqli_query($conn, $InstructorSelect);
                                        $InstructorsRows = mysqli_fetch_array($resultInstructors);

                                        $InstructorName = $InstructorsRows['fullName'];

                                        $query = "SELECT * FROM instructors WHERE unique_id='$InstructorID'";
                                        $result = mysqli_query($conn, $query);
                                        $count = mysqli_num_rows($result);
                                        $rows = mysqli_fetch_array($result);
                                    ?>
                                        <tr>
                                            <td class="product-remove">
                                                <a href="ShoppingCart.php?action=remove&CourseID=<?php echo $CourseID ?>" class="btn btn-danger btn-medium">Remove</a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="courseviewdetail.php?CourseID=<?php echo $CourseID; ?>"><img src="<?php echo $PreviewImage; ?>" alt="Course Cover"></a>
                                            </td>
                                            <td class="product-title">
                                                <a href="courseviewdetail.php?CourseID=<?php echo $CourseID; ?>"> <?php echo $CourseTitle; ?></a>
                                            </td>
                                            <td class="product-title" style="color: var(--light-gradient);">
                                                <?php echo $InstructorName; ?>
                                            </td>
                                            <td class="product-price" data-title="Price"><?php echo $catName . "|" . $subcatName; ?></td>

                                            <td class="product-subtotal" data-title="Subtotal"><?php echo $CoursePrice; ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>

                        <!-- <div class="cart-update-btn-area">
                            <div class="input-group update-btn">
                                <a href="home.php" class="edu-btn btn-border btn-medium disabled">Browse More Course <i class="icon-4"></i></a>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group update-btn">
                                    <a href="home.php" class="edu-btn btn-border btn-medium disabled">Browse More Course <i class="icon-4"></i></a>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                                <div class="order-summery">
                                    <h4 class="title">Cart Totals</h4>
                                    <table class="table summery-table">
                                        <tbody>
                                            <tr class="order-subtotal">
                                                <td>Subtotal</td>
                                                <td>$<?php echo CalculateTotalAmount() ?></td>
                                            </tr>
                                            <tr class="order-subtotal">
                                                <td>VAT (5%)</td>
                                                <td>$ <?php echo round(CalculateTotalAmount() * 0.05, 2) ?></td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Grand Total</td>
                                                <td>$ <?php echo CalculateTotalAmount() + (round(CalculateTotalAmount() * 0.05, 2)) ?> </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="ShoppingCart.php?action=clearall" class="edu-btn btn-medium checkout-btn">Clear Cart <i class="fas fa-trash-alt" style="font-size: 15px;"></i></a>

                                        </div>
                                        <div class="col-sm-6">
                                            <a href="checkout.php" class="edu-btn btn-medium checkout-btn">Proceed to Checkout <i class="icon-4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </section>

            <!-- Cart Ends here -->
        </form>


    </div>

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

    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>

</body>


</html>