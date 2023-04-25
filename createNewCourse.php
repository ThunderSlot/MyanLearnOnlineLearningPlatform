<?php
     include_once "instructorheader.php";  
     include_once "config.php";

     $user_id = $_SESSION['instructor_id'];

     $sql = mysqli_query($conn, "Select * From users Where unique_id = $user_id" );
     
    if(mysqli_num_rows($sql) > 0) 
    {
        $row = mysqli_fetch_assoc($sql);
    }

    // echo "<script>window.alert(".$_SESSION['course_unique_id'].");</script>";


    $courseTitleUpdate = '';
    $courseSubTitleUpdate = '';
    $courseDescriptionUpdate = '';
    $courseRequirementUpdate = '';
    $courseTeachingOutcomeUpdate = '';
    $courseLanguageUpdate = '';
    $courseLevelUpdate = '';
    $courseCategoryUpdate = '';
    $courseSubCategoryUpdate = '';
    $image = $row['image'];

    $editCourseid = '';
    
    if (isset($_GET['editCourseid']) && $_GET['editCourseid'] !== '') {

        //update the value of edit course
        $editCourseid = $_GET['editCourseid'];
        $_SESSION['editCourseid'] = $_GET['editCourseid'];

        // echo "<script>window.alert('GEt');</script>";


        $checkCreateNewCoursesql = mysqli_query($conn, "Select * from course where course_unique_id = '$editCourseid'");
        
        if(mysqli_num_rows($checkCreateNewCoursesql) > 0) 
        {
            $courseRow = mysqli_fetch_assoc($checkCreateNewCoursesql);
        }

        $courseTitleUpdate = $courseRow['course_title'];
        $courseSubTitleUpdate = $courseRow['course_subtitle'];
        $courseDescriptionUpdate = $courseRow['course_description'];
        $courseRequirementUpdate = $courseRow['course_requirement'];
        $courseTeachingOutcomeUpdate = $courseRow['course_teaching_outcome'];
        $courseLanguageUpdate = $courseRow['course_langugae'];
        $courseLevelUpdate = $courseRow['course_level'];
        $courseCategoryUpdate = $courseRow['course_category'];
        $courseSubCategoryUpdate = $courseRow['course_subcategory'];

           
    }
    else if (!isset($_SESSION['course_unique_id']) || $_SESSION['course_unique_id'] === '' || $_SESSION['course_unique_id'] === null) 
    {
        //original insertion so do nothing in here
        // echo "<script>window.alert('no session');</script>";

    }
    else //to update the course 
    {
        $courseSession = $_SESSION['course_unique_id'];
        $editCourseid  = $_SESSION['course_unique_id'];
        
        // echo "<script>window.alert('CoruseSession');</script>";
        
        $checkCreateNewCoursesql = mysqli_query($conn, "Select * from course where course_unique_id = '$courseSession'");
        
        if(mysqli_num_rows($checkCreateNewCoursesql) > 0) 
        {
            $courseRow = mysqli_fetch_assoc($checkCreateNewCoursesql);
        }

        $courseTitleUpdate = $courseRow['course_title'];
        $courseSubTitleUpdate = $courseRow['course_subtitle'];
        $courseDescriptionUpdate = $courseRow['course_description'];
        $courseRequirementUpdate = $courseRow['course_requirement'];
        $courseTeachingOutcomeUpdate = $courseRow['course_teaching_outcome'];
        $courseLanguageUpdate = $courseRow['course_langugae'];
        $courseLevelUpdate = $courseRow['course_level'];
        $courseCategoryUpdate = $courseRow['course_category'];
        $courseSubCategoryUpdate = $courseRow['course_subcategory'];


    }   
    

    

    // Adding data info into database
    if(isset($_POST['btnsubmit']))
    {

        if((!isset($_SESSION['course_unique_id'] ) || $_SESSION['course_unique_id'] == '' || $_SESSION['course_unique_id'] == null) && (!isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] == '' || $_SESSION['editCourseid'] == null))
        {
            //insert the course

            $courseTitle = $_POST['courseTitle'];        
            $courseSubtitle = $_POST['courseSubtitle'];        
            $description = $_POST['description'];        
            $whatwillyoulearn = $_POST['whatwillyoulearn'];        
            $courseRequirement = $_POST['courseRequirement'];        
            $courseLanguage = $_POST['courseLanguage'];        
            $courseLevel = $_POST['courseLevel'];        
            $courseCategory = $_POST['courseCategory'];        
            $courseSubCategory = $_POST['courseSubCategory'];        
            $status = "notPublished";
    
            date_default_timezone_set('Asia/Yangon');
            $createDate=date('Y-m-d h:i:s');

            $courseUniqueId = uniqid('courseID');

            // echo "<script>window.alert(".$courseUniqueId.");</script>";
            
    
            if ($courseTitle == null || $courseTitle == '' || $courseSubtitle == null || $courseSubtitle == '' || $description == null || $description =='' || $whatwillyoulearn == null || $whatwillyoulearn == '' || $courseRequirement == null || $courseRequirement == '' || $courseLanguage == null || $courseLanguage =='' || $courseLevel == null || $courseLevel =='' || $courseCategory == null || $courseCategory == '' || $courseSubCategory == null || $courseSubCategory == '' || $status == null || $status == '') {
                echo "<script>window.alert('All required text boxes marked with * have to be filled!');</script>";
                echo "<script>window.location='createNewCourse.php';</script>";
            }
            else
            {
                $InsertCourse = "Insert into course
                                (course_title, course_unique_id, course_subtitle, course_description, course_requirement, course_langugae, course_level, course_category, course_subcategory, course_teaching_outcome, course_date, course_latest_date, course_status, instructor_id)
                                Values
                                ('$courseTitle', '$courseUniqueId', '$courseSubtitle', '$description', '$courseRequirement', '$courseLanguage', ' $courseLevel', '$courseCategory', '$courseSubCategory', '$whatwillyoulearn', '$createDate', '$createDate', '$status', '$user_id')";
                $InsertCourseSql = mysqli_query($conn, $InsertCourse);
    
                if($InsertCourseSql)
                {   
                    echo "<script>window.alert('Course Landing Information has been stored.')</script>";
                    

                    $_SESSION['course_unique_id'] = $courseUniqueId;
                    echo "<script>window.location='createCurriculum.php'</script>"; 
                }
                else
                {
                    echo mysqli_error($conn);
                    echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";
    
                }
            }


        }
        else
        {
            //update the course
            // echo "<script>alert('To Update Course');</script>";
            
            $courseTitle = $_POST['courseTitle'];        
            $courseSubtitle = $_POST['courseSubtitle'];        
            $description = $_POST['description'];        
            $whatwillyoulearn = $_POST['whatwillyoulearn'];        
            $courseRequirement = $_POST['courseRequirement'];        
            $courseLanguage = $_POST['courseLanguage'];        
            $courseLevel = $_POST['courseLevel'];        
            $courseCategory = $_POST['courseCategory'];        
            $courseSubCategory = $_POST['courseSubCategory'];  
            
            date_default_timezone_set('Asia/Yangon');
            $updateDate=date('Y-m-d h:i:s');

            if ($courseTitle == null || $courseTitle == '' || $courseSubtitle == null || $courseSubtitle == '' || $description == null || $description =='' || $whatwillyoulearn == null || $whatwillyoulearn == '' || $courseRequirement == null || $courseRequirement == '' || $courseLanguage == null || $courseLanguage =='' || $courseLevel == null || $courseLevel =='' || $courseCategory == null || $courseCategory == '' || $courseSubCategory == null || $courseSubCategory == '' ) {
                echo "<script>window.alert('All required text boxes marked with * have to be filled!');</script>";
                echo "<script>window.location='createNewCourse.php';</script>";
            }
            else
            {
                $updateCourse = "UPDATE course
                                set
                                course_title = '$courseTitle',
                                course_subtitle = '$courseSubtitle',                                
                                course_description = '$description' ,                               
                                course_requirement = '$courseRequirement',                                
                                course_langugae = '$courseLanguage',                         
                                course_level = '$courseLevel',                         
                                course_category = '$courseCategory',                         
                                course_subcategory = '$courseSubCategory',                         
                                course_teaching_outcome = '$whatwillyoulearn',  
                                course_latest_date = '$updateDate'                
                                WHERE course_unique_id='$editCourseid'";

                $updateCorusesql = mysqli_query($conn, $updateCourse);
    
                if($updateCorusesql)
                {   
                    echo "<script>window.alert('Course Landing Information has been stored.')</script>";

                    
                    if (isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] !== '' || $_SESSION['editCourseid'] !== null) 
                    {
                        // echo "<script>window.alert('".$_SESSION['editCourseid']."')</script>";
                        $editCourseid = $_SESSION['editCourseid'];

                        echo "<script>window.location='createCurriculum.php?editCourseid=".$editCourseid."'</script>";


                    }
                    else
                    {
                        // echo "<script>window.alert('nothing')</script>";

                        echo "<script>window.location='createCurriculum.php'</script>"; 
                    }

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
    <title>Curriculum Form | MyanLearn Instructor</title>

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
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">



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
                <div class="progress" id="progress"></div>
                
                <div class="progress-step progress-step-active" data-title="Intro"></div>
                <div class="progress-step" data-title="Curriculum"></div>
                <div class="progress-step" data-title="Media"></div>
                <div class="progress-step" data-title="Price"></div>


            </div>

        <form action="createNewCourse.php" method="post" enctype="multipart/form-data" class="form">

            <!-- Steps -->
            <div class="form-step form-step-active">

                <div class="tab-info">
                    <h3 class="tab-title">Course Landing Page</h3>
                </div>

                <div class="form-fillup">
                    <div class="input-group">
                        <label for="coursetitle">Course Title <span class="primaryColor">*</span></label>
                        <input type="text" maxlength="50" data-word-count="50;CourseTitle" name="courseTitle" id="courseTitle" placeholder="Insert your course title" onkeyup="count_down(this)" value="<?php echo $courseTitleUpdate; ?>"  />
                        <div class="badge_num" id="CourseTitle">50</div>
                        
                    </div>
                    <div class="input-group">
                        <label for="coursetitle">Course Subtitle <span class="primaryColor">*</span></label>
                        <input type="text" maxlength="50" data-word-count="120;CourseSubtitle" onkeyup="count_down(this)" name="courseSubtitle" id="courseSubtitle" placeholder="Insert your course sub-title" value="<?php echo $courseSubTitleUpdate; ?>"  />
                        <div class="badge_num" id="CourseSubtitle">120</div>
                    </div>
                    <div class="input-group input-textarea">
                        <label for="coursetitle">Course Description <span class="primaryColor">*</span></label>
                        <div class="course_des_bg">
                            <ul class="course_des_ttle">
                                <li><a href="#" class="word_edit"><i class="fas fa-bold fa-xs"></i></a></li>
                                <li><a href="#" class="word_edit"><i class="fas fa-italic fa-xs"></i></a></li>
                                <li><a href="#" class="word_edit"><i class="fas fa-underline fa-xs"></i></a></li>
                                <li><a href="#" class="word_edit"><i class="fas fa-list fa-xs"></i></a></li>                                
                            </ul>
                            <div class="textarea_dt">
                                <div class="ui form swdh339">
                                    <div class="field">
                                        <textarea rows="5" name="description" id="id_course_description" placeholder="Insert your course description" ><?php echo $courseDescriptionUpdate; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 rowInput" style="dispaly: flex; flex-direction: row;">
                    
                        <div class="col-lg-6 col-md-12 firstInput" style="padding-right: 20px;">
                            <div class="ui search focus lbel25 mt-30">
                                    <label>What will students learn in your course? <span class="primaryColor">*</span></label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="whatwillyoulearn" id="" placeholder="Learning Objectives for the course." ><?php echo $courseTeachingOutcomeUpdate; ?></textarea>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-12 secondInput">
                            <div class="ui search focus lbel25 mt-30">
                                    <label>What are course requirements? <span class="primaryColor">*</span></label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="courseRequirement" id="" placeholder="Requirements or prerequisites for taking your course" ><?php echo $courseRequirementUpdate; ?></textarea>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <div class="container rowInput">
                                <div class="col-lg-4 col-md-12 px-3 mb-4 w-100-1024">
                                    <label>Course Lanuguage <span class="primaryColor">*</span></label>

                                    <select class="selectBox" name="courseLanguage" >
                                        <option value="">Select Language Used</option>
                                        <option value="English" <?php if($courseLanguageUpdate == "English") {echo "selected";} ?>>English</option>
                                        <option value="Español" <?php if($courseLanguageUpdate == "Español") {echo "selected";} ?>>Español</option>
                                        <option value="Português" <?php if($courseLanguageUpdate == "Português") {echo "selected";} ?>>Português</option>
                                        <option value="日本語" <?php if($courseLanguageUpdate == "日本語") {echo "selected";} ?>>日本語</option>
                                        <option value="Deutsch" <?php if($courseLanguageUpdate == "Deutsch") {echo "selected";} ?>>Deutsch</option>
                                        <option value="Français" <?php if($courseLanguageUpdate == "Français") {echo "selected";} ?>>Français</option>
                                        <option value="Türkçe" <?php if($courseLanguageUpdate == "Türkçe") {echo "selected";} ?>>Türkçe</option>
                                        <option value="Italiano" <?php if($courseLanguageUpdate == "Italiano") {echo "selected";} ?>>Italiano</option>
                                        <option value="हिन्दी" <?php if($courseLanguageUpdate == "हिन्दी") {echo "selected";} ?>>हिन्दी</option>
                                        <option value="Polski" <?php if($courseLanguageUpdate == "Polski") {echo "selected";} ?>>Polski</option>
                                        <option value="Tamil" <?php if($courseLanguageUpdate == "Tamil") {echo "selected";} ?>>Tamil</option>
                                        <option value="मराठी" <?php if($courseLanguageUpdate == "मराठी") {echo "selected";} ?>>मराठी</option>
                                        <option value="Telugu" <?php if($courseLanguageUpdate == "Telugu") {echo "selected";} ?>>Telugu</option>
                                        <option value="Română" <?php if($courseLanguageUpdate == "Română") {echo "selected";} ?>>Română</option>
                                    </select>

                                </div>
                                
                                <div class="col-lg-4 col-md-12 px-3 mb-4 w-100-1024">
                                    <label>Course Level <span class="primaryColor">*</span></label>

                                    <select class="selectBox" name="courseLevel" >
                                        <option value="">Select Level</option>
                                        <option value="Beginner" <?php if($courseLevelUpdate == " Beginner") {echo "selected";} ?>>Beginner</option>
                                        <option value="Intermediate" <?php if($courseLevelUpdate == " Intermediate") {echo "selected";} ?> >Intermediate</option>
                                        <option value="Expert" <?php if($courseLevelUpdate == " Expert") {echo "selected";} ?> >Expert</option>
                                    </select>

                                </div>
                                
                                <div class="col-lg-4 col-md-12 px-3 mb-4 w-100-1024">

                                    <div class="row flex-column">
                                        <div class="card-body">
                                            <div class="form-group mb-4">
                                                <label>Course Category <span class="primaryColor">*</span></label>
                                                <select class="form-control" id="category-dropdown" name="courseCategory" >
                                                    <option value="">Select Category</option>
                                                    <?php
                                                    $result = mysqli_query($conn, "SELECT * FROM category");
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        ?>
                                                        <option value="<?php echo $row['category_id']; ?>"  <?php if($courseCategoryUpdate == $row['category_id'] ) {echo "selected";} ?> ><?php echo $row["category_name"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group mb-4">
                                            <label>Course SubCategory <span class="primaryColor">*</span></label>
                                                <input type="hidden" id="courseCategoryUpdate" value="<?php echo $courseCategoryUpdate ?>">
                                                <input type="hidden" id="courseSubCategoryUpdate" value="<?php echo $courseSubCategoryUpdate ?>">

                                                <select class="form-control" id="sub-category-dropdown" name="courseSubCategory" >
                                                    <option value="">Select Sub Category</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 px-3 mb-4">
                         <label><b>Instructor Profile</b><span style="color: blue; font-size: 20px;"><i class='bx bxs-badge-check'></i></span></label>
                        <div class="row">
                            <div class="margin-left1">
                                <img src="<?php echo $image?>" alt="" class="rounded-circle profileImage ">
                                <?php
                                      $sql = mysqli_query($conn, "Select * From users Where unique_id = $user_id" );
                                      if(mysqli_num_rows($sql) > 0) 
                                      {
                                          $row = mysqli_fetch_assoc($sql);
                                      }
                                      
                                ?>
                                <a href="profile.php" class="margin-right1 "><strong><?php echo $row['fullName'] ?></strong></a>
                            </div>
                            
                               
                            
                        </div>
                    </div>
                   


                    <div class="">
                        <!-- <a href="#" class="btn btn-next width-50 ml-auto">Next</a>
                        <a href="#" class="btn btn-next width-50 ml-auto">Next</a> -->
                        <input type="Submit" name="btnsubmit" class="btn btn-next width-50 ml-auto" value="Next">
                    </div>
                </div>
            </div>
        
        </form>
        

           
        </div>

        

    </main><!-- End #main -->

</section>

<!-- <script src="assets/js/instructordashboard.js"></script> -->
<!-- <script src="assets/js/createNewCourse.js"></script> -->


<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"  crossorigin="anonymous"></script>
<!-- Need jquery for subcategory dependent on category -->
<script>  
    $(document).ready(function() {
        $('#category-dropdown').on('change', function() {
            var category_id = this.value;
            $.ajax({
                url: "get-subcat.php",
                type: "POST",
                data: {
                    category_id: category_id
                },
                cache: false,
                success: function(result) {
                    $("#sub-category-dropdown").html(result);
                }
            });
        });
    });

    $(document).ready(function() {
        var Category_id_update = $('#courseCategoryUpdate').val();
        var subCategory_id_update = $('#courseSubCategoryUpdate').val();

        if (subCategory_id_update != null && subCategory_id_update != '') {
            $.ajax({
                url: "get-subcat.php",
                type: "POST",
                data: {
                    category_id: Category_id_update,
                    subCategory_id_update: subCategory_id_update
                },
                cache: false,
                success: function(result) {
                    $("#sub-category-dropdown").html(result);
                }
            });
        }
    });

    

    function count_down(obj){
        const data_length = obj.getAttribute('data-word-count').split(";")[0];
        const CourseTitle = document.getElementById(obj.getAttribute('data-word-count').split(";")[1]);
        // alert(CourseTitle);


        CourseTitle.innerHTML = data_length - obj.value.length;
        // window.alert("dfad");

        if (data_length - obj.value.length < 5) {
            CourseTitle.style.color = 'red';
        }
        else
        {
            CourseTitle.style.color = 'white';
        }
    }


    // function count_down(obj){
    //         const data_length = obj.getAttribute('data-word-count');
    //         var data-badge-num = obj.getAttribute("data-badge-num");
    //         const CourseTitle = document.getElementById(data-badge-num);

    //         window.alert("dfad");


    //         CourseTitle.innerHTML = data_length - obj.value.length;

    //         // if (data_length - obj.value.length < 5) {
    //         //     CourseTitle.style.color = 'red';
    //         // }
    //         // else
    //         // {
    //         //     CourseTitle.style.color = 'white';
    //         // }
    //     }

</script>



<script>
const modeSwitch = document.getElementById('modeSwitch');
const toggle = document.querySelector('.toggle');
const sidebar = document.querySelector('.sidebar');
const modeText = document.querySelector('.mode-text');

modeSwitch.addEventListener("click", ()=>{
    document.body.classList.toggle("dark");

    if(document.body.classList.contains("dark"))
    {
        modeText.innerText = "Light Mode"   
    }
    else {modeText.innerText = "Dark Mode" }

});

toggle.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
    document.querySelector('.logoMobile2').classList.toggle('hide');
    document.querySelector('.logoDefault').classList.toggle('hide');
});



</script>

<script>
        const modeSwitch = document.getElementById('modeSwitch');
        const toggle = document.querySelector('.toggle');
        const sidebar = document.querySelector('.sidebar');
        const modeText = document.querySelector('.mode-text');

        modeSwitch.addEventListener("click", ()=>{
            document.body.classList.toggle("dark");

            if(document.body.classList.contains("dark"))
            {
                modeText.innerText = "Light Mode"   
            }
            else {modeText.innerText = "Dark Mode" }

        });

        toggle.addEventListener("click", ()=>{
            sidebar.classList.toggle("close");
            document.querySelector('.logoMobile2').classList.toggle('hide');
            document.querySelector('.logoDefault').classList.toggle('hide');
        });



    </script>


</body>
</html>