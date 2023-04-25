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
} else {

    $user_id = $_SESSION['unique_id'];

    $checkInstructorsql = mysqli_query($conn, "Select * From instructors Where unique_id = $user_id");
    if (mysqli_num_rows($checkInstructorsql) < 1) //there is no data that mean user is applying instructor
    {
        $insertInstructor = "INSERT INTO instructors
            (unique_id)
            VALUES
            ('$user_id')";
        $runinsertInstructor = mysqli_query($conn, $insertInstructor);

        $_SESSION['instructor_id'] = $user_id;

        if ($runinsertInstructor = 1) {
            echo "<script>
            Swal.fire('Instructor added successfully!');
            </script>";

            echo "<script>window.alert('Instrcutor Account Creation Success');</script>";
        } else {
        }
        // echo "<script>window.alert(".$_SESSION['runinsertInstructor'].");</script>";


    } else //ther is already users as insturctor
    {
        $instructorRow = mysqli_fetch_assoc($checkInstructorsql);
        $_SESSION['instructor_id'] = $instructorRow['unique_id'];
    }

    $numrow = mysqli_num_rows($checkInstructorsql);

    // echo "<script>window.alert(".$_SESSION['instructor_id'].");</script>";



}



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
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Include SweetAlert CSS file -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/sweetalert/sweetalert2.min.css">

    <!-- Include SweetAlert JavaScript file -->
    <script type="text/javascript" src="assets/vendor/sweetalert/sweetalert2.min.js"></script>

    <style>
        .sidebarMobile {
            display: none;
        }

        @media (max-width: 500px) {

            .sidebar {
                display: none;
            }

            section.home {
                left: 0px !important;
                width: 100% !important;
            }

            .menuBarIcon {
                margin-top: 27px;
                font-size: 26px;
            }

        }
    </style>


</head>

