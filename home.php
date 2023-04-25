<?php
include_once "headertest.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: signup.php");
}


?>



<div id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">

        <div class="row">
            <div class="col-12">
                <div class="swiper sliderFeaturedPosts">
                    <div class="swiper-wrapper">


                        <div class="swiper-slide">
                            <a href="single-post.html" class="img-bg d-flex align-items-end"
                                style="background-image: url('assets/images/post-slide-1.jpg');">
                                <div class="img-bg-inner">
                                    <h2>Learn from Anywhere with MyanLearn Online Learning Platform</h2>
                                    <p> MyanLearn is a leading online learning platform that offers a wide range of
                                        courses, from programming and data science to business and finance. Our platform
                                        is designed to be user-friendly and accessible, with expert instructors and
                                        interactive tools to enhance your learning experience.Join MyanLearn today and
                                        start your path to success!</p>
                                </div>
                            </a>
                        </div>

                        <div class="swiper-slide">
                            <a href="single-post.html" class="img-bg d-flex align-items-end"
                                style="background-image: url('assets/images/post-slide-2.jpg');">
                                <div class="img-bg-inner">
                                    <h2>Transform Your Future with MyanLearn</h2>
                                    <p>Join MyanLearn today and unlock your full potential, achieve your learning goals,
                                        and pave the way for a brighter future.</p>
                                </div>
                            </a>
                        </div>


                    </div>

                    <div class="custom-swiper-button-next">
                        <span class="bi-chevron-right"></span>
                    </div>
                    <div class="custom-swiper-button-prev">
                        <span class="bi-chevron-left"></span>
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Slider Section -->

</div><!-- End #main -->


<!-- Course Section Start -->
<div class="courseWrapper">
    <div class="course_section_title">
        <h2>Recommended to you</h2>
    </div>
    <div class="wrapperSlider">
        <i id="left" class="fa-solid fa-angle-left sliderArrow"></i>
        <div class="carouselSlider">

            <div class="course_container">

                <?php

                $SelectPublishedCourse = "SELECT * FROM course
                                            WHERE course_status = 'published'
                                            AND course_price != 'Free'";
                $runPublishedCourse = mysqli_query($conn, $SelectPublishedCourse);



                for ($i = 0; $i < 5; $i++) {

                    $arrPublishedCourse = mysqli_fetch_array($runPublishedCourse);
                    $InstructorID = $arrPublishedCourse['instructor_id'];
                    $SelectInstructor = "SELECT * FROM users
                                     WHERE unique_id='$InstructorID'";
                    $runSelectInstructor = mysqli_query($conn, $SelectInstructor);
                    $arrInstructor = mysqli_fetch_array($runSelectInstructor);

                    $CourseID = $arrPublishedCourse['course_id'];
                    $SelectCourseVideo = "SELECT * FROM coursevideo
                                     WHERE course_id='$CourseID'";
                    $runSelectCourseVideo = mysqli_query($conn, $SelectCourseVideo);

                    $countvideo = mysqli_num_rows($runSelectCourseVideo);
                    $TotalDuration = 0;

                    for ($l = 1; $l <= $countvideo; $l++) {

                        $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);
                        $Duration = intval($arrCourseVideo['runTime']);
                        
                        $TotalDuration = $TotalDuration + $Duration;
                        // echo "<script>alert(".$TotalDuration.");</script>";
                    }

                    $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';
                    ;

                    $Price = $arrPublishedCourse['course_price'];
                    $CourseLevel = $arrPublishedCourse['course_level'];
                    $CourseImage = $arrPublishedCourse['preview_image'];
                    $CourseTitle = $arrPublishedCourse['course_title'];
                    $FullName = $arrInstructor['fullName'];

                    $categorySelect = "SELECT * from category WHERE category_id = {$arrPublishedCourse['course_category']};";
                    $queryCat = mysqli_query($conn, $categorySelect);
                    $arrCat = mysqli_fetch_array($queryCat);

                    $subcategorySelect = "SELECT * from subcategory WHERE subcategory_id = {$arrPublishedCourse['course_subcategory']};";
                    $querySubCat = mysqli_query($conn, $subcategorySelect);
                    $arrSubCat = mysqli_fetch_array($querySubCat);



                    ?>
                    <div class="course_card_wrapper">
                        <a href="courseviewdetail.php?CourseID=<?php echo $CourseID; ?>" class="card_img_top">
                            <img src="<?php echo $CourseImage; ?>" alt="">
                        </a>
                        <div class="card_body">
                            <h4>
                                <a href="courseviewdetail.php?CourseID=<?php echo $CourseID; ?>" class="course_title"><?php echo $CourseTitle; ?></a>
                            </h4>
                            <ul>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <i class="fa-regular fa-clock"></i>
                                            <span>
                                                <?php echo $TotalDurationHours; ?>
                                            </span> |
                                        </div>

                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">

                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <i class="fas fa-film"></i>
                                            <span>
                                                <?php echo $countvideo; ?> Lecture Videos
                                            </span>
                                        </div>

                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                <rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
                                                <rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
                                            </svg>
                                            <span class="align-middle">
                                                <?php echo $CourseLevel; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            <span>
                                                <?php echo $FullName; ?>
                                            </span>
                                        </div>

                                    </div>

                                </li>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div
                                                style="background-color: gray; padding: 6px 10px 6px 13px; border-radius: 8px;">
                                                <p style="color: white; margin: 0px;">
                                                    <?php echo (strlen($arrCat['category_name']) > 11) ? substr($arrCat['category_name'], 0, 11) . '..' : $arrCat['category_name']; ?>
                                                </p>

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div
                                                style="background-color: gray; padding: 6px 10px 6px 13px; border-radius: 8px;">
                                                <p style="color: white; margin: 0px;">
                                                    <?php echo (strlen($arrSubCat['subcategory_name']) > 11) ? substr($arrSubCat['subcategory_name'], 0, 11) . '..' : $arrSubCat['subcategory_name']; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="teacherProfileCourse">
                                <img src='<?php echo $arrInstructor['image'] ?>' alt="">
                            </div>
                            <div class="teacherNameCourse">
                                <span>
                                    <a href='profile.php?unique_id=<?php echo $arrInstructor['unique_id'] ?>'><?php echo $FullName; ?></a>
                                </span>
                            </div>
                            <div class="courseWishList">
                                <a href="">
                                    <i class="fa-regular fa-bookmark"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>



            </div>
            <!-- course container -->

            <!-- By setting draggable false to make working fine on firefox  -->
        </div>
        <i id="right" class="fa-solid fa-angle-right sliderArrow"></i>
    </div>
