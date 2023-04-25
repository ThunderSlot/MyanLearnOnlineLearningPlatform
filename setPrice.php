<?php
     include_once "instructorheader.php";  
     include_once "config.php";

     $user_id = $_SESSION['instructor_id'];

    //  echo "<script>window.alert(".$_SESSION['course_unique_id'].");</script>";


    if((!isset($_SESSION['course_unique_id'] ) || $_SESSION['course_unique_id'] == '' || $_SESSION['course_unique_id'] == null ) && (!isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] == '' || $_SESSION['editCourseid'] == null))

     {
       
        echo "<script>alert('Please add some course information to add curriculum.');</script>";
        echo "<script>window.location='createNewCourse.php'</script>";

     }
     
     else {

        
        if(isset($_SESSION['course_unique_id']) && $_SESSION['course_unique_id'] !== '')
        {   
            $course_unique_id = $_SESSION['course_unique_id'] ;
        }
        else if (isset($_SESSION['editCourseid']) && $_SESSION['editCourseid'] !== '')
        {
            $course_unique_id = $_SESSION['editCourseid'] ;
        }

        $coursePrice = null; 


        $SelectCourse="SELECT * FROM course
                        WHERE course_unique_id='$course_unique_id'";
        $runSelectCourse=mysqli_query($conn,$SelectCourse);
        $countrunSelectCourse=mysqli_num_rows($runSelectCourse);

        $arrCourse=mysqli_fetch_array($runSelectCourse);

        $CourseID = $arrCourse['course_id']; 
        $coursePrice = $arrCourse['course_price']; 
        

        $sql = mysqli_query($conn, "Select * From users Where unique_id = $user_id" );

        if(mysqli_num_rows($sql) > 0) 
        {
            $row = mysqli_fetch_assoc($sql);
        }

        if(isset($_POST['Publish']))
        {

            $course_price = $_POST['course_price'];               
                
            $SelectCourseVdo="SELECT *, SUM(runTime) AS total_duration FROM  coursevideo
                        WHERE course_id='$CourseID'";
            $runSelectCourseVdo=mysqli_query($conn,$SelectCourseVdo);
            $countSelectCourseVdo=mysqli_num_rows($runSelectCourseVdo);

            $rowCourseVdo=mysqli_fetch_array($runSelectCourseVdo);
            $totalRunTime = $rowCourseVdo['total_duration']; 

            if($course_price == 'Select a price' )
            {
                echo "<script>window.alert('Please Select one of the price.');</script>";        
                echo "<script>window.location.href = 'setPrice.php?editCourseid=".$_SESSION['editCourseid']."';</script>";

                
            }
            // else if($countSelectCourseVdo <5)
            // {
            //     echo "<script>window.alert('The course to be published should contain at least 5 videos');</script>";        
            //     echo "<script>window.alert(".$countSelectCourseVdo.");</script>";        
            //     echo "<script>window.location('setPrice.php');</script>";
            // }
            else if($totalRunTime <199)
            {
                // echo "<script>window.alert('".$totalRunTime."');</script>";        
                echo "<script>window.alert('The course to be published should contain at least 200min');</script>";        
                echo "<script>window.location.href = 'setPrice.php?editCourseid=".$_SESSION['editCourseid']."';</script>";

                
            }
            else{
                $status = 'published';
                
                $uploadPrice = "UPDATE course
                                set
                                course_price = '$course_price',
                                course_status = '$status'                                
                                WHERE course_id='$CourseID'";
                                                        
                $sqluploadPrice = mysqli_query($conn, $uploadPrice );

                if ($sqluploadPrice) 
                {
                    echo "<script>window.alert('Course Have been uploaded!')</script>";        
                    echo "<script>window.location = 'CourseList.php'</script>";
                    
                }
                else
                {
                    echo mysqli_error($conn);
                    echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";
            
                }
        
            }
        
        
 
		
	    }

  
    
    } 

    
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Price for Course | MyanLearn Instructor</title>

    <!-- Main Css File -->
    <link rel="stylesheet" href="assets/css/instructordashboard.css">
    <link rel="stylesheet" href="assets/css/createNewCourse.css">
    <link rel="stylesheet" href="assets/css/variable.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/variable.css">

     <!-- For icon tab -->
     <link rel="icon" href="assets/images/logomobile.png">

     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="assets/vendor/Fontawesome-free/css/all.min.css">

    <!-- Vendor -->
    <link href="assets\vendor\bootstrap\css\bootstrap.css" rel="stylesheet">
    <link href="assets\vendor\bootstrap\css\bootstrap-grid.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

   


    <style>
        .visible{
            display: block;
        }

        .usd-box {
        display: inline-block;
        background-color: #f7f7f7;
        padding: 10px;
        border-radius: 20%;
        }

        .usd-text {
        font-size: 24px;
        font-weight: bold;
        color: #000000;
        }

        .custom-select {
        position: relative;
        display: inline-block;
        width: 200px;
        height: 40px;
        background-color: #f7f7f7;
        border-radius: 5px;
        overflow: hidden;
        }

        .custom-select select {
        width: 100%;
        height: 100%;
        background-color: transparent;
        border: none;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #555;
        }

        .custom-select:after {
        content: "\25BE";
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        font-size: 20px;
        color: #555;
        pointer-events: none;
        transition: all 0.2s ease-in-out;
        }

        .custom-select.open:after {
        content: "\25B4";
        }


    </style>

