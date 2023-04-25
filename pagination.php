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
    <div class="wrapperSlider1">
        <i id="left" class="fa-solid fa-angle-left sliderArrow"></i>
        <div class="carouselSlider1">

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

                    for ($l = 1; $l <= $countvideo; $l++) {

                        $arrCourseVideo = mysqli_fetch_array($runSelectCourseVideo);
                        $Duration = intval($arrCourseVideo['runTime']);
                        $TotalDuration = 0;
                        $TotalDuration = $TotalDuration + $Duration;
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
                                <img src="assets/images/profile.jpg" alt="">
                            </div>
                            <div class="teacherNameCourse">
                                <span>
                                    <?php echo $FullName; ?>
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






<div class="course_card_wrapper">
    <a href="" class="card_img_top">
        <img src="https://geeks.madrasthemes.com/wp-content/uploads/2021/09/course-graphql.jpg" alt="">
    </a>
    <div class="card_body">
        <h4>
            <a href="" class="course_title">GraphQL: Introduction to graphQL for beginners</a>
        </h4>
        <ul>
            <li>
                <i class="fa-regular fa-clock"></i>
                <span>2hours 46minutes</span>
            </li>
            <li>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                    <rect x="7" y="5" width="2" height="9" rx="1" fill="#754FFE"></rect>
                    <rect x="11" y="2" width="2" height="12" rx="1" fill="#754FFE"></rect>
                </svg>
                <span class="align-middle">
                    Expert
                </span>
            </li>
        </ul>
    </div>
    <div class="card-footer">
        <div class="teacherProfileCourse">
            <img src="assets/images/profile.jpg" alt="">
        </div>
        <div class="teacherNameCourse">
            <span>Ted Hawkins</span>
        </div>
        <div class="courseWishList">
            <a href="">
                <i class="fa-regular fa-bookmark"></i>
            </a>
        </div>
    </div>
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

<!-- Main Js -->

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
<script src="home.js"></script>

<script>
    setTimeout(function () {
        $('.preloader').fadeToggle();
        // $('.Vertical_Nav').fadeIn();
        $('body').removeClass("invisible");

    }, 1000);
</script>

<script>


    // for Recommend Course

    const wrapperSlider1 = document.querySelector(".wrapperSlider1");
    const carouselSlider1 = wrapperSlider1.querySelector(".carouselSlider1");
    firstImg1 = wrapperSlider1.querySelectorAll('img')[0];
    arrowIcons1 = wrapperSlider1.querySelectorAll(".wrapperSlider1 i");

    let isdragStart11 = false, isdragging11 = false, prevPageX1, prevScrollLeft1, positionDiff1;


    const showHideIcons = () => {

        let scrollWidth = carouselSlider1.scrollWidth - carouselSlider1.clientWidth; //getting max scrollable width
        // if the carousel scroll left val is 0 then hide the prev icon else show it
        arrowIcons1[0].style.display = carouselSlider1.scrollLeft == 0 ? "none" : "block";
        arrowIcons1[1].style.display = carouselSlider1.scrollLeft == scrollWidth ? "none" : "block";

    }

    arrowIcons1.forEach(icon => {
        icon.addEventListener("click", () => {

            let firstImg1Width1 = firstImg1.clientWidth + 14; //getting first img width & adding 14 px val of margin
            // if clicked icon is left, reduce width value from the carousel scroll left else add to it
            carouselSlider1.scrollLeft += icon.id == "left" ? -firstImg1Width1 : firstImg1Width1;

            // if(icon.id == "left")
            // {
            //     carouselSlider1.scrollLeft -= firstImg1Width1;
            // }
            // else
            // {   
            //     carouselSlider1.scrollLeft += firstImg1Width1;
            // }

            setTimeout(() => showHideIcons(), 60); //calling shiowHideIcons after 60ms
        });
    });

    const autoSlieToMiddle1 = () => {

        //if there is no img left to scroll then return from here
        if (carouselSlider1.scrollLeft == (carouselSlider1.scrollWidth - carouselSlider1.clientWidth)) return;


        positionDiff1 = Math.abs(positionDiff1); // making positionDiff1 into positive value
        let firstImg1Width1 = firstImg1.clientWidth + 14;
        //getting idfference value that needs to add or reduce from carousel left to take img to middle center
        let valDifference1 = firstImg1Width1 - positionDiff1;


        if (carouselSlider1.scrollLeft > prevScrollLeft1) //user is scrolling to the right
        {
            return carouselSlider1.scrollLeft += positionDiff1 > firstImg1Width1 / 3 ? valDifference1 : -positionDiff1;

            //    if(positionDiff1 > firstImg1Width1 / 3)
            //    {
            //         carouselSlider1.scrollLeft += valDifference1;
            //    }
            //    else
            //    {
            //         carouselSlider1.scrollLeft -= positionDiff1;
            //    }



        }
        else // user is scrolling to the left
            carouselSlider1.scrollLeft -= positionDiff1 > firstImg1Width1 / 3 ? valDifference1 : -positionDiff1;

    }

    const dragStart1 = (e) => {
        //updating global variables value on mouse down event
        isdragStart11 = true;
        // For X coordinate of the mouse pointer or touch
        prevPageX1 = e.pageX || e.touches[0].pageX; //e.pageX will run on desktop devices and on touch devices e.touches[0].pageX run
        prevScrollLeft1 = carouselSlider1.scrollLeft;
    }

    const dragging1 = (e) => {
        if (!isdragStart11) return;
        e.preventDefault();
        isdragging11 = true;
        carouselSlider1.classList.add('dragging1');
        positionDiff1 = (e.pageX || e.touches[0].pageX) - prevPageX1;

        requestAnimationFrame(() => {
            carouselSlider1.scrollLeft = prevScrollLeft1 - positionDiff1;
            showHideIcons();
        });
    }

    const dragStop1 = () => {
        isdragStart11 = false;
        carouselSlider1.classList.remove('dragging1');

        if (!isdragging11) return;
        isdragging11 = false;
        autoSlieToMiddle1();
    }

    carouselSlider1.addEventListener("mousedown", dragStart1);
    carouselSlider1.addEventListener("touchstart", dragStart1);

    carouselSlider1.addEventListener("mousemove", dragging1);
    carouselSlider1.addEventListener("touchmove", dragging1);

    carouselSlider1.addEventListener("mouseup", dragStop1);
    carouselSlider1.addEventListener("mouseleave", dragStop1);
    carouselSlider1.addEventListener("touchend", dragStop1);
</script>



</body>

</html>