</div>
<!-- Course Section End -->


<!-- Recent Free Course Section Start -->
<div class="courseWrapper">
    <div class="course_section_title">
        <h2>Recent Free Course</h2>
    </div>
    <div class="wrapperSlider1">
        <i id="left" class="fa-solid fa-angle-left sliderArrow"></i>
        <div class="carouselSlider1">

            <div class="course_container">

                <?php

                $SelectFreeCourse = "SELECT * FROM course
                                    WHERE course_status = 'published'
                                    AND course_price = 'Free'
                                    ORDER BY course_date DESC
                                    LIMIT 5";
                $runFreeCourse = mysqli_query($conn, $SelectFreeCourse);
                $countFreeCourse = mysqli_num_rows($runFreeCourse);



                for ($j = 0; $j < $countFreeCourse; $j++) {

                    $arrFreeCourse = mysqli_fetch_array($runFreeCourse);
                    $InstructorID1 = $arrFreeCourse['instructor_id'];
                    $SelectInstructor1 = "SELECT * FROM users
                                     WHERE unique_id='$InstructorID1'";
                    $runSelectInstructor1 = mysqli_query($conn, $SelectInstructor1);
                    $arrInstructor1 = mysqli_fetch_array($runSelectInstructor1);

                    $CourseID1 = $arrFreeCourse['course_id'];
                    $SelectCourseVideo1 = "SELECT * FROM coursevideo
                                     WHERE course_id='$CourseID1'";
                    $runSelectCourseVideo1 = mysqli_query($conn, $SelectCourseVideo1);

                    $countvideo1 = mysqli_num_rows($runSelectCourseVideo1);

                    $TotalDuration = 0;

                    for ($l = 1; $l <= $countvideo1; $l++) {

                        $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo1);
                        $Duration = intval($arrCourseVideo['runTime']);
                        $TotalDuration = $TotalDuration + $Duration;
                    }

                    $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';
                    ;

                    $Price = $arrFreeCourse['course_price'];
                    $CourseLevel = $arrFreeCourse['course_level'];
                    $CourseImage = $arrFreeCourse['preview_image'];
                    $CourseTitle = $arrFreeCourse['course_title'];
                    $FullName = $arrInstructor1['fullName'];

                    $categorySelect = "SELECT * from category WHERE category_id = {$arrFreeCourse['course_category']};";
                    $queryCat = mysqli_query($conn, $categorySelect);
                    $arrCat = mysqli_fetch_array($queryCat);

                    $subcategorySelect = "SELECT * from subcategory WHERE subcategory_id = {$arrFreeCourse['course_subcategory']};";
                    $querySubCat = mysqli_query($conn, $subcategorySelect);
                    $arrSubCat = mysqli_fetch_array($querySubCat);



                    ?>
                    <div class="course_card_wrapper">
                        <a href="courseviewdetail.php?CourseID=<?php echo $CourseID1; ?>" class="card_img_top">
                            <img src="<?php echo $CourseImage; ?>" alt="">
                        </a>
                        <div class="card_body">
                            <h4>
                                <a href="courseviewdetail.php?CourseID=<?php echo $CourseID1; ?>" class="course_title"><?php echo $CourseTitle; ?></a>
                            </h4>
                            <ul>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <i class="fa-regular fa-clock"></i>
                                            <span>
                                                <?php echo $TotalDurationHours; ?>
                                            </span> |
                                        </div>

                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">

                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <i class="fas fa-film"></i>
                                            <span>
                                                <?php echo $countvideo1; ?> Lecture Videos
                                            </span>
                                        </div>

                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                <rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
                                                <rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
                                            </svg>
                                            <span class="align-middle">
                                                <?php echo $CourseLevel; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            <span>
                                                <?php echo $FullName; ?>
                                            </span>
                                        </div>

                                    </div>

                                </li>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div
                                                style="background-color: gray; padding: 6px 10px 6px 13px; border-radius: 8px;">
                                                <p style="color: white; margin: 0px;">
                                                    <?php echo (strlen($arrCat['category_name']) > 11) ? substr($arrCat['category_name'], 0, 11) . '..' : $arrCat['category_name']; ?>
                                                </p>

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div
                                                style="background-color: gray; padding: 6px 10px 6px 13px; border-radius: 8px;">
                                                <p style="color: white; margin: 0px;">
                                                    <?php echo (strlen($arrSubCat['subcategory_name']) > 11) ? substr($arrSubCat['subcategory_name'], 0, 11) . '..' : $arrSubCat['subcategory_name']; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="teacherProfileCourse">
                                <img src='<?php echo $arrInstructor1['image'] ?>' alt="">
                            </div>
                            <div class="teacherNameCourse">
                                <span>
                                    <a href='profile.php?unique_id=<?php echo $arrInstructor1['unique_id'] ?>'><?php echo $FullName; ?></a>
                                </span>
                            </div>
                            <div class="courseWishList">
                                <a href="">
                                    <i class="fa-regular fa-bookmark"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>



            </div>
            <!-- course container -->

            <!-- By setting draggable false to make working fine on firefox  -->
        </div>
        <i id="right" class="fa-solid fa-angle-right sliderArrow"></i>
    </div>