</head>
<body>



<section class="home">
    <div class="text"></div>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1><i class="fa-solid fa-folder-plus" style="margin-right: 5px;"></i>Curriculum</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="instructordashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Create Curriculum</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="formSteps">
            <!-- Progress bar -->
            <div class="progressbar">
                <div class="progress" id="progress" style="width:100%;"></div>
                
                <div class="progress-step progress-step-active" data-title="Intro"></div>
                <div class="progress-step progress-step-active" data-title="Curriculum"></div>
                <div class="progress-step progress-step-active" data-title="Media"></div>
                <div class="progress-step progress-step-active" data-title="Price"></div>
            </div>

           
            <div class="form-step form-step-active">               

                <div class="tab-info">
                    <h3 class="tab-title">Set Price For the course</h3>
                </div>

                    
                <div class="form-fillup">
                    
                    <div class="col-md-12">

                            
                        <form action="setPrice.php" method="post" enctype="multipart/form-data" >
                        
                        
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="row mt-30">
                                            <div class="col-lg-12 col-md-12">

                                                <label><b>Course Price Tiers </b><span class="primaryColor">*</span></label>
                                                <br>
                                                <p>Select one of the price tier to make price of the course.</p>
                                                <p>To make published the course online, the total duration of the course video must be <span class="primaryColor"><b>over 120 mins.</b></span></p>

                                                <div class="container mt-5">
                                                    <div class="row">
                                                        <div class="col-md-12 my-3">
                                                            <div class="d-flex">
                                                                <label for="my-select">Select an option:</label>
                                                                <div class="custom-select" style="max-width: 40%; margin: 0px 20px 0px 20px;">
                                                                    <select name="course_price"> 
                                                                        <option value="Select a price">Select a price</option>
                                                                        <option value="Free">Free</option>
                                                                        <option value="$19.99" <?php if($coursePrice == "$19.99") {echo "selected";} ?> >$19.99(tier1)</option>
                                                                        <option value="$24.99" <?php if($coursePrice == "$24.99") {echo "selected";} ?> >$24.99(tier2)</option>
                                                                        <option value="$29.99" <?php if($coursePrice == "$29.99") {echo "selected";} ?> >$29.99(tier3)</option>
                                                                        <option value="$34.99" <?php if($coursePrice == "$34.99") {echo "selected";} ?> >$34.99(tier4)</option>
                                                                        <option value="$39.99" <?php if($coursePrice == "$39.99") {echo "selected";} ?> >$39.99(tier5)</option>
                                                                        <option value="$44.99" <?php if($coursePrice == "$44.99") {echo "selected";} ?> >$44.99(tier6)</option>
                                                                        <option value="$49.99" <?php if($coursePrice == "$49.99") {echo "selected";} ?> >$49.99(tier7)</option>
                                                                        <option value="$54.99" <?php if($coursePrice == "$54.99") {echo "selected";} ?> >$54.99(tier8)</option>
                                                                        <option value="$59.99" <?php if($coursePrice == "$59.99") {echo "selected";} ?> >$59.99(tier9)</option>
                                                                        <option value="$64.99" <?php if($coursePrice == "$64.99") {echo "selected";} ?> >$64.99(tier10)</option>
                                                                    </select>
                                                                </div>
                                                                
                                                                
                                                                <div class="usd-box">
                                                                    <span class="usd-text primaryColor">USD</span>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                           
                            


                            


                            <div class="btns-group"> 
                                <input type="submit" value="Save and Published" class="btn" name="Publish">
                            </div>

                        </form>

                        
                    </div>


                </div>

                
            </div>
           
        

           
        </div>

        

    </main><!-- End #main -->

</section>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"  crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"  crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <script>
        var selectBox = document.querySelector('.custom-select select');
        var selectList = document.querySelector('.custom-select ul');

        selectBox.addEventListener('click', function() {
        selectBox.parentElement.classList.toggle('open');
        });

        selectList.addEventListener('click', function(e) {
        if (e.target.tagName === 'LI') {
            selectBox.value = e.target.textContent;
            selectBox.parentElement.classList.remove('open');
        }
        });

    </script>
  

</body>
</html>
