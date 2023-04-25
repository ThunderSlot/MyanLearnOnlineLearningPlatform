<?php
session_start();
include_once "config.php";


$allowed_pages = array('createNewCourse.php', 'createCurriculum.php', 'uploadMedia.php', 'setPrice.php');

if (!in_array(basename($_SERVER['PHP_SELF']), $allowed_pages)) {
    unset($_SESSION['course_unique_id']);
    unset($_SESSION['editCourseid']);
}

if (!isset($_SESSION['unique_id'])) {
    header("location: signup.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyanLearn Online Learning Platform</title>

    <!-- Main css files -->
    <link rel="stylesheet" href="assets/css/homes.css">
    <link rel="stylesheet" href="assets/css/variable.css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">


    <!-- Vendor css files -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- For icon tab -->
    <link rel="icon" href="assets/images/logomobile.png">

    <!-- Include SweetAlert CSS file -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/sweetalert/sweetalert2.min.css">

    <!-- Include SweetAlert JavaScript file -->
    <script type="text/javascript" src="assets/vendor/sweetalert/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="assets/css/vendor/icomoon.css">
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css">
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css">

    <link rel="stylesheet" href="assets/css/app.css">

    <style>
        .navMobileCategory {
            margin: 0px !important;
        }
        .mobileSubNav
        {
            height: auto!important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>



</head>


<body>



    <div class="navBar">

        <?php
        include_once "config.php";
        $sql = mysqli_query($conn, "Select * From users Where unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        }

        $checkInstructorsql = mysqli_query($conn, "Select * From instructors Where unique_id = {$_SESSION['unique_id']}");
        $count = mysqli_num_rows($checkInstructorsql);
        if ($count > 0) //there is data
        {
            $instructorLink = "instructorDashboard.php";
            $instructorText = "Instructor Dashboard";
        } else {


            $instructorLink = "instructorsignup.php";
            $instructorText = "Teach on MyanLearn";
        }

        ?>

        <div class="topbar">
            <div class="logo">
                <a href="home.php"><img src="assets/images/logo1.png" alt="Logo Image" srcset=""></a>
            </div>

            <div class="courseCategory close">
                Courses
                <i class="fa-solid fa-chevron-down courseCategoryIcon"></i>
            </div>



            <div class="search">
                <input type="text" id="search" placeholder="search here" style="border: 1px solid black;">
                <label for="search"> <i class='bx bx-search-alt-2'></i></label>
            </div>

            <div class="user">
                <img src="<?php echo $row['image'] ?>" alt="" class="profileImage">
            </div>



            <div class="nav-toggle" id="nav-toggle">
                <i class='bx bx-menu'></i>
            </div>

            <div class="nav-close" id="nav-close">
                <i class="fa-solid fa-xmark"></i>
            </div>

            <div class="sub-menu-wrap-user" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="<?php echo $row['image'] ?>" alt="" srcset="">
                        <div class="user_name">
                            <h5>Hi, <span class="primaryColor">
                                    <?php echo $row['fullName'] ?>
                                </span></h5>
                            <span>Welcome Back!</span>
                        </div>

                    </div>
                    <hr>

                    <a href="profile.php" class="sub-menu-link">
                        <i class="fa-solid fa-user"></i>
                        <p>Public Profile</p>

                    </a>

                    <a href="editProfile.php" class="sub-menu-link">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <p>Edit Profile</p>

                    </a>

                    <hr>

                    <a href="users1.php" class="sub-menu-link">
                        <i class='bx bx-message-rounded icon'></i>
                        <p>Chat</p>

                    </a>

                    <hr>

                    <a href="purchasedcourse.php" class="sub-menu-link">
                        <i class="fa-solid fa-video"></i>
                        <p>My Learning</p>
                    </a>

                    <a href="#" class="sub-menu-link">
                        <i class="fa-solid fa-bookmark"></i>
                        <p>Wishlist</p>
                    </a>




                    <a href="ShoppingCart.php" class="sub-menu-link">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>Cart</p>

                    </a>

                    <a href="<?php echo $instructorLink ?>" class="sub-menu-link">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        <p>
                            <?php echo $instructorText ?>
                        </p>

                    </a>

                    <hr>

                    <a href="account.php" class="sub-menu-link">
                        <i class="fa-solid fa-gear"></i>
                        <p>Account Settings</p>

                    </a>

                    <a href="purchasedHistory.php" class="sub-menu-link">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <p>Purchase History</p>

                    </a>

                    <hr>

                    <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="sub-menu-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>

                    </a>

                </div>
            </div>

            <div class="sub-menu-wrap-courses" id="subMenu">
                <div class="sub-menu">

                    <?php

                    $selectCategory = mysqli_query($conn, "Select * From category");

                    $countCategory = mysqli_num_rows($selectCategory);
                    for ($i = 0; $i < $countCategory; $i++) {
                        $category = mysqli_fetch_assoc($selectCategory);
                        //    echo " <script>window.alert(".$countCategory.")</script> ";
                        $categoryName = $category['category_name'];

                    ?>


                        <a href="#" class="sub-menu-link <?php echo $categoryName ?>" data-category="<?php echo $categoryName ?>">
                            <p>
                                <?php echo $categoryName ?>
                            </p>
                            <span><i class="fa-solid fa-chevron-right"></i></span>
                        </a>



                    <?php

                    }

                    ?>

                </div>
            </div>

            <div class="sub-menu-wrap-development" id="subMenu">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory = mysqli_query($conn, "Select * From subcategory where category_id = 1");

                    $countSubCategory = mysqli_num_rows($selectSubCategory);
                    for ($i = 0; $i < $countSubCategory; $i++) {
                        $subcategory = mysqli_fetch_assoc($selectSubCategory);
                        //    echo " <script>window.alert(".$countCategory.")</script> ";
                        $subcategoryName = $subcategory['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-business" id="subMenu">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory1 = mysqli_query($conn, "Select * From subcategory where category_id = 2");

                    $countSubCategory1 = mysqli_num_rows($selectSubCategory1);
                    for ($i = 0; $i < $countSubCategory1; $i++) {
                        $subcategory1 = mysqli_fetch_assoc($selectSubCategory1);
                        echo " <script>window.alert(" . $subcategory1['subcategory_name'] . ")</script> ";
                        $subcategoryName1 = $subcategory1['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName1 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-finance" id="subMenu">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory2 = mysqli_query($conn, "Select * From subcategory where category_id = 3");

                    $countSubCategory2 = mysqli_num_rows($selectSubCategory2);
                    for ($i = 0; $i < $countSubCategory2; $i++) {
                        $subcategory2 = mysqli_fetch_assoc($selectSubCategory2);
                        $subcategoryName2 = $subcategory2['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName2 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>


            <div class="sub-menu-wrap-software" id="subMenu">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory3 = mysqli_query($conn, "Select * From subcategory where category_id = 4");

                    $countSubCategory3 = mysqli_num_rows($selectSubCategory3);
                    for ($i = 0; $i < $countSubCategory3; $i++) {
                        $subcategory3 = mysqli_fetch_assoc($selectSubCategory3);
                        $subcategoryName2 = $subcategory3['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName2 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-office" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory4 = mysqli_query($conn, "Select * From subcategory where category_id = 5");

                    $countSubCategory4 = mysqli_num_rows($selectSubCategory4);
                    for ($i = 0; $i < $countSubCategory4; $i++) {
                        $subcategory4 = mysqli_fetch_assoc($selectSubCategory4);
                        $subcategoryName4 = $subcategory4['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName4 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-personal" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory5 = mysqli_query($conn, "Select * From subcategory where category_id = 6");

                    $countSubCategory5 = mysqli_num_rows($selectSubCategory5);
                    for ($i = 0; $i < $countSubCategory5; $i++) {
                        $subcategory5 = mysqli_fetch_assoc($selectSubCategory5);
                        $subcategoryName5 = $subcategory5['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName5 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-design" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory6 = mysqli_query($conn, "Select * From subcategory where category_id = 7");

                    $countSubCategory6 = mysqli_num_rows($selectSubCategory6);
                    for ($i = 0; $i < $countSubCategory6; $i++) {
                        $subcategory6 = mysqli_fetch_assoc($selectSubCategory6);
                        $subcategoryName6 = $subcategory6['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName6 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-marketing" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory7 = mysqli_query($conn, "Select * From subcategory where category_id = 8");

                    $countSubCategory7 = mysqli_num_rows($selectSubCategory7);
                    for ($i = 0; $i < $countSubCategory7; $i++) {
                        $subcategory7 = mysqli_fetch_assoc($selectSubCategory7);
                        $subcategoryName7 = $subcategory7['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName7 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-lifestyle" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory8 = mysqli_query($conn, "Select * From subcategory where category_id = 9");

                    $countSubCategory8 = mysqli_num_rows($selectSubCategory8);
                    for ($i = 0; $i < $countSubCategory8; $i++) {
                        $subcategory8 = mysqli_fetch_assoc($selectSubCategory8);
                        $subcategoryName8 = $subcategory8['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName8 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-photograph" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory9 = mysqli_query($conn, "Select * From subcategory where category_id = 10");

                    $countSubCategory9 = mysqli_num_rows($selectSubCategory9);
                    for ($i = 0; $i < $countSubCategory9; $i++) {
                        $subcategory9 = mysqli_fetch_assoc($selectSubCategory9);
                        $subcategoryName9 = $subcategory9['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName9 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-health" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory10 = mysqli_query($conn, "Select * From subcategory where category_id = 11");

                    $countSubCategory10 = mysqli_num_rows($selectSubCategory10);
                    for ($i = 0; $i < $countSubCategory10; $i++) {
                        $subcategory10 = mysqli_fetch_assoc($selectSubCategory10);
                        $subcategoryName10 = $subcategory10['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName10 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-health" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory10 = mysqli_query($conn, "Select * From subcategory where category_id = 11");

                    $countSubCategory10 = mysqli_num_rows($selectSubCategory10);
                    for ($i = 0; $i < $countSubCategory10; $i++) {
                        $subcategory10 = mysqli_fetch_assoc($selectSubCategory10);
                        $subcategoryName10 = $subcategory10['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName10 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-music" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory11 = mysqli_query($conn, "Select * From subcategory where category_id = 12");

                    $countSubCategory11 = mysqli_num_rows($selectSubCategory11);
                    for ($i = 0; $i < $countSubCategory11; $i++) {
                        $subcategory11 = mysqli_fetch_assoc($selectSubCategory11);
                        $subcategoryName11 = $subcategory11['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName11 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>

            <div class="sub-menu-wrap-teaching" id="subMenu" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                <div class="sub-menu">

                    <?php

                    $selectSubCategory12 = mysqli_query($conn, "Select * From subcategory where category_id = 13");

                    $countSubCategory12 = mysqli_num_rows($selectSubCategory12);
                    for ($i = 0; $i < $countSubCategory11; $i++) {
                        $subcategory12 = mysqli_fetch_assoc($selectSubCategory12);
                        $subcategoryName12 = $subcategory12['subcategory_name'];

                    ?>

                        <a href="#" class="sub-menu-link" onmouseover="showParentMenu()" onmouseout="hideParentMenu()">
                            <p>
                                <?php echo $subcategoryName12 ?>
                            </p>
                        </a>


                    <?php

                    }

                    ?>
                </div>
            </div>



            <!-- for Mobile Nav Bar -->
            <!-- for Mobile Nav Bar -->
            <ul class="navbar_menu">
                <li class="navbar_item">
                    <div class="search mobile">
                        <input type="text" id="search" placeholder="search here">
                        <label for="search"> <i class='bx bx-search-alt-2'></i></label>
                    </div>
                </li>

                <li class="navbar_item">
                    <hr>
                </li>

                <li class="navbar_item">
                    <a href="userProfile.php" class="user_mobile_view">
                        <div class="user_image">
                            <img src="<?php echo $row['image'] ?>" alt="">
                        </div>
                        <div class="user_name">
                            <div>Hi, <?php echo $row['fullName'] ?></div>
                            <span>Welcome Back!</span>
                        </div>
                    </a>
                </li>
                <li class="navbar_item">
                    <hr>
                </li>

                <div class="mobile-subject-header"> <a href="profile.php"><i class="fa-solid fa-user"></i> Public Profile </a></div>
                <div class="mobile-subject-header"> <a href="editProfile.php"> <i class="fa-solid fa-pen-to-square"></i> Edit Profile </a></div>
                <hr>
                <div class="mobile-subject-header"> <a href="users1.php"><i class='bx bx-message-rounded icon'></i> Chat </a></div>
                <hr>
                <div class="mobile-subject-header"> <a href="purchasedcourse.php"><i class="fa-solid fa-video"></i> My Learning </a></div>
                <div class="mobile-subject-header"> <a href="#"><i class="fa-solid fa-bookmark"></i> Wishlist </a></div>
                <div class="mobile-subject-header"> <a href="ShoppingCart.php"><i class="fa-solid fa-cart-shopping"></i> Cart </a></div>
                <div class="mobile-subject-header"> <a href="<?php echo $instructorLink ?>"><i class="fa-solid fa-chalkboard-user"></i> <?php echo $instructorText ?> </a></div>
                <hr>
                <div class="mobile-subject-header"> <a href="account.php"><i class="fa-solid fa-gear"></i> Account Settings </a></div>
                <div class="mobile-subject-header"> <a href="purchasedHistory.php"><i class="fa-solid fa-money-check-dollar"></i> Purchase History </a></div>
                <hr>
                <div class="mobile-subject-header"> <a href="php/logout.php?logout_id=<?php echo $row['unique_id'] ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout </a></div>
                <hr>

                <div class="mobile-subject-header"> Most Popular</div>


                <?php

                $selectCategory = mysqli_query($conn, "Select * From category");

                $countCategory = mysqli_num_rows($selectCategory);

                for ($i = 0; $i < $countCategory; $i++) {
                    $category = mysqli_fetch_assoc($selectCategory);
                    $categoryName = $category['category_name'];
                ?>
                    <li class="navbar__item navMobileCategory">
                        <a href="#" class="navbar_links" data-subcategory="<?php echo $categoryName ?>SubNav" onclick="showSubCate(event)">
                            <?php echo $categoryName ?>
                            <span><i class="fa-solid fa-chevron-right"></i></span>
                        </a>
                    </li>
                <?php
                }
                ?>


            </ul>

            <?php


            $selectCategory = mysqli_query($conn, "Select * From category");

            $countCategory = mysqli_num_rows($selectCategory);

            for ($i = 0; $i < $countCategory; $i++) {

                $arrCategory = mysqli_fetch_assoc($selectCategory);

                $category_id = $i + 1;

                $selectSubCategory1 = mysqli_query($conn, "Select * From subcategory where category_id = '$category_id'");
                $countSubCategory1 = mysqli_num_rows($selectSubCategory1);

            ?>
                <ul class="mobileSubNav navbar_menu" id="<?php echo $arrCategory['category_name'] ?>SubNav">

                    <a href="#" class="text-primary" style="margin:10px 0px 0px;" data-subcategory="<?php echo $arrCategory['category_name'] ?>SubNav" onclick="hideSubCate(this)"><i class="fa-solid fa-arrow-left"></i> Back</a>


                    <?php

                    for ($j = 0; $j < $countSubCategory1; $j++) {

                        $arrSubCategory = mysqli_fetch_array($selectSubCategory1);

                    ?>

                        <li class="navbar_item">
                            <a href="#" class="navbar_links" id="course_list">
                                <?php echo $arrSubCategory['subcategory_name']; ?>
                                <span><i class="fa-solid fa-chevron-right"></i></span>
                            </a>
                        </li>

                <?php
                    }

                    echo  "</ul>";
                }
                ?>


        </div>

    </div>