</div>
<!-- Recent Free Course Section End -->




<!-- Top Seller Course Start -->
<div class="courseWrapper">
    <div class="course_section_title">
        <h2>Top Seller Course</h2>
    </div>
    <div class="wrapperSlider2">
        <i id="left" class="fa-solid fa-angle-left sliderArrow"></i>
        <div class="carouselSlider2">

            <div class="course_container">

                <?php

                $topSelling = "SELECT *, course_id, COUNT(*) AS sales_count
                                FROM purchasedetail
                                GROUP BY course_id
                                ORDER BY sales_count DESC
                                LIMIT 5;";
                $queryTopSelling = mysqli_query($conn, $topSelling);
                $countTopSelling = mysqli_num_rows($queryTopSelling);

                for ($k = 0; $k < $countTopSelling; $k++) {

                    $arrTopSelling = mysqli_fetch_array($queryTopSelling);

                    $InstructorID1 = $arrTopSelling['instructor_unique_id'];
                    $SelectInstructor1 = "SELECT * FROM users
                                     WHERE unique_id='$InstructorID1'";
                    $runSelectInstructor1 = mysqli_query($conn, $SelectInstructor1);
                    $arrInstructor1 = mysqli_fetch_array($runSelectInstructor1);

                    $CourseID1 = $arrTopSelling['course_id'];
                    $SelectCourseVideo1 = "SELECT * FROM coursevideo
                                     WHERE course_id='$CourseID1'";
                    $runSelectCourseVideo1 = mysqli_query($conn, $SelectCourseVideo1);

                    $countvideo1 = mysqli_num_rows($runSelectCourseVideo1);

                    $TotalDuration = 0;

                    for ($l = 1; $l <= $countvideo1; $l++) {

                        $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo1);
                        $Duration = intval($arrCourseVideo['runTime']);
                        $TotalDuration = $TotalDuration + $Duration;
                    }

                    $TotalDurationHours = floor($TotalDuration / 60) . 'Hours ' . ($TotalDuration % 60) . 'Minutes';

                    $selectCourse = "SELECT * FROM course
                                    WHERE course_id = '$CourseID1' ";
                    $runSelectCourse = mysqli_query($conn, $selectCourse);
                    $arrCourse = mysqli_fetch_array($runSelectCourse);

                    $Price = $arrCourse['course_price'];
                    $CourseLevel = $arrCourse['course_level'];
                    $CourseImage = $arrCourse['preview_image'];
                    $CourseTitle = $arrCourse['course_title'];
                    $FullName = $arrInstructor1['fullName'];

                    $categorySelect = "SELECT * from category WHERE category_id = {$arrCourse['course_category']};";
                    $queryCat = mysqli_query($conn, $categorySelect);
                    $arrCat = mysqli_fetch_array($queryCat);

                    $subcategorySelect = "SELECT * from subcategory WHERE subcategory_id = {$arrCourse['course_subcategory']};";
                    $querySubCat = mysqli_query($conn, $subcategorySelect);
                    $arrSubCat = mysqli_fetch_array($querySubCat);



                    ?>
                    <div class="course_card_wrapper">
                        <a href="courseviewdetail.php?CourseID=<?php echo $CourseID1; ?>" class="card_img_top">
                            <img src="<?php echo $CourseImage; ?>" alt="">
                        </a>
                        <div class="card_body">
                            <h4>
                                <a href="courseviewdetail.php?CourseID=<?php echo $CourseID1; ?>" class="course_title"><?php echo $CourseTitle; ?></a>
                            </h4>
                            <ul>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <i class="fa-regular fa-clock"></i>
                                            <span>
                                                <?php echo $TotalDurationHours; ?>
                                            </span> |
                                        </div>

                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">

                                    <div class="row">
                                        <div class="col-md-8 col-8">
                                            <i class="fas fa-film"></i>
                                            <span>
                                                <?php echo $countvideo1; ?> Lecture Videos
                                            </span>
                                        </div>

                                    </div>
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                <rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
                                                <rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
                                            </svg>
                                            <span class="align-middle">
                                                <?php echo $CourseLevel; ?>
                                            </span>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                            <span>
                                                <?php echo $FullName; ?>
                                            </span>
                                        </div>

                                    </div>

                                </li>
                                <li style="margin-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div
                                                style="background-color: gray; padding: 6px 10px 6px 13px; border-radius: 8px;">
                                                <p style="color: white; margin: 0px;">
                                                    <?php echo (strlen($arrCat['category_name']) > 11) ? substr($arrCat['category_name'], 0, 11) . '..' : $arrCat['category_name']; ?>
                                                </p>

                                            </div>

                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div
                                                style="background-color: gray; padding: 6px 10px 6px 13px; border-radius: 8px;">
                                                <p style="color: white; margin: 0px;">
                                                    <?php echo (strlen($arrSubCat['subcategory_name']) > 11) ? substr($arrSubCat['subcategory_name'], 0, 11) . '..' : $arrSubCat['subcategory_name']; ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                </li>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="teacherProfileCourse">
                                <img src='<?php echo $arrInstructor1['image'] ?>' alt="">
                            </div>
                            <div class="teacherNameCourse">
                                <span>
                                    <a href='profile.php?unique_id=<?php echo $arrInstructor1['unique_id'] ?>'><?php echo $FullName; ?></a>
                                </span>
                            </div>
                            <div class="courseWishList">
                                <a href="">
                                    <i class="fa-regular fa-bookmark"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>



            </div>
            <!-- course container -->

            <!-- By setting draggable false to make working fine on firefox  -->
        </div>
        <i id="right" class="fa-solid fa-angle-right sliderArrow"></i>
    </div>
