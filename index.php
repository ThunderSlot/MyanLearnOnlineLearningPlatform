<?php
    session_start();
    if(isset($_SESSION['unique_id']))
    {
        header("location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyanLearn Online Learning Platform</title>
    <!-- Link CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">
    <!-- Link for Box Icon -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     <!-- Link Swiper's CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
   />    <!-- Link for Tab Logo -->
    <link rel="icon" href="assets/images/logomobile.png">
    <!-- AOS Animation On Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <header class="header header-shadow" id="header">
        <div class="header-container">
            <a href="" class="logo">
                <img src="assets/images/logo.png" class="logo onlyDesktop">
                <img src="assets/images/logomobile.png" class="logo onlyMobile">
            </a>
            <nav class="nav">
               <ul class="nav-menu">
                    <li><a href="#" class="nav-link active">home</a></li>
                    <li><a href="#about" class="nav-link">about</a></li>
                    <li><a href="#courses" class="nav-link">courses</a></li>
                    <li><a href="#testimonials" class="nav-link">Reviews</a></li>
                    <li><a href="signup.php" class="signup">Sign Up</a></li>
               </ul>
               <div class="nav-close ">
                <i class='bx bx-x' ></i>
               </div>
            </nav>
            <div class="nav-toggle" id="nav-toggle">
                <i class='bx bx-menu' ></i>
            </div>
        </div>
    </header>
    <!-- Start Home Section -->
    <section class="home" id="home">
        <div class="container">
            <div class="left">
                <h1>Everything You Want <br> In One Place</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit.<br>
                 Dolorem odio consequatur omnis placeat dignissimos alias, eveniet sit at, nihil<br>
                 eaque corporis quibusdam? Alias incidunt explicabo suscipit, nihil provident voluptate vero.</p>
                 <form action="">
                     <input type="email" name="" id="" placeholder="Enter Your E-mail Address">
                     <button>Log In</button>
                 </form>
                 <div class="numbers">
                     <div class="child">
                         <h2>26K+</h2>
                         <h3>Appppreciates</h3>
                     </div>
                     <div class="child">
                         <h2>3.4K+</h2>
                         <h3>Courses</h3>
                     </div>
                     <div class="child">
                         <h2>100K+</h2>
                         <h3>Countries</h3>
                     </div>
                 </div>
            </div>
            <div class="right">
                <img src="assets/images/homeModel1.png" alt="homeModel1" class="home-model">
                <div class="icon">
                    <img src="assets/images/instagram.png" alt="Instagram">
                </div>
                <div class="icon">
                    <img src="assets/images/mortarboard.png" alt="moortarboard">
                </div>
                <div class="icon">
                    <img src="assets/images/tips.png" alt="tips">
                </div>
            </div>
        </div>
    </section>
    <!-- End Home Section -->

    <!-- Start About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="left" data-aos="fade-right">
                <img src="assets/images/aboutModel1.png" alt="about Model">
            </div>
            
            <div class="right" data-aos="fade-left">
               <h1>Why we learn <br> from <span>MyanLearn</span></h1>
               <p>Lorem ipsum dolor sit amet consectetur adipisicing 
                elit. <br> Accusamus quidem facilis explicabo reiciendis <br>
                error temporibus eveniet, minima illum nemo dolor velit <br>
                iure iste enim consequatur, ex, magnam numquam quam qui!</p>
                <div class="advantages">
                    <figure>
                        <img src="assets/images/icons/accept.png" alt="Correct icon">
                        Experienced Mentors 
                    </figure>
                    <figure>
                        <img src="assets/images/icons/accept.png" alt="Correct icon">
                       Friendly Prices
                    </figure>
                    <figure>
                        <img src="assets/images/icons/accept.png" alt="Correct icon">
                        High Quality Courses
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->
    <!-- Start Internships Section -->
    <section class="internships">
        <div class="main">
            <img src="assets/images/icons/google.png" alt="google" class="gl" data-aos="fade-left">
            <img src="assets/images/icons/FedEx.png" alt="FedEx" class="fx" data-aos="fade-left">
            <img src="assets/images/icons/YouTube.png" alt="YouTube" class="yt" data-aos="fade-right">
            <img src="assets/images/icons/Microsoft.png" alt="Microsoft" class="ms" data-aos="fade-right">
        </div>
    </section>
    <!-- End Internships Section -->
    <!-- Start Courses Section -->
    <section class="courses" id="courses">
        <div class="container">
            <h1>Explore <span>MyanLearn</span> Courses</h1>
            <div class="parent">
                <div class="child">
                    <img src="assets/images/icons/report.png" alt="report">
                    <h2>Data Science</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/graphic-tablet.png" alt="graphic-tablet">
                    <h2>Graphic Design</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/social-media.png" alt="social-media">
                    <h2>Marketing</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/video-camera.png" alt="video-camera">
                    <h2>Photography</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/ux.png" alt="ux">
                    <h2>Web Design</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/animate.png" alt="animate">
                    <h2>Motion Graphic</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/business.png" alt="business">
                    <h2>Business</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/binary-code.png" alt="binary-code">
                    <h2>Computer Science</h2>
                </div>
                <div class="child">
                    <img src="assets/images/icons/recording.png" alt="recording">
                    <h2>Voice Over</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End Courses Section -->
    <!-- Start Testimonials Section  -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="text">
                <h1>People Says About Courses</h1>
                <p>26K+ people already learning in MyanLearn! <br>
                     At quia, deserunt aut, odit natus tenetur molestiae,  <br>
                     consequuntur soluta amet perferendis unde dolor doloremque temporibus <br>
                      provident corporis est libero atque? Consectetur?</p>
            </div>
        </div>
        <div class="swiper swiper-cont">
            <div class="swiper-wrapper">
                <!-- item1 -->
                <div class="swiper-item swiper-slide">
                    <img src="assets/images/steve.png" alt="Man Model">
                    <div class="right">
                        <div class="stars">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                        </div>
                        <h1>Stebe Philips</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>
                             Possimus officiis optio at quos neque saepe alias nobis quia <br> 
                             aperiam similique tenetur voluptatibus, odit voluptatem ratione <br>
                             facilis consequatur fugit velit quae.</p>
                        <h2>Web Track</h2>     
                    </div>
                </div>
                 <!-- item 2 -->
                 <div class="swiper-item swiper-slide">
                    <img src="assets/images/katrina.png" alt="Woman Model">
                    <div class="right">
                        <div class="stars">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                        </div>
                        <h1>Kartrina Harvey</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>
                             Possimus officiis optio at quos neque saepe alias nobis quia <br> 
                             aperiam similique tenetur voluptatibus, odit voluptatem ratione <br>
                             facilis consequatur fugit velit quae.</p>
                        <h2>Web Track</h2>     
                    </div>
                </div>
                 <!-- item 3 -->
                 <div class="swiper-item swiper-slide">
                    <img src="assets/images/katrina.png" alt="Woman Model">
                    <div class="right">
                        <div class="stars">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                        </div>
                        <h1>Kartrina Harvey</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>
                             Possimus officiis optio at quos neque saepe alias nobis quia <br> 
                             aperiam similique tenetur voluptatibus, odit voluptatem ratione <br>
                             facilis consequatur fugit velit quae.</p>
                        <h2>Web Track</h2>     
                    </div>
                </div>
                 <!-- item 4 -->
                 <div class="swiper-item swiper-slide">
                    <img src="assets/images/katrina.png" alt="Woman Model">
                    <div class="right">
                        <div class="stars">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                            <img src="assets/images/icons/star.png" alt="Icon Star">
                        </div>
                        <h1>Kartrina Harvey</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>
                             Possimus officiis optio at quos neque saepe alias nobis quia <br> 
                             aperiam similique tenetur voluptatibus, odit voluptatem ratione <br>
                             facilis consequatur fugit velit quae.</p>
                        <h2>Web Track</h2>     
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- End Testimonials Section  -->

    <!-- Start Numbers Section -->
    <section class="numbers" id="numbers">
        <div class="container">
            <div class="parent" data-aos="fade-up">
                <div class="text">
                    <h1>+25</h1>
                    <h2>Popular <br> Insturctors</h2>
                </div>
                <img src="assets/images/shape.png" alt="Shape">
            </div>
            <div class="parent" data-aos="fade-up" data-aos-delay="100">
                <div class="text">
                    <h1>+25</h1>
                    <h2>Popular <br> Insturctors</h2>
                </div>
                <img src="assets/images/shape.png" alt="Shape">
            </div>
            <div class="parent" data-aos="fade-up" data-aos-delay="200">
                <div class="text">
                    <h1>+25</h1>
                    <h2>Popular <br> Insturctors</h2>
                </div>
                <img src="assets/images/shape.png" alt="Shape">
            </div>
            <div class="parent" data-aos="fade-up" data-aos-delay="300">
                <div class="text">
                    <h1>+25</h1>
                    <h2>Popular <br> Insturctors</h2>
                </div>
                <img src="assets/images/shape.png" alt="Shape">
            </div>
        </div>
    </section>
    <!-- End Numbers Section -->
    
    <!-- Start Contact Section -->
    <section class="contact_section" id="contact">
        <div class="container">
            <div class="left" data-aos="fade-right">
                <h1>Are you confident<br> For becoming Instructor?</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                Praesentium unde exercitationem impedit dignissimos dolor quos <br>
                 vitae quibusdam consequatur quam. Totam praesentium voluptate a <br>
                  tempora suscipit corporis soluta voluptatum minima eaque.</p>
                  <div class="instructorRegButton">
                    <button>Start teaching today</button>
                  </div>
            </div>
            <div class="right" data-aos="fade-left">
                <img src="assets/images/teacher1.png" alt="ContactModel">
            </div>
        </div>
    </section>
    <!-- End Contact Section -->

    <!-- Start Footer Section  -->
    <footer class="footer" id="footer">
        <div class="footer-list">
            <div class="footer-data" data-aos="fade-right">
                <a href=""><img src="assets/images/logo.png" alt=""></a>
                <div class="footer-data-social">
                    <a href=""><i class="fab fa-facebook"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div>
                <div class="download">
                    <img src="assets/images/icons/googlePlay.png" alt="Google Play">
                    <img src="assets/images/icons/appStore.png" alt="App Store">
                </div>
            </div>
            <div class="footer-data" data-aos="fade-right">
                <h2>MyanLearn</h2>
                <p>Business</p>
                <p>Afilliate</p>
                <p>Careers</p>
            </div>
            <div class="footer-data" data-aos="fade-left">
                <h2>Contact</h2>
                <p>Blog</p>
                <p>Contact Us</p>
                <p>Help Center</p>
                <p>Media Kit</p>
            </div>
            <div class="footer-data" data-aos="fade-left">
                <h2>Legal</h2>
                <p>Term of Policy</p>
                <p>Privacy Policy</p>
                <p>Accessiblity Policy</p>
                <p>Trademark Policy</p>
            </div>
        </div>
        <div class="copy">
            <p>&copy; All Rights Reserved</p>
            <div>Created By MyanLearn with 

                <span style="position: relative; margin-left: 36px;">
                    <div class="containerHeart">
                        <div class="preloader">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="shadowHeart"></div>
                    </div>
                </span>

            </div>
        </div>
    </footer>
    <!-- End Footer Section  -->
    <!-- Scroll To Top Button -->
    <div class="up">
        <i class='bx bx-up-arrow'></i>
    </div>

    <!-- Link JavaScript File -->
    <script src="assets/js/index.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- AOS Animation On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
         var swiper = new Swiper(".swiper-cont", {
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    slidesPerView: 1, 
    spaceBetween: 10,
    breakPoints: {
        560: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        860: {
            slidesPerView: 1,
            spaceBetween: 40,
        },
        1060: {
            slidesPerView: 2,
            spaceBetween: 50,
        },
    }
  });

  var swiper = new Swiper(".swiper-cont", {
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });

    // Header Shadow

    let header = document.querySelector(".header");
    window.addEventListener("scroll", ()=>{
        if (window.scrollY >= 70){
            header.classList.add("header-shadow")
        }
        else header.classList.remove("header-shadow")
    })

    </script>

    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
</body>
</html>

