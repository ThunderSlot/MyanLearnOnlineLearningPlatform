<?php
     include_once "instructorheader.php";  
     include_once "config.php";

     $user_id = $_SESSION['instructor_id'];

    //  echo "<script>window.alert(".$_SESSION['course_unique_id'].");</script>";


    if((!isset($_SESSION['course_unique_id'] ) || $_SESSION['course_unique_id'] == '' || $_SESSION['course_unique_id'] == null ) && (!isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] == '' || $_SESSION['editCourseid'] == null))
     {
       
        echo "<script>window.alert('Please add some course information to add curriculum.');</script>";
        echo "<script>window.location='createNewCourse.php'</script>";

     }
     else{

        if(isset($_SESSION['course_unique_id']) && $_SESSION['course_unique_id'] !== '')
        {   
            $course_unique_id = $_SESSION['course_unique_id'] ;
        }
        else if (isset($_SESSION['editCourseid']) && $_SESSION['editCourseid'] !== '')
        {
            $course_unique_id = $_SESSION['editCourseid'] ;
        }


        $SelectCourse="SELECT * FROM course
                        WHERE course_unique_id='$course_unique_id'";
        $runSelectCourse=mysqli_query($conn,$SelectCourse);
        $countrunSelectCourse=mysqli_num_rows($runSelectCourse);
        // echo "<script>window.alert(".$countrunSelectCourse.");</script>";
        $arrCourse=mysqli_fetch_array($runSelectCourse);

        if(isset($_SESSION['course_unique_id']) && $_SESSION['course_unique_id'] !== '')
        {   
            $preview_image = $arrCourse['preview_image'];
            $preview_video = $arrCourse['preview_video'];
        }
        else if (isset($_SESSION['editCourseid']) && $_SESSION['editCourseid'] !== '')
        {
            $preview_image = $arrCourse['preview_image'];
            $preview_video = $arrCourse['preview_video'];
            
        }



        $CourseID = $arrCourse['course_id']; 
        

        $sql = mysqli_query($conn, "Select * From users Where unique_id = $user_id" );

        if(mysqli_num_rows($sql) > 0) 
        {
            $row = mysqli_fetch_assoc($sql);
            

        }


        if(isset($_POST['saveNext']))
        {

            $previewVideo_name = $_FILES['previewVideoFile']['name'];
            $previewVideo_temp = $_FILES['previewVideoFile']['tmp_name'];
            $previewVideo_size = $_FILES['previewVideoFile']['size'];

            $previewImage_name = $_FILES['PreviewImage']['name'];
            $previewImage_temp = $_FILES['PreviewImage']['tmp_name'];
            $previewImage_size = $_FILES['PreviewImage']['size'];
            
        
            


            if($previewImage_name == null || $previewImage_name == '' || $previewVideo_name == null || $previewVideo_name == ''  )
            {
                echo "<script>window.alert('Please Upload Cover Image and Video.');</script>";        
                echo "<script>window.location('uploadMedia.php');</script>";        
                
            }
            else if($previewImage_name == 'assets/images/PreviewImage.jpg' || $previewVideo_name == 'assets/images/PreviewImage.jpg'  )
            {
                echo "<script>window.alert('Please Upload Cover Image and Video.');</script>";        
                echo "<script>window.location('uploadMedia.php');</script>";        
            }
            else
            {


                if($previewVideo_size > 50000000)
                {
                    
                    echo "<script>window.alert('Image size is heavy. Please reduce the size.')</script>";

                }

                else if($previewImage_size > 500000000)
                {

                    echo "<script>window.alert('Image size is heavy. Please reduce the size.')</script>";

                }
                else
                {

                    $imageFile = explode('.', $previewImage_name);
                    $imageFileEnd = end($imageFile);
        
                    $allowed_ext_img = array('jpg', 'jpeg', 'gif', 'png');


                    $videoFile = explode('.', $previewVideo_name);
                    $videoFileEnd = end($videoFile);
        
                    $allowed_ext_vdo = array('avi', 'flv', 'wmv', 'mov', 'mp4');


                        $uniqueImgPreviewName = date("Ymd").time();
                        $uniqueVdoPreviewName = date("Ymd").time();
                        
                        $locationImgPreview = 'assets/files/'.$uniqueImgPreviewName.".".$imageFileEnd;
                        $locationVdoPreview = 'assets/files/'.$uniqueVdoPreviewName.".".$videoFileEnd;
                        
                        if(move_uploaded_file($previewImage_temp, $locationImgPreview) &&  move_uploaded_file($previewVideo_temp, $locationVdoPreview))
                        {
                            
                            $uploadImagePreview = "UPDATE course
                                                    set
                                                    preview_image = '$locationImgPreview'                                             
                                                    
                                                    WHERE course_id='$CourseID'";

                            $uploadVdoPreview = "UPDATE course
                                                    set
                                                    preview_video = '$locationVdoPreview'                                             
                                                    
                                                    WHERE course_id='$CourseID'";
                                                    
                            $sqlImgPreview=mysqli_query($conn, $uploadImagePreview );
                            $sqlVdoPreview=mysqli_query($conn, $uploadVdoPreview );

                            if ($sqlImgPreview && $sqlVdoPreview) 
                            {
                                
                                if (!isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] == '' || $_SESSION['editCourseid'] == ' ' || $_SESSION['editCourseid'] == Null) 
                                {
                                    echo "<script>window.alert('Cover Photo and Video has been uploaded!')</script>";        
                                    echo "<script>window.location = 'setPrice.php'</script>";
                                    
                                }
                                else
                                {
                                    

                                    // echo "<script>window.alert('".$_SESSION['editCourseid']."')</script>";
                                    $editCourseid = $_SESSION['editCourseid'];

                                    echo "<script>window.alert('Cover Photo and Video has been uploaded!')</script>";        
                                    echo "<script>window.location = 'setPrice.php?editCourseid=".$editCourseid."'</script>";
                                }
                                
                            }
                            else
                            {
                            echo mysqli_error($conn);
                            echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";
                        
                            }

                        }
                        else
                        {
                            if (isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] !== '' || $_SESSION['editCourseid'] !== null) 
                            {
                                // echo "<script>window.alert('".$_SESSION['editCourseid']."')</script>";
                                $editCourseid = $_SESSION['editCourseid'];

                                echo "<script>alert('Wrong media format')</script>";
                                echo "<script>window.location = 'setPrice.php?editCourseid=".$editCourseid."'</script>";
                                
                            }
                            else
                            {
                                echo "<script>alert('Wrong media format')</script>";
                                echo "<script>window.location = 'setPrice.php'</script>";
                            }
                        }


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
    <title>Upload Media for Course | MyanLearn Instructor</title>

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

            /*Upload Button Style*/

    .upload-btn-wrapper {
      cursor: pointer;
      position: relative;
      overflow: hidden;
      display: inline-block;
    }

    .btnUploadMedia {
      border: 2px solid gray!important;
      color: gray!important;
      background-color: white!important;
      padding: 8px 20px!important;
      border-radius: 8px!important;
      font-size: 20px!important;
      font-weight: bold!important;
      cursor: pointer!important;
    }

    .upload-btn-wrapper input[type=file] {
   /*   width: 0;*/
      font-size: 100px;
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      cursor: pointer;
      margin: 0 0 17px;
      box-shadow: 0px 2px 3px 0px rgb(20 47 219 / 11%);
    }

    .upload-btn-wrapper input[type=file]:active {
       
       color: black;
       transform: scale(0.95);
    }

    .thumb-dt {
        padding: 20px 20px 17px;
    }

    .thumb-item {
        width: 100%;
        border: 1px solid #efefef;
        text-align: center;
        border-radius: 3px;
        margin-bottom: 30px;
        background: #fff;
    }
    .thumb-item img{
        max-width: 100%;
    }

    

    .previewVideoBtn {
    width: 350px;
    max-width: 100%;
    color: #444;
    padding: 5px;
    background: #fff;
    border-radius: 10px;
    border: 1px solid #555;
    }

    .previewVideoBtn::file-selector-button {
    margin-right: 20px;
    border: none;
    background: #084cdf;
    padding: 10px 20px;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    transition: background .2s ease-in-out;
    }

    .previewVideoBtn::file-selector-button:hover {
    background: #0d45a5;
    }

    @media (max-width: 999px) {
        .thumb-item {
            flex-direction: column;
        }
        .mediaContainer{
            display: flex; align-items: center; justify-content: center;
        }
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
                <div class="progress" id="progress" style="width:66.666%;"></div>
                
                <div class="progress-step progress-step-active" data-title="Intro"></div>
                <div class="progress-step progress-step-active" data-title="Curriculum"></div>
                <div class="progress-step progress-step-active" data-title="Media"></div>
                <div class="progress-step" data-title="Price"></div>
            </div>

           
            <div class="form-step form-step-active">               

                <div class="tab-info">
                    <h3 class="tab-title">Upload Cover Photo and Video</h3>
                </div>

                    
                <div class="form-fillup">
                    
                    <div class="col-md-12">

                            
                        <form action="uploadMedia.php" method="post" enctype="multipart/form-data" >
                        
                        
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="row mt-30">
                                            <div class="col-lg-12 col-md-12">

                                                <label><b>Promotional Video </b><span class="primaryColor">*</span></label>

                                                <div class="thumb-item d-flex">

                                                    <div class="col-lg-5 col-md-6 ">

                                                        <div class="mediaContainer">
                                                            <?php
                                                                if((isset($_SESSION['course_unique_id']) && $_SESSION['course_unique_id'] !== '') ||  (isset($_SESSION['editCourseid']) && $_SESSION['editCourseid'] !== ''))
                                                                {   
                                                                    
                                                                    if($preview_video !== null && !empty($preview_video) && $preview_video !== '')
                                                                    {

                                                                        echo "<video width='100%' src='".$preview_video."' controls class='previewVideoPlayer previewVideo'></video>";
                                                                        
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "<img src='assets/images/PreviewImage.jpg' alt='Thumbnail Default' class='previewVideo'>";
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "<img src='assets/images/PreviewImage.jpg' alt='Thumbnail Default' class='previewVideo'>";
                                                                }
                                                            ?>
                                                            

                                                            <video width='100%' controls  class="previewVideoPlayer" style="display: none;">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                            
                                                        </div>




                                                    </div>

                                                    <div class="thumb-dt">

                                                        <div class="p-3 text-muted normalFontSize">Your promo video is a quick and compelling way for students to preview what they’ll learn in your course. Students considering your course are more likely to enroll if your promo video is well-made</div>

                                                        <input type="file" class="previewVideoBtn" id="previewVideoBtn" name="previewVideoFile" required>

                                                        
                                                        <script>
                                                            document.querySelector(".previewVideoBtn").onchange = function(event) 
                                                            {
                                                                var fileInputVdo = document.getElementById('previewVideoBtn');
                                                                var filePathVdo = fileInputVdo.value;

                                                                // Allowing file type
                                                                var allowedExtensionsVdo = /(\.avi|\.flv|\.wmv|\.mov|\.mp4)$/i;
                                                                
                                                                if (!allowedExtensionsVdo.exec(filePathVdo)) {
                                                                    alert('Invalid file type');
                                                                    fileInputVdo.value = '';
                                                                    return false;
                                                                }
                                                                else
                                                                {
                                                                    let file = event.target.files[0];
                                                                    let blobURL = URL.createObjectURL(file);
                                                                    document.querySelector("video").src = blobURL;

                                                                    document.querySelector(".previewVideo").style.display = "none";
                                                                    document.querySelector(".previewVideoPlayer").style.display = "block";
                                                                }

                                                                
                                                            }
                                                        </script>

                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="row mt-30">
                                            <div class="col-lg-12 col-md-12">

                                                <label><b>Course Image </b><span class="primaryColor">*</span></label>

                                                <div class="thumb-item d-flex">

                                                    <div class="col-lg-5 col-md-6 ">
                                                        <div class="mediaContainer">
                                                            <?php
                                                                if((isset($_SESSION['course_unique_id']) && $_SESSION['course_unique_id'] !== '') ||  (isset($_SESSION['editCourseid']) && $_SESSION['editCourseid'] !== ''))
                                                                {   
                                                                    
                                                                    if($preview_image !== null && !empty($preview_image) && $preview_image !== '')
                                                                    {

                                                                        echo "<img src='".$preview_image."' alt='Thumbnail Default' id='preview'>";
                                                                        
                                                                    }
                                                                    else
                                                                    {
                                                                        echo "<img src='assets/images/PreviewImage.jpg' alt='Thumbnail Default' id='preview'>";

                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "<img src='assets/images/PreviewImage.jpg' alt='Thumbnail Default' id='preview'>";
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="thumb-dt">

                                                        <div class="p-3 text-muted normalFontSize">For Course Image Cover, Upload here. It must meet our course image quality standards to be accepted. Important guidelines: .jpg, .jpeg,. gif, or .png. no text on the image.</div>


                                                        <div class="upload-btn-wrapper">
                                                            <button class="btnUploadMedia" type="button">Upload a file</button>
                                                            <input type="file" name="PreviewImage" id="PreviewImage" onchange="previewImage();" required="">
                                                        </div>

                                                        

                                                        <!-- Preview image function -->

                                                        <script type="text/javascript">
                                                            function previewImage() {
                                                                var file = document.getElementById("PreviewImage").files;
                                                                
                                                                if (file.length > 0 ) {

                                                                    var fileReader = new FileReader();

                                                                    fileReader.onload = function (event) {

                                                                        var fileInputImg = document.getElementById('PreviewImage');
                                                                        var filePathImg = fileInputImg.value;
		
                                                                        // Allowing file type
                                                                        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                                                                        
                                                                        if (!allowedExtensions.exec(filePathImg)) {
                                                                            alert('Invalid file type');
                                                                            fileInputImg.value = '';
                                                                            return false;
                                                                        }
                                                                        else
                                                                        {
                                                                            document.getElementById("preview").setAttribute("src",event.target.result);
                                                                        }

                                                                    };

                                                                    fileReader.readAsDataURL(file[0]);

                                                                }
                                                                else
                                                                {
                                                                    window.alert('Image file size is zero. Please choose another image file!');
                                                                }
                                                            }                                                  
                                                        </script>

                                                    </div>
                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            


                            


                            <div class="btns-group"> 
                                <input type="submit" value="Save and Next" class="btn" name="saveNext">
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

  

</body>
</html>