</div>
<!-- Top Seller Course Section End -->




<!--=====================================-->
<!--=       Categories Area Start      =-->
<!--=====================================-->
<!-- Start Categories Area  -->
<div class="edu-categorie-area categorie-area-2 edu-section-gap">
    <div class="container">
        <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
            <h2 class="title">Top Categories</h2>
            <span class="shape-line"><i class="icon-19"></i></span>
            <p>Explore our top courses in various categories and find the perfect fit for your learning needs!</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-4 col-md-6" data-sal-delay="50" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-primary-style edublink-svg-animate">
                    <div class="icon">
                        <i class="icon-9"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Development</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-secondary-style">
                    <div class="icon">
                        <i class="icon-15"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Business & Finess</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-extra01-style">
                    <div class="icon">
                        <i class="icon-11 personal-development"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Personal Development</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="50" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-tertiary-style">
                    <div class="icon">
                        <i class="icon-12 health-fitness"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Health & Fitness</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-extra02-style">
                    <div class="icon">
                        <i class="icon-13 data-science"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">IT Software</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-extra03-style">
                    <div class="icon">
                        <i class="icon-14"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Marketing</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="50" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-extra04-style">
                    <div class="icon">
                        <i class="fa-solid fa-compass-drafting computer-science"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Design</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-extra05-style">
                    <div class="icon">
                        <i class="bi bi-file-earmark-music computer-science"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Music</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <div class="categorie-grid categorie-style-2 color-extra06-style">
                    <div class="icon">
                        <i class="icon-17 video-photography"></i>
                    </div>
                    <div class="content">
                        <a href="search_result.php">
                            <h5 class="title">Video & Photography</h5>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Categories Area  -->