<body>

    <div class="nav-bar">

        <?php
        include_once "config.php";
        $sql = mysqli_query($conn, "Select * From users Where unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
        }

        $checkInstructorsql = mysqli_query($conn, "Select * From instructors Where unique_id = {$_SESSION['unique_id']}");
        if (mysqli_num_rows($checkInstructorsql) > 0) //there is data
        {
            $instructorLink = "instructorDashboard.php";
            $instructorText = "Instructor Dashboard";
            // echo "<script>window.alert(".mysqli_num_rows($checkInstructorsql).");</script>";
        } else {
            $instructorLink = "instructorsignup.php";
            $instructorText = "Teach on MyanLearn";
        }

        ?>

        <i class="fa-solid fa-bars menuBarIcon"></i>


        <div class="user mt-02">
            <img src="<?php echo $row['image'] ?>" alt="" class="profileImage">
        </div>

        <div class="sub-menu-wrap-user" id="subMenu">
            <div class="sub-menu">
                <div class="user-info">
                    <img src="<?php echo $row['image'] ?>" alt="" srcset="">
                    <div class="user_name">
                        <h5>Hi, <span class="primaryColor"><?php echo $row['fullName'] ?></span></h5>
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

                <a href="home.php" class="sub-menu-link">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <p>Student</p>

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
    </div>


    <nav class="sidebar close sidebarNormal">

        <div class="logoWrap">
            <a href="home.php">
                <img src="assets/images/logo1.png" alt="" class="logoImage logoDefault">
                <img src="assets/images/logoMobile2.png" alt="" class="logoImage mobileSizeLogo">
            </a>           
            
        </div>

        <div class="profileWrap">
            <a href="">
                <div class="image-text">
                    <span class="image">
                        <img src="<?php echo $row['image'] ?>" alt="logo">
                    </span>

                    <div class="text header-text">
                        <span class="name">MyanLearn</span>
                        <span class="profession">Web Developer</span>
                    </div>
                </div>
            </a>

            <i class="bx bx-chevron-right toggle"></i>

        </div>


        <div class="menu-bar">
            <div class="menu">


                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="instructordashboard.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="CourseList.php">
                            <i class='bx bx-video icon'></i>
                            <span class="text nav-text">Courses</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="revenue.php">
                            <i class='bx bx-line-chart icon'></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="createNewCourse.php">
                            <i class='bx bx-folder-plus icon'></i>
                            <span class="text nav-text">Create Course</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="users1.php">
                            <i class='bx bx-message-rounded icon'></i>
                            <span class="text nav-text">Communication</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="payout.php">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Payout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <span class="mode-text text">Dark Mode</span>
                    <div class="themeSwitchWrapper">
                        <div>
                            <input type="checkbox" class="checkbox" id="modeSwitch" />
                            <label class="label" for="modeSwitch">
                                <i class="fa-solid fa-moon"></i>
                                <img src="assets/images/sun.png" class="fa-sun">
                                <div class="ball"></div>
                            </label>
                        </div>
                    </div>


                </li>
            </div>
        </div>
    </nav>

    <nav class="sidebar sidebarMobile">

        <div class="logoWrap">
            <img src="assets/images/logo1.png" alt="" class="logoImage logoDefault">
            <img src="assets/images/logoMobile2.png" alt="" class="logoImage mobileSizeLogo">
        </div>

        <div class="profileWrap">
            <a href="">
                <div class="image-text">
                    <span class="image">
                        <img src="assets/images/profile.jpg" alt="logo">
                    </span>

                    <div class="text header-text">
                        <span class="name">MyanLearn</span>
                        <span class="profession">Web Developer</span>
                    </div>
                </div>
            </a>

            <i class="bx bx-chevron-left toggle toggleMobile"></i>

        </div>


        <div class="menu-bar">
            <div class="menu">


                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="instructordashboard.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-video icon'></i>
                            <span class="text nav-text">Courses</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-line-chart icon'></i>
                            <span class="text nav-text">Revenue</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="createNewCourse.php">
                            <i class='bx bx-folder-plus icon'></i>
                            <span class="text nav-text">Create Course</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-message-rounded icon'></i>
                            <span class="text nav-text">Communication</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Payout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <span class="mode-text text">Dark Mode</span>
                    <div class="themeSwitchWrapper">
                        <div>
                            <input type="checkbox" class="checkbox" id="modeSwitch" />
                            <label class="label" for="modeSwitch">
                                <i class='bx bxs-moon fa-moon'></i>
                                <img src="assets/images/sun.png" class="fa-sun">
                                <div class="ball"></div>
                            </label>
                        </div>
                    </div>


                </li>
            </div>
        </div>
    </nav>

    <script src="assets/js/instructordashboard.js"></script>





    <script>
        const modeSwitch = document.getElementById('modeSwitch');
        const toggle = document.querySelector('.toggle');
        const toggleMobile = document.querySelector('.toggleMobile');
        const sidebar = document.querySelector('.sidebar');
        const modeText = document.querySelector('.mode-text');
        const menuBarIcon = document.querySelector(".menuBarIcon");
        const sidebarNormal = document.querySelector(".sidebarNormal");
        const sidebarMobile = document.querySelector(".sidebarMobile");


        modeSwitch.addEventListener("click", () => {
            document.body.classList.toggle("dark");

            if (document.body.classList.contains("dark")) {
                modeText.innerText = "Light Mode"
            } else {
                modeText.innerText = "Dark Mode"
            }

        });

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            document.querySelector('.logoMobile2').classList.toggle('hide');
            document.querySelector('.logoDefault').classList.toggle('hide');
        });

        menuBarIcon.addEventListener("click", () => {
            sidebarMobile.style.display = "block";
            document.querySelector('.logoMobile2').classList.toggle('hide');
            document.querySelector('.logoDefault').classList.toggle('hide');
        });

        toggleMobile.addEventListener("click", () => {
            sidebarMobile.style.display = "none";
            document.querySelector('.logoMobile2').classList.toggle('hide');
            document.querySelector('.logoDefault').classList.toggle('hide');
        });



        var pageWidth500 = window.matchMedia("(max-width: 500px)");

        function media(pageWidth500) {
            if (pageWidth500.matches) { // If media query matches
                document.body.style.backgroundColor = "yellow";
                // window.alert("success");
                sidebarNormal.style.display = "none";
            } else {
                document.body.style.backgroundColor = "pink";
                //    window.alert("fail");
                sidebarNormal.style.display = "block";


            }
        }

        media(pageWidth500) // Call listener function at run time
        pageWidth500.addListener(media)
    </script>




</body>

</html>