<!--=====================================-->
<!--=       About Us Area Start      	=-->
<!--=====================================-->
<div class="gap-bottom-equal edu-about-area about-style-1">
    <div class="container edublink-animated-shape">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="about-image-gallery">
                    <img class="main-img-1" src="assets/images/TeachOnMyanLearn.jpg" alt="About Image">

                    <div class="award-status bounce-slide">
                        <div class="inner">
                            <div class="icon">
                                <i class="icon-21"></i>
                            </div>
                            <div class="content">
                                <h6 class="title">Earn Fortune</h6>
                                <span class="subtitle">Teach the world online</span>
                            </div>
                        </div>
                    </div>
                    <ul class="shape-group">
                        <li class="shape-1 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <img data-depth="1" src="assets/images/shape-36.png" alt="Shape">
                        </li>
                        <li class="shape-2 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <img data-depth="-1" src="assets/images/shape-37.png" alt="Shape">
                        </li>
                        <li class="shape-3 scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <img data-depth="1" src="assets/images/shape-02.png" alt="Shape">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6" data-sal-delay="150" data-sal="slide-left" data-sal-duration="800">
                <div class="about-content">
                    <div class="section-title section-left">
                        <span class="pre-title">Earn for better Future!</span>
                        <h2 class="title">Apply your skillset across Country<span class="color-secondary"> via
                                MyanLearn</span></h2>
                        <span class="shape-line"><i class="icon-19"></i></span>
                        <p> Looking to teach online? Join MyanLearn! Our platform offers a seamless teaching experience
                            with easy-to-use tools and access to a wide audience. Plus, you'll earn competitive
                            compensation for your expertise. Sign up now and start sharing your knowledge with the
                            world.</p>
                    </div>
                    <ul class="features-list">
                        <li>Apply your Skillset</li>
                        <li>Online Remote Teaching</li>
                        <li>Lifetime Access</li>
                        <li>Make Fortune</li>
                    </ul>

                    <div class="col-sm-12">
                        <a href="instructorsignup.php" name="EnrollNowBtn" id="EnrollNowBtn" class="edu-btn">Become
                            Instructor Today<i class="icon-4"></i></a>

                    </div>
                </div>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1 circle scene" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                <span data-depth="-2.3"></span>
            </li>
        </ul>
    </div>
</div>



<div class="rn-progress-parent">
    <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>



</div>

<!-- Footer Section -->
<?php include_once "footer.php"; ?>

<!-- Script JS -->

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>


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

<!-- Main Js -->
<script src="assets/js/home.js"></script>
<script src="assets/js/app.js"></script>


<script>
    var swiper = new Swiper(".sliderFeaturedPosts", {
        spaceBetween: 0,
        speed: 500,
        centeredSlides: true,
        loop: true,
        slideToClickedSlide: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".custom-swiper-button-next",
            prevEl: ".custom-swiper-button-prev",
        },
    });
</script>

<script>
    let subMenu = document.getElementById("subMenu");
    let profileImage = document.querySelector(".profileImage");

    profileImage.addEventListener("click", () => {
        subMenu.classList.toggle("open-menu");
    })
</script>

<!-- For Preloader -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    setTimeout(function () {
        $('.preloader').fadeToggle();
        // $('.Vertical_Nav').fadeIn();
        $('body').removeClass("invisible");

    }, 1000);
</script>






</body>

</html>