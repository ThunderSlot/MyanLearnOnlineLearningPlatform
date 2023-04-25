<?php
     include_once "instructorheader.php";
     include_once "config.php";

     $user_id = $_SESSION['instructor_id'];

     if(!isset($_SESSION['instructor_id'] ) || $_SESSION['instructor_id'] == '' || $_SESSION['instructor_id'] == null )
     {
        echo "<script>window.alert('User Session Expired. Please Log in again!');</script>";
        echo "<script>window.location='login.php'</script>";
     }


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
    $CourseID = $arrCourse['course_id'];


    $sql = mysqli_query($conn, "Select * From users Where unique_id = $user_id" );
    if(mysqli_num_rows($sql) > 0)
    {
        $row = mysqli_fetch_assoc($sql);
    }



    if(isset($_POST['uploadVideo']))
    {

        $videoNameUpload = $_POST['videoNameUpload'];
        $video_duration = $_POST['videoDuration'];

		$file_name = $_FILES['video']['name'];
		$file_temp = $_FILES['video']['tmp_name'];
		$file_size = $_FILES['video']['size'];


        date_default_timezone_set('Asia/Yangon');
        $RegDate=date('Y-m-d h:i:s');

        // echo "<script>window.alert(".$file_name.");</script>";
        // echo "<script>window.alert(".$file_size.");</script>";

        $videoType = "UploadedVideo";



        if($file_name == null || $file_name == '' || $file_size == null || $file_size == '' || $videoNameUpload == null || $videoNameUpload == '' || $video_duration == null || $video_duration == ''  )
        {
            echo "<script>window.alert('Please fill all the information with *.');</script>";
            echo "<script>window.location('createCurriculum.php');</script>";

        }
        else
        {

            if($file_size < 9999999999){
                $file = explode('.', $file_name);
                $end = end($file);


                $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
                if(in_array($end, $allowed_ext)){

                    $uniqueVideoName = date("Ymd").time();
                    $location = 'assets/files/'.$uniqueVideoName.".".$end;

                    if(move_uploaded_file($file_temp, $location))
                    {
                        mysqli_query($conn, "INSERT INTO `coursevideo`
                                            (video_unique_id, video_name, location, video_type, course_id, runTime, upload_date, update_date)
                                             VALUES('$uniqueVideoName', '$videoNameUpload', '$location', '$videoType', '$CourseID', '$video_duration', '$RegDate', '$RegDate' )") or die(mysqli_error());

                        $selectContentOrder=mysqli_query($conn,"SELECT * FROM order_toshow_content
                                                WHERE course_unique_id='$course_unique_id'");


                        if(mysqli_num_rows($selectContentOrder) > 0)
                        {
                            $countContentOrder = mysqli_num_rows($selectContentOrder);
                            
                            mysqli_data_seek($selectContentOrder, $countContentOrder - 1);
                            
                            $OrderContent=mysqli_fetch_array($selectContentOrder);
                            $CurrentOrder = $OrderContent['order_toshow_content'];
                            $IncreasedOrder = intval($CurrentOrder) + 1;
                            // echo "<script>window.alert('total count is " . $countContentOrder . "');</script>";
                            // echo "<script>window.alert('current order is " . $CurrentOrder . "');</script>";
                            // echo "<script>window.alert('increased order is " . $IncreasedOrder . "');</script>";
                            

                            $content_type = 'Video';

                            $insertOrderContent="INSERT INTO order_toshow_content
                                                 (course_unique_id, content_type, video_unique_id, order_toshow_content)
                                                VALUES
                                                ('$course_unique_id', '$content_type', '$uniqueVideoName', '$IncreasedOrder')";
                            $runinsertOrderContent=mysqli_query($conn,$insertOrderContent);

                            if ($runinsertOrderContent)
                            {

                                echo "<script>alert('Video Uploaded')</script>";
                                echo "<script>window.location = 'createCurriculum.php'</script>";
                            }
                            else
                            {
                                echo mysqli_error($conn);
                                echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";
                            }

                        }
                        else
                        {
                            $order_toshow_content = 0;

                            $content_type = 'Video';

                            mysqli_query($conn, "INSERT INTO `order_toshow_content`
                            (course_unique_id, content_type, video_unique_id, order_toshow_content)
                             VALUES('$course_unique_id', '$content_type', '$uniqueVideoName', '$order_toshow_content')") or die(mysqli_error());

                            echo "<script>alert('Video Uploaded')</script>";
                            echo "<script>window.location = 'createCurriculum.php'</script>";

                        }





                    }

                }else{
                    echo "<script>alert('Wrong video format')</script>";
                    echo "<script>window.location = 'createCurriculum.php'</script>";
                }
            }else{
                echo "<script>alert('File too large to upload')</script>";
                echo "<script>window.location = 'createCurriculum.php'</script>";
            }


        }




	}

    if(isset($_POST['uploadYoutubeVideo']))
    {
        $videoNameUpload = $_POST['youtubevideoNameUpload'];
		$uniqueVideoName = date("Ymd").time();
        $youtubeLink = $_POST['youtubeEmbedLink'];
        $youtube_duration = $_POST['youtubeDuration'];
        $videoType = "youtubeVideo";

        date_default_timezone_set('Asia/Yangon');
        $RegDate=date('Y-m-d h:i:s');

        if($videoNameUpload == null || $videoNameUpload == '' || $youtubeLink == null || $youtubeLink == '' || $youtube_duration == null || $youtube_duration == ''  )
        {
            echo "<script>window.alert('Please fill all the information with *.');</script>";
            echo "<script>window.location('createCurriculum.php');</script>";

        }
        else
        {

            mysqli_query($conn, "INSERT INTO `coursevideo`
                                (video_unique_id, video_name, video_type, course_id, youtube_link, runTime, upload_date, update_date, order_toshow_content)
                                VALUES('$uniqueVideoName', '$videoNameUpload', '$videoType', '$CourseID', '$youtubeLink', '$youtube_duration', '$RegDate', '$RegDate', '$order_toshow_content' )") or die(mysqli_error());

            $selectContentOrder=mysqli_query($conn,"SELECT * FROM order_toshow_content
                            WHERE course_unique_id='$course_unique_id'");


            if(mysqli_num_rows($selectContentOrder) > 0)
            {
                $countContentOrder = mysqli_num_rows($selectContentOrder);
                            
                mysqli_data_seek($selectContentOrder, $countContentOrder - 1);
                
                $OrderContent=mysqli_fetch_array($selectContentOrder);
                $CurrentOrder = $OrderContent['order_toshow_content'];
                $IncreasedOrder = intval($CurrentOrder) + 1;


                $content_type = 'Video';

                $insertOrderContent="INSERT INTO order_toshow_content
                                    (course_unique_id, content_type, video_unique_id, order_toshow_content)
                                    VALUES
                                    ('$course_unique_id', '$content_type', '$uniqueVideoName', '$IncreasedOrder')";
                $runinsertOrderContent=mysqli_query($conn,$insertOrderContent);

                if ($runinsertOrderContent)
                {

                    echo "<script>alert('Video Uploaded')</script>";
                    echo "<script>window.location = 'createCurriculum.php'</script>";
                }
                else
                {
                    echo mysqli_error($conn);
                    echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";
                }

            }
            else
            {
                $order_toshow_content = 0;

                $content_type = 'Video';

                mysqli_query($conn, "INSERT INTO `order_toshow_content`
                (course_unique_id, content_type, video_unique_id, order_toshow_content)
                VALUES('$course_unique_id', '$content_type', '$uniqueVideoName', '$order_toshow_content')") or die(mysqli_error());

                echo "<script>alert('Video Uploaded')</script>";
                echo "<script>window.location = 'createCurriculum.php'</script>";

            }


        }




    }

    if(isset($_POST['yesDeleteButton']))
    {
        $yesDeleteValue = $_POST['yesDeleteValue']; //yesDeleteValue is not unique id type


        $Selectvideo="SELECT * FROM coursevideo
                    WHERE video_id='$yesDeleteValue' ";
        $runSelectvideo=mysqli_query($conn,$Selectvideo);
        $countSelectvideo=mysqli_num_rows($runSelectvideo);




        $arrSelectvideo=mysqli_fetch_array($runSelectvideo);

        $uniqueVdoId = $arrSelectvideo['video_unique_id'];

        $DeleteOrderContentvdo = mysqli_query($conn, "DELETE FROM order_toshow_content WHERE video_unique_id='$uniqueVdoId'" );
	    $DeleteVideo=mysqli_query($conn, "DELETE FROM coursevideo WHERE video_id='$yesDeleteValue'" );



        if ($DeleteVideo && $DeleteOrderContentvdo)
        {
            echo "<script>alert('Video has been deleted!')</script>";

        }
        else
        {
          echo mysqli_error($conn);
          echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";

        }


    }

    $displayBlock = "";
    $editVideoId = "";

    if(isset($_GET['editVideo']))
    {
        $editVideoId = $_GET['editVideo'];


        $editVideosql=mysqli_query($conn,"SELECT * FROM coursevideo
                                        WHERE video_id='$editVideoId'");
        $editVideoCount=mysqli_num_rows($editVideosql);

        $rowEditVdo=mysqli_fetch_array($editVideosql);
        $videoNameEdit = $rowEditVdo['video_name'];

        $displayBlock = "visible";


    }
    else
    {
        $displayBlock = "";

    }




    // lee lar
    if(isset($_POST['updateVideoBtn']))
    {

        $updateVideoType = $_POST['updateVideoType'];



        // ----------RegDate -----------
        date_default_timezone_set('Asia/Yangon');
        $RegDate=date('Y-m-d h:i:s');


        if ($updateVideoType == 'UploadedVideo')
        {

            $videoNameUpdate = $_POST['videoNameUpdate'];
            $videoUpdate = $_FILES['videoUpdate']['name'];
            $videoUpdate_temp = $_FILES['videoUpdate']['tmp_name'];
            $videoUpdate_size = $_FILES['videoUpdate']['size'];
            $videoDurationUpdate = $_POST['videoDurationUpdate'];
            $updateVideoId = $_POST['updateVideoId'];



            if($videoNameUpdate == null || $videoNameUpdate == '' || $videoUpdate == null || $videoUpdate == '' || $videoDurationUpdate == null || $videoDurationUpdate == ''  )
            {
                echo "<script>window.alert('Video content has not been updated! Please fill up editied information.');</script>";
                echo "<script>window.location('createCurriculum.php');</script>";

            }
            else
            {

                if($videoUpdate_size < 999999999){

                    $file = explode('.', $videoUpdate);
                    $end = end($file);


                    $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
                    if(in_array($end, $allowed_ext))
                    {
                        $uniqueVideoName = date("Ymd").time();
                        $location = 'assets/files/'.$uniqueVideoName.".".$end;

                        if(move_uploaded_file($videoUpdate_temp, $location)){

                            //update
                            $updateVdoSql="UPDATE coursevideo
                                            set
                                            video_name='$videoNameUpdate',
                                            location='$location',
                                            runTime='$videoDurationUpdate',
                                            update_date='$RegDate'

                                            WHERE video_id='$updateVideoId'";

                            $runUpdateVdo=mysqli_query($conn,$updateVdoSql);


                            if ($runUpdateVdo)
                            {
                            echo "<script>window.alert('".$videoNameUpdate." has been updated successfully!')</script>";
                            echo "<script>window.location='createCurriculum.php';</script>";

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
                        echo "<script>alert('Updated video has unsuported video format, please choose again.')</script>";
                        echo "<script>window.location = 'createCurriculum.php'</script>";
                    }
                }
                else
                {
                    echo "<script>alert('File too large to upload')</script>";
                    echo "<script>window.location = 'createCurriculum.php'</script>";
                }



            }



        }
        else
        {

            $videoNameUpdate = $_POST['videoNameUpdate'];
            $youtubeEmbedLinkUpdate = $_POST['youtubeEmbedLinkUpdate'];
            $videoDurationUpdate = $_POST['videoDurationUpdate'];
            $updateVideoId = $_POST['updateVideoId'];
		    $uniqueVideoName = date("Ymd").time();


            if($videoNameUpdate == null || $videoNameUpdate == '' || $youtubeEmbedLinkUpdate == null || $youtubeEmbedLinkUpdate == '' || $videoDurationUpdate == null || $videoDurationUpdate == ''  )
            {
                echo "<script>window.alert('Video content has not been updated! Please fill up editied information.');</script>";
                echo "<script>window.location('createCurriculum.php');</script>";

            }
            else
            {
                $updateVdoSql="UPDATE coursevideo
                            set
                            video_name='$videoNameUpdate',
                            youtube_link='$youtubeEmbedLinkUpdate',
                            runTime='$videoDurationUpdate',
                            update_date='$RegDate'

                            WHERE video_id='$updateVideoId'";

                $runUpdateVdo=mysqli_query($conn,$updateVdoSql);


                if ($runUpdateVdo)
                {
                echo "<script>window.alert('".$videoNameUpdate." has been updated successfully!')</script>";
                echo "<script>window.location='createCurriculum.php';</script>";

                }
                else
                {
                    echo mysqli_error($conn);
                    echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";

                }
            }


        }


    }

    // if file name from update course vdo is the same from the database, just window.location to create curriculum page
    // else update

    if(isset($_POST['nextBtn']))
    {
        $CourseID = $arrCourse['course_id'];

        $selectCourseVideo="SELECT * FROM coursevideo
                            WHERE course_id='$CourseID'";
        $runCourseVideo=mysqli_query($conn,$selectCourseVideo);

        // echo "<script>window.alert('".$_SESSION['editCourseid']."')</script>";


        if(mysqli_num_rows($runCourseVideo) > 0) //there is data
        {
             
    
            if (!isset($_SESSION['editCourseid'] ) || $_SESSION['editCourseid'] == '' || $_SESSION['editCourseid'] == ' ' || $_SESSION['editCourseid'] == Null) 
            {
                echo "<script>window.location='uploadMedia.php';</script>";

            }
            else{
                $editCourseid = $_SESSION['editCourseid'];

                echo "<script>window.location='uploadMedia.php?editCourseid=".$editCourseid."'</script>";
            }
        }
        else
        {
            echo "<script>window.alert('Please upload curriculumn video to continue!');</script>";
            echo "<script>window.location='createCurriculum.php';</script>";

        }


    }



    if(isset($_POST['saveQuizPackage']))
    {
        $quizPackageName = $_POST['quizPackageName'];
        $CourseID = $arrCourse['course_id'];

        $randomNum = rand(10,100);
        $quizUniquePackId = date("Ymd").time().$randomNum.$quizPackageName;


        date_default_timezone_set('Asia/Yangon');
        $RegDate=date('Y-m-d h:i:s');



        $inserQuizPack="INSERT INTO quizpackage
                            (quizPackage_name, course_id, upload_date, update_date, quizPackage_unique_id, order_toshow_content)
                            VALUES
                            ('$quizPackageName', '$CourseID', '$RegDate', '$RegDate', '$quizUniquePackId', '$order_toshow_content')";
        $runInsertQuizPack=mysqli_query($conn,$inserQuizPack);

        if ($runInsertQuizPack)
        {
            $selectContentOrder=mysqli_query($conn,"SELECT * FROM order_toshow_content
                            WHERE course_unique_id='$course_unique_id'");


            if(mysqli_num_rows($selectContentOrder) > 0)
            {
                $countContentOrder = mysqli_num_rows($selectContentOrder);
                            
                mysqli_data_seek($selectContentOrder, $countContentOrder - 1);
                
                $OrderContent=mysqli_fetch_array($selectContentOrder);
                $CurrentOrder = $OrderContent['order_toshow_content'];
                $IncreasedOrder = intval($CurrentOrder) + 1;
                $content_type = 'Quiz';

                $insertOrderContent="INSERT INTO order_toshow_content
                                    (course_unique_id, content_type, quizPackage_unique_id, order_toshow_content)
                                    VALUES
                                    ('$course_unique_id', '$content_type', '$quizUniquePackId', '$IncreasedOrder')";
                $runinsertOrderContent=mysqli_query($conn,$insertOrderContent);



            }
            else
            {
                $order_toshow_content = 0;

                $content_type = 'Quiz';

                mysqli_query($conn, "INSERT INTO `order_toshow_content`
                (course_unique_id, content_type, quizPackage_unique_id, order_toshow_content)
                VALUES('$course_unique_id', '$content_type', '$quizUniquePackId', '$order_toshow_content')") or die(mysqli_error());



            }


            $selectQuizPack="SELECT * FROM quizpackage
                                WHERE quizPackage_unique_id='$quizUniquePackId'";

            $runQuizPack=mysqli_query($conn,$selectQuizPack);


            if(mysqli_num_rows($runQuizPack) > 0)
            {
                $quizPack = mysqli_fetch_assoc($runQuizPack);
                echo "<script>window.alert('Course Package is set')</script>";
                echo "<script>window.location='createCurriculum.php?quizPackage=".$quizPack['quizPackage_unique_id']." ' </script>";
            }


        }
        else
        {
            echo mysqli_error($conn);
            echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";

        }


    }

    $displayBlockQuiz = "";
    $quizPackageId = "";
    $quizPackageUniqueId = "";

    if(isset($_GET['quizPackage']))
    {
        $quizPackageId = $_GET['quizPackage'];


        $quizPackSelect=mysqli_query($conn,"SELECT * FROM quizpackage
                                            WHERE quizPackage_unique_id='$quizPackageId' " );

        $quizPackrow=mysqli_fetch_array($quizPackSelect);
        $quizPackName = $quizPackrow['quizPackage_name'];
        $quizPackageUniqueId = $quizPackrow['quizPackage_unique_id'];

        $displayBlockQuiz = "visible";


    }
    else
    {
        $displayBlockQuiz = "";

    }


    if(isset($_POST['saveQuiz']))
    {
        $quizPackageUniqueId = $_POST['quizPackageUniqueId'];

        if(!empty($_POST['checkOption']))
        {
            // Counting number of checked checkboxes.
            $checked_count = count($_POST['checkOption']);
            // echo "You have selected following ".$checked_count." option(s): <br/>";
            // Loop to store and display values of individual checked checkbox.
            foreach($_POST['checkOption'] as $selected)
            {
                $selectedCheckBox = $selected;
                // echo "<script>window.alert('".$selectedCheckBox."');</script>";

            }

            $quizQuestion = $_POST['quizQuestion'];
            $optionAnswer1 = $_POST['optionAnswer1'];
            $optionAnswer2 = $_POST['optionAnswer2'];
            $optionAnswer3 = $_POST['optionAnswer3'];
            $optionAnswer4 = $_POST['optionAnswer4'];
            $quizPackageUniqueId = $_POST['quizPackageUniqueId'];
            $isToRedirect = $_POST['viewQuizId'];

            $correctOption = $selectedCheckBox;


            if($isToRedirect == 'null' || $isToRedirect == '' || $isToRedirect == null)
            {
                $quizPackageUniqueId = $quizPackageUniqueId;

            }
            else
            {
               $quizPackageUniqueId = $isToRedirect;

            }



            if($quizQuestion == null || $quizQuestion == '' || $optionAnswer1 == null || $optionAnswer1 == '' || $optionAnswer2 == null || $optionAnswer1 == null || $optionAnswer3 == '' || $optionAnswer3 == null || $optionAnswer4 == null || $optionAnswer4 == '' )
            {
                echo "<script>window.alert('Please add questions for quiz or Option answer');</script>";
                if($isToRedirect == 'null' || $isToRedirect == '' || $isToRedirect == null) {  echo "<script>window.location='createCurriculum.php?quizPackage=".$quizPackageUniqueId." '; </script>"; } else {   echo "<script>window.location='createCurriculum.php?viewQuizId=".$isToRedirect."  ';</script>"; }


            }
            else
            {
                $arr = array(
                    array(
                        "q" => $quizQuestion,
                        "options" => array(
                                        $optionAnswer1, $optionAnswer2, $optionAnswer3, $optionAnswer4
                                    ),
                        "answer" => $correctOption
                    )
                );

                $quiz_json = json_encode($arr);

                date_default_timezone_set('Asia/Yangon');
                $RegDate=date('Y-m-d h:i:s');

                // echo "<script>window.alert('".$quiz_json."');</script>";

                $insertQuiz="INSERT INTO coursequiz
                                (quiz_question, quiz_json, upload_date, update_date, quizPackage_id, option1, option2, option3, option4, correct_option)
                                VALUES
                                ('$quizQuestion', '$quiz_json', '$RegDate', '$RegDate', '$quizPackageUniqueId', '$optionAnswer1', '$optionAnswer2' , '$optionAnswer3', '$optionAnswer4', '$correctOption')";
                $runInsertQuiz=mysqli_query($conn,$insertQuiz);

                if ($runInsertQuiz)
                {


                    echo "<script>window.alert('Quiz has been saved');</script>";
                    if($isToRedirect == 'null' || $isToRedirect == '' || $isToRedirect == null) {  echo "<script>window.location='createCurriculum.php?quizPackage=".$quizPackageUniqueId." '; </script>"; } else {   echo "<script>window.location='createCurriculum.php?viewQuizId=".$isToRedirect."  ';</script>"; }

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
            echo "<script>window.alert('Please select one option as an answer');</script>";
            if($isToRedirect == 'null' || $isToRedirect == '' || $isToRedirect == null) {  echo "<script>window.location='createCurriculum.php?quizPackage=".$quizPackageUniqueId." '; </script>"; } else {   echo "<script>window.location='createCurriculum.php?viewQuizId=".$isToRedirect."  ';</script>"; }

        }
    }

    $EditQuizBlock = "";
    $quizIdToEdit = "";
    $quiz_id = "";

    if(isset($_GET['editQuizId']))
    {
        $quizIdToEdit = $_GET['editQuizId'];
        $QuizPackIdToEdit = $_GET['QuizPackId'];
        $RedirectValue = $_GET['Redirect'];


        $quizSelect=mysqli_query($conn,"SELECT * FROM coursequiz
                                            WHERE quiz_id='$quizIdToEdit' " );

        $quizRow=mysqli_fetch_array($quizSelect);
        $quiz_question = $quizRow['quiz_question'];
        $quiz_id = $quizRow['quiz_id'];
        $option1 = $quizRow['option1'];
        $option2 = $quizRow['option2'];
        $option3 = $quizRow['option3'];
        $option4 = $quizRow['option4'];
        $correct_option = $quizRow['correct_option'];



        $EditQuizBlock = "visible";


    }
    else
    {
        $EditQuizBlock = "";

    } //@id09



    //@id09

    if(isset($_POST['saveQuizEdit']))
    {


        if(!empty($_POST['checkOptionEdit']))
        {

            foreach($_POST['checkOptionEdit'] as $selectedEdit)
            {
                $selectedCheckBoxEdit = $selectedEdit;
                // echo "<script>window.alert('".$selectedCheckBox."');</script>";

            }

            $quizQuestionEdit = $_POST['quizQuestionEdit'];
            $optionAnswer1Edit = $_POST['optionAnswer1Edit'];
            $optionAnswer2Edit = $_POST['optionAnswer2Edit'];
            $optionAnswer3Edit = $_POST['optionAnswer3Edit'];
            $optionAnswer4Edit = $_POST['optionAnswer4Edit'];
            $editQuizId = $_POST['editQuizId'];
            $quizPackUniqueId = $_POST['quizPackUniqueId'];
            $editQuizId = $_POST['editQuizId'];
            $redirectForViewQuiz = $_POST['redirectForViewQuiz'];
            // echo "<script>window.alert('".$redirectForViewQuiz."');</script>";


            $correctOptionEdit = $selectedCheckBoxEdit;

            if($redirectForViewQuiz == 'null')
            {
                $viewQuizRedirectLink = "window.location='createCurriculum.php?quizPackage=".$quizPackUniqueId." '   ";

            }
            else
            {
                $viewQuizRedirectLink = "window.location='createCurriculum.php?viewQuizId=".$redirectForViewQuiz."  ' ";

            }



            if($quizQuestionEdit == null || $quizQuestionEdit == '' || $optionAnswer1Edit == null || $optionAnswer1Edit == '' || $optionAnswer2Edit == null || $optionAnswer2Edit == '' || $optionAnswer2Edit == null || $optionAnswer3Edit == '' || $optionAnswer3Edit == null || $optionAnswer4Edit == null || $optionAnswer4Edit == '' )
            {
                echo "<script>window.alert('Please add questions for quiz or Option answer');</script>";
                echo "<script>".$viewQuizRedirectLink."</script>";

            }
            else
            {
                $arr = array(
                    array(
                        "q" => $quizQuestionEdit,
                        "options" => array(
                                        $optionAnswer1Edit, $optionAnswer2Edit, $optionAnswer3Edit, $optionAnswer4Edit
                                    ),
                        "answer" => $correctOptionEdit
                    )
                );

                // $quiz_json = json_encode($arr);

                date_default_timezone_set('Asia/Yangon');
                $RegDate=date('Y-m-d h:i:s');

                // echo "<script>window.alert('".$quiz_json."');</script>";



                $updateQuiz="UPDATE coursequiz
                                set
                                quiz_question = '$quizQuestionEdit',
                                quiz_json='$quiz_json',
                                update_date='$RegDate',
                                option1='$optionAnswer1Edit',
                                option2='$optionAnswer2Edit',
                                option3='$optionAnswer3Edit',
                                option4='$optionAnswer4Edit',
                                correct_option = '$correctOptionEdit'

                                WHERE quiz_id='$editQuizId'";

                $runUpdateQuiz=mysqli_query($conn,$updateQuiz);


                if ($runUpdateQuiz)
                {
                echo "<script>window.alert('".$quizQuestionEdit." has been updated successfully!')</script>";
                echo "<script>".$viewQuizRedirectLink."</script>";

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
            echo "<script>window.alert('Please select one option as an answer');</script>";
            echo "<script>".$viewQuizRedirectLink."</script>";


        }
    }

    if(isset($_POST['yesDeleteQuiz']))
    {
        $combinedValue = $_POST['yesDeleteQuizid'];

        // echo "<script>alert('".$combinedValue."')</script>";

        $splitedValues = explode("&&", $combinedValue);

        $DeleteQuizid = $splitedValues[0];
        $redirectLink = $splitedValues[1];

        // echo "<script>alert('".$redirectLink."')</script>";


        $quizPackUniqueId = $_POST['quizPackId'];


	    $DeleteQuiz=mysqli_query($conn, "DELETE FROM coursequiz WHERE quiz_id='$DeleteQuizid'" );

        if ($DeleteQuiz)
        {
            echo "<script>window.alert('Quiz has been deleted!')</script>";
            if($redirectLink == 'null' || $redirectLink == '' || $redirectLink == null) {  echo "<script>window.location='createCurriculum.php?quizPackage=".$quizPackUniqueId." '; </script>"; } else {   echo "<script>window.location='createCurriculum.php?viewQuizId=".$redirectLink."  ';</script>"; }

        }
        else
        {
          echo mysqli_error($conn);
          echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";

        }


    }

    if(isset($_POST['cancelQuizCreate']))
    {
        $quizPackUniqueId = $_POST['quizPackId'];


        $DeleteOrderContentQuizPack = mysqli_query($conn, "DELETE FROM order_toshow_content WHERE quizPackage_unique_id='$quizPackUniqueId'" );
	    $DeleteQuiz=mysqli_query($conn, "DELETE FROM coursequiz WHERE quizPackage_id='$quizPackUniqueId'" );
	    $DeleteQuizPackage=mysqli_query($conn, "DELETE FROM quizpackage WHERE quizPackage_unique_id='$quizPackUniqueId'" );

        if ($DeleteQuiz && $DeleteQuizPackage && $DeleteOrderContentQuizPack)
        {
            echo "<script>alert('Quiz Creation has been cancelled!')</script>";
            echo "<script>window.location = 'createCurriculum.php';</script>";

        }
        else
        {
          echo mysqli_error($conn);
          echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";

        }


    }
    if(isset($_POST['quizPackageDelete']))
    {
        $DeletequizPackUniqueId = $_POST['deleteQuizPackageuniqueId'];


        $DeleteOrderContentQuizPack1 = mysqli_query($conn, "DELETE FROM order_toshow_content WHERE quizPackage_unique_id='$DeletequizPackUniqueId'" );
	    $DeleteQuiz1=mysqli_query($conn, "DELETE FROM coursequiz WHERE quizPackage_id='$DeletequizPackUniqueId'" );
	    $DeleteQuizPackage1=mysqli_query($conn, "DELETE FROM quizpackage WHERE quizPackage_unique_id='$DeletequizPackUniqueId'" );

        if ($DeleteQuiz1 && $DeleteQuizPackage1 && $DeleteOrderContentQuizPack1)
        {
            echo "<script>alert('Quiz has been deleted!')</script>";
            echo "<script>window.location = 'createCurriculum.php';</script>";

        }
        else
        {
          echo mysqli_error($conn);
          echo "<p>Something went wrong in ".mysqli_error($conn)."</p>";

        }
    }

    $viewQuizPackId = '';

    if(isset($_GET['viewQuizId']))
    {
        $viewQuizPackId = $_GET['viewQuizId'];



        $quizPackSelect=mysqli_query($conn,"SELECT * FROM quizpackage
                                            WHERE quizPackage_unique_id='$viewQuizPackId' " );

        $quizPackRow=mysqli_fetch_array($quizPackSelect);

        $quizViewSelect=mysqli_query($conn,"SELECT * FROM coursequiz
                                            WHERE quizPackage_id='$viewQuizPackId' " );

        $quizViewRow=mysqli_fetch_array($quizViewSelect);



        $quiz_question = $quizViewRow['quiz_question'];
        $quiz_id = $quizViewRow['quiz_id'];
        $option1 = $quizViewRow['option1'];
        $option2 = $quizViewRow['option2'];
        $option3 = $quizViewRow['option3'];
        $option4 = $quizViewRow['option4'];
        $correct_option = $quizViewRow['correct_option'];

        $quizPackage_name = $quizPackRow['quizPackage_name'];
        $viewQuizPackId = $quizPackRow['quizPackage_unique_id'];



        $viewQuizBlock = "visible";


    }
    else
    {
        $viewQuizBlock = "";

    } //viewQuizPack


     }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Course | MyanLearn Instructor</title>

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

    <!-- for Modal box -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- for data table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css"/>

    <style>
        .visible{
            display: block;
        }

        .cbx, .cbx1, .cbx2, .cbx3, .cbxEdit, .cbx1Edit, .cbx2Edit, .cbx3Edit {
            -webkit-perspective: 20;
            perspective: 20;
            position: relative;
            top: 25%;
            left: 30%;
            margin: -12px;
            border: 2px solid #e8e8eb;
            background: #e8e8eb;
            border-radius: 4px;
            transform: translate3d(0, 0, 0);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cbx:hover, .cbx1:hover, .cbx2:hover, .cbx3:hover, .cbxEdit:hover, .cbx1Edit:hover, .cbx2Edit:hover, .cbx3Edit:hover  {
        border-color: #0b76ef;
        }

        .flip, .flip1, .flip2, .flip3, .flipEdit, .flip1Edit, .flip2Edit, .flip3Edit {
        display: block;
        transition: all 0.4s ease;
        transform-style: preserve-3d;
        position: relative;
        width: 30px;
        height: 30px;
        }

        #cbx, #cbx1, #cbx2, #cbx3, #cbxEdit, #cbx1Edit, #cbx2Edit, #cbx3Edit {
        display: none;
        }

        #cbx:checked + .cbx, #cbx1:checked + .cbx1, #cbx2:checked + .cbx2, #cbx3:checked + .cbx3, #cbxEdit:checked + .cbxEdit, #cbx1Edit:checked + .cbx1Edit, #cbx2Edit:checked + .cbx2Edit, #cbx3Edit:checked + .cbx3Edit {
        border-color: #0b76ef;
        }

        #cbx:checked + .flip,  #cbx1:checked + .flip1,  #cbx2:checked + .flip2,  #cbx3:checked + .flip3, #cbxEdit:checked + .flipEdit,  #cbx1Edit:checked + .flip1Edit,  #cbx2Edit:checked + .flip2Edit,  #cbx3Edit:checked + .flip3Edit {
        transform: rotateY(180deg);
        }



        .front,.back {
        backface-visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
        width: 30px;
        height: 30px;
        border-radius: 2px;
        }

        .front {
        background: #fff;
        z-index: 1;
        }

        .back {
        transform: rotateY(180deg);
        background: #0b76ef;
        text-align: center;
        color: #fff;
        /* line-height: 20px; */
        box-shadow: 0 0 0 1px #0b76ef;
        }

        .back svg {
        margin-top: 3px;
        fill: none;
        }

        .back svg path {
        stroke: #fff;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        }


        /* edit button  */

        .edit-button {
        width: 40px;
        height: 40px;
        border: none;
        border-radius: 5px;
        background-color: var(--light-gradient);
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease-in-out;
        }

        .edit-button:hover {
        opacity: 0.8;
        }

        .edit-button i {
        font-size: 20px;
        }

        .edit-button:active {
        transform: scale(0.9);
        box-shadow: none;
        }

        .ml-30px
        {
            margin-left: 30px;
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
                <div class="progress" id="progress" style="width:33.333%;"></div>

              
                <div class="progress-step progress-step-active" data-title="Intro"></div>
                <div class="progress-step progress-step-active" data-title="Curriculum"></div>
                <div class="progress-step" data-title="Media"></div>
                <div class="progress-step" data-title="Price"></div>

                
                
            </div>


            <div class="form-step form-step-active">

                <div class="tab-info">
                    <h3 class="tab-title">Curriculum Form</h3>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="curriculum-add-item">
                        <h4 class="section-title mt-0"><i class="fas fa-th-list mr-2"></i>Curriculum</h4>
                        <button class="main-btn color btn-hover ml-left" data-target="#id01" onclick="document.getElementById('id01').style.display='block'">New Course Item</button>
                    </div>
                </div>



                <div class="form-fillup">

                    <div class="col-md-12">

                            <div id="id01" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">What kind of Course Item would you like to add?</p>
                                        <div class="container">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <button class="lectureButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center"  onclick="document.getElementById('id01').style.display='none'; document.getElementById('id02').style.display='block'; ">
                                                        <i class="fas fa-video mr-2"></i> Video
                                                    </button>
                                                </div>
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <div class="quizButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center "  onclick="document.getElementById('id01').style.display='none'; document.getElementById('id07').style.display='block'; " >
                                                    <i class='bx bx-question-mark h1FontSize'></i> Quiz
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <form action="createCurriculum.php" method="post" enctype="multipart/form-data" >



                            <div id="id02" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold colorFontBlack"> <i class="fa-brands fa-youtube colorFontBlack"></i> Add Video Lecture</p>
                                        <br>
                                        <div class="container">
                                            <div class="row d-flex justify-content-between">

                                            <div class="tab">
                                                <a class="tablinks" onclick="openCity(event, 'Upload')" id="defaultOpen" >Upload Video</a>
                                                <a class="tablinks" onclick="openCity(event, 'Youtube')">Youtube Link</a>
                                            </div>

                                            <div id="Upload" class="tabcontent">
                                                <div class="col-md-12 well">
                                                    <h3 class="text-primary">Upload Video with 'avi', 'flv', 'wmv', 'mov', 'mp4' format. </h3>
                                                    <hr style="border-top:1px dotted #ccc;"/>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_modal" onclick="document.getElementById('id03').style.display='block';"><span class="glyphicon glyphicon-plus"></span> Add Video</button>

                                                </div>


                                            </div>

                                            <div id="Youtube" class="tabcontent">
                                                    <div class="col-md-12">
                                                        <div class="input-group">

                                                            <label for="coursetitle">Youtube Video Name <span class="primaryColor">*</span></label>
                                                            <input type="text" max-length="50" data-word-count="50;CourseTitleYoutube" name="youtubevideoNameUpload" id="courseTitle" placeholder="Name your lecutre video name" onkeyup="count_down(this)"  />
                                                            <div class="badge_num" id="CourseTitleYoutube">50</div>

                                                        </div>

                                                        <div class="input-group">

                                                            <label for="coursetitle">Youtube Video Embed Link (iframe tag)<span class="primaryColor">*</span></label>
                                                            <input type="text" name="youtubeEmbedLink" id="youtubeVideoLink" placeholder="Youtube Embed Link"  />


                                                        </div>

                                                        <div class="input-group d-flex flex-column">

                                                            <label for="coursetitle">Estimated Runtime<span class="primaryColor">*</span></label>

                                                            <div class="d-flex row">
                                                                <input type="number" name="youtubeDuration" min="0" style="max-width: 5%; padding: 3px;"> Minutes
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.getElementById('id02').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                            <button name="uploadYoutubeVideo" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                                                        </div>

                                                    </div>
                                            </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="id03" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Select Video and Upload!</p>
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="col-md-12">
                                                        <div class="input-group">

                                                            <label for="coursetitle">Video Name <span class="primaryColor">*</span></label>
                                                            <input type="text" max-length="50" data-word-count="50;CourseTitle" name="videoNameUpload" id="courseTitle" placeholder="Name your lecture video name" onkeyup="count_down(this)"  />
                                                            <div class="badge_num" id="CourseTitle">50</div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <label for="coursetitle">Video File <span class="primaryColor">*</span></label>
                                                            <input type="file" name="video" class="form-control-file"/>
                                                        </div>
                                                    </div>


                                                    <div class="input-group d-flex flex-column">

                                                        <label for="coursetitle">Estimated Runtime<span class="primaryColor">*</span></label>

                                                        <div class="d-flex row">
                                                            <input type="number" name="videoDuration" min="0" style="max-width: 5%; padding: 3px;"> Minutes
                                                        </div>

                                                    </div>

                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.getElementById('id03').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                    <button name="uploadVideo" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Display -->

                            <?php

                                $CourseID = $arrCourse['course_id'];
                                $course_unique_id = $course_unique_id;

                                // echo "<script>window.alert('".$course_unique_id."');</script>";


                                $selectOrderToShowContent="SELECT * FROM order_toshow_content
                                                WHERE course_unique_id='$course_unique_id'
                                                ORDER BY order_toshow_content ASC;";
                                $runOrderToShowContent=mysqli_query($conn,$selectOrderToShowContent);
                                $countOrderContent=mysqli_num_rows($runOrderToShowContent);
                                // echo "<script>window.alert('".$countOrderContent."');</script>";


                                if($countOrderContent == 0)
                                {
                                    echo "<p>There is no lecture content list to show related with this course!</p>";
                                }

                                else
                                {


                                ?>


                                    <div class="container">
                                        <div class="row">
                                            <div class="mb-4 mt-3" style="overflow-x:auto;">
                                                <table id="example" class="display table table-striped table-responsive hover" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Title</th>
                                                            <th>Duration</th>
                                                            <th>Latest Date</th>
                                                            <th>Count</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php
                                                            $LectureNum = 0;
                                                            for ($i=0; $i < $countOrderContent ; $i++) {

                                                                $LectureNum++;

                                                                $arrOrderContent=mysqli_fetch_array($runOrderToShowContent);

                                                                $OrderlyCourseUniqueId = $arrOrderContent['course_unique_id'];
                                                                $quizPackage_unique_id = $arrOrderContent['quizPackage_unique_id'];
                                                                $contentType =$arrOrderContent['content_type'];



                                                                $selectCourse="SELECT * FROM course
                                                                                WHERE course_unique_id='$OrderlyCourseUniqueId'";
                                                                $runSelectCourse=mysqli_query($conn,$selectCourse);
                                                                $arrSelectCourse=mysqli_fetch_array($runSelectCourse);
                                                                $courseId = $arrSelectCourse['course_id'];

                                                                // echo "<script>window.alert('".$contentType."');</script>";


                                                                if($contentType == "video")
                                                                {

                                                                $video_unique_id = $arrOrderContent['video_unique_id'];
                                                                // echo "<script>window.alert('".$video_unique_id."');</script>";




                                                                    $Selectvideo="SELECT * FROM coursevideo
                                                                                    WHERE course_id='$courseId' && video_unique_id = '$video_unique_id'";
                                                                    $runSelectvideo1=mysqli_query($conn,$Selectvideo);
                                                                    $countSelectvideo=mysqli_num_rows($runSelectvideo1);



                                                                    for ($j=0; $j < $countSelectvideo ; $j++)
                                                                    {

                                                                        $arrSelectvideo=mysqli_fetch_array($runSelectvideo1);

                                                                        $TableVideoId = $arrSelectvideo['video_id'];
                                                                        $TableVideoName = $arrSelectvideo['video_name'];
                                                                        $TableDuration = $arrSelectvideo['runTime'];
                                                                        $TableUploadDate = $arrSelectvideo['update_date'];
                                                                        $videoType = $arrSelectvideo['video_type'];

                                                                        echo "<tr>";

                                                                        echo  "<td>Lecture-". ($LectureNum) ."</td>";
                                                                        echo  "<td>$TableVideoName</td>";
                                                                        echo  "<td>$TableDuration Minutes</td>";
                                                                        echo  "<td>$TableUploadDate</td>";
                                                                        echo  "<td>-</td>";
                                                                        echo  "<td class=\"d-flex justify-content-around\">

                                                                        <button type='button' class=\"btn btn-primary m-1 mt-2\" style=\" background-color: #0d6efd!important;\"  name=\"editVideoBtn\" data-target-edit='".$TableVideoId."' onclick='onClickEdit(this)' ><i class=\"fas fa-edit\"></i></button>
                                                                        <button type='button' class=\"btn btn-danger m-1 mt-2\" style=\" background-color: #dc3545!important;\" name=\"deleteVideoBtn\" data-target-delete='".$TableVideoId."' onclick='onClickDelete(this)' ><i class=\"far fa-trash-alt\"></i></button>
                                                                        ";


                                                                        if($videoType == "quizType")
                                                                        {
                                                                            echo "<button type='button' class=\"btn btn-warning m-1 mt-2\" style=\" background-color: #ffc107!important;\"><i class=\"fa-solid fa-eye\"></i></button>";
                                                                        }


                                                                        echo"</td>";




                                                                        echo "</tr>";

                                                                    }




                                                                }

                                                                if($contentType == "quiz")
                                                                {

                                                                    $selectQuizPack="SELECT * FROM quizpackage
                                                                                    WHERE course_id='$courseId' && quizPackage_unique_id='$quizPackage_unique_id'";
                                                                    $runSelectQuizPack=mysqli_query($conn,$selectQuizPack);
                                                                    $countQuizPack=mysqli_num_rows($runSelectQuizPack);

                                                                    for ($k=0; $k < $countQuizPack ; $k++)
                                                                    {

                                                                        $arrQuizPack=mysqli_fetch_array($runSelectQuizPack);

                                                                        $TableQuizPackId = $arrQuizPack['quizPackage_unique_id'];
                                                                        $TableQuizPackName = $arrQuizPack['quizPackage_name'];
                                                                        $TableUploadDate = $arrQuizPack['update_date'];


                                                                        $selectQuizContent="SELECT * FROM coursequiz
                                                                                        WHERE quizPackage_id='$TableQuizPackId' ";
                                                                        $runSelectQuizContent=mysqli_query($conn,$selectQuizContent);
                                                                        $countQuizContent=mysqli_num_rows($runSelectQuizContent);

                                                                        echo "<tr>";

                                                                        echo  "<td>Lecture-". ($LectureNum) ."</td>";
                                                                        echo  "<td>$TableQuizPackName</td>";
                                                                        echo  "<td>-</td>";
                                                                        echo  "<td>$TableUploadDate</td>";
                                                                        echo  "<td>$countQuizContent</td>";
                                                                        echo  "<td class=\"d-flex justify-content-around\">

                                                                        <button type='button' class=\"btn btn-warning m-1 mt-2\" style=\" background-color: #ffc107!important;\" name=\"viewQuizBtn\" data-target-viewQuizPackage='".$TableQuizPackId."' onclick='clickViewQuizPackage(this)'><i class=\"fa-solid fa-eye\"></i></button>
                                                                        <button type='button' class=\"btn btn-danger m-1 mt-2\" style=\" background-color: #dc3545!important;\" name=\"deleteVideoBtn\" data-target-deleteQuizPackage='".$TableQuizPackId."' onclick='clickDeleteQuizPackage(this)' ><i class=\"far fa-trash-alt\"></i></button>
                                                                        ";







                                                                        echo"</td>";




                                                                        echo "</tr>";

                                                                    }




                                                                }



                                                            }

                                                        ?>

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    }
                                ?>


                            <div id="id04" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id04').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Are you sure you want to delete this video?</p>
                                        <div class="container">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <button class="lectureButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center" name="yesDeleteButton"  style=" background-color: #28a745!important;">
                                                        Yes
                                                    </button>
                                                    <input type="hidden" id="yesDeleteValue" name="yesDeleteValue">
                                                </div>
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <div class="quizButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center " style=" background-color: #dc3545!important;" onclick="document.getElementById('id04').style.display='none'" >
                                                        No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <!-- lee lar -->

                            <div id="id05"  <?php echo "class='w3-modal ".$displayBlock."'" ?> >
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="window.location.assign('createCurriculum.php');" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Edit Video - <?php echo $videoNameEdit; ?> </p>
                                            <div class="modal-content">
                                                <div class="modal-body">

                                                    <?php

                                                        if($rowEditVdo['video_type'] == 'UploadedVideo')
                                                        {

                                                    ?>

                                                            <div class="col-md-12">
                                                                <div class="input-group">

                                                                    <label for="coursetitle">Video Name <span class="primaryColor">*</span></label>
                                                                    <input type="text" max-length="50" data-word-count="50;CourseTitle" value="<?php echo $rowEditVdo['video_name']; ?>" name="videoNameUpdate" id="courseTitle" placeholder="Name your lecture video name" onkeyup="count_down(this)"  />
                                                                    <div class="badge_num" id="CourseTitle">50</div>

                                                                    <input type="hidden" value="<?php echo $rowEditVdo['video_type']; ?>" name="updateVideoType">
                                                                    <input type="hidden" value="<?php echo $rowEditVdo['video_id']; ?>" name="updateVideoId">

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                <label for="coursetitle">Video File <span class="primaryColor">*</span></label>
                                                                    <input type="file" name="videoUpdate" class="form-control-file" value="<?php echo $rowEditVdo['location']; ?>"/>
                                                                </div>
                                                            </div>


                                                            <div class="input-group d-flex flex-column">

                                                                <label for="coursetitle">Estimated Runtime<span class="primaryColor">*</span></label>

                                                                <div class="d-flex row">
                                                                    <input type="number" name="videoDurationUpdate" min="0" style="max-width: 5%; padding: 3px;" value="<?php echo $rowEditVdo['runTime']; ?>"> Minutes
                                                                </div>

                                                            </div>

                                                    <?php
                                                        }
                                                        else
                                                        {
                                                    ?>

                                                            <div class="col-md-12">
                                                                <div class="input-group">

                                                                    <label for="coursetitle">Youtube Video Name <span class="primaryColor">*</span></label>
                                                                    <input type="text" max-length="50" data-word-count="50;CourseTitle" value="<?php echo $rowEditVdo['video_name']; ?>" name="videoNameUpdate" id="courseTitle" placeholder="Name your lecture video name" onkeyup="count_down(this)"  />
                                                                    <div class="badge_num" id="CourseTitle">50</div>

                                                                    <input type="hidden" value="<?php echo $rowEditVdo['video_type']; ?>" name="updateVideoType">
                                                                    <input type="hidden" value="<?php echo $rowEditVdo['video_id']; ?>" name="updateVideoId">

                                                                </div>
                                                            </div>

                                                            <div class="input-group">

                                                                <label for="coursetitle">Youtube Video Embed Link (iframe tag)<span class="primaryColor">*</span></label>
                                                                <input type="text" name="youtubeEmbedLinkUpdate" id="youtubeVideoLink" placeholder="Youtube Embed Link" value="<?php echo $rowEditVdo['youtube_link']; ?>"  />


                                                            </div>

                                                            <div class="input-group d-flex flex-column">

                                                                <label for="coursetitle">Estimated Runtime<span class="primaryColor">*</span></label>

                                                                <div class="d-flex row">
                                                                    <input type="number" name="videoDurationUpdate" min="0" style="max-width: 5%; padding: 3px;" value="<?php echo $rowEditVdo['runTime']; ?>"> Minutes
                                                                </div>

                                                            </div>

                                                    <?php
                                                        }
                                                    ?>



                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.assign('createCurriculum.php')";><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                    <button name="updateVideoBtn" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Update</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>



                            <div id="id06"  class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">


                                    <?php
                                        if($viewQuizPackId == null || $viewQuizPackId == '' || $viewQuizPackId == "null" )
                                        {
                                            $redirectLink = "document.getElementById('id06').style.display='none'; document.getElementById('id08').style.display='block'; ";
                                        }
                                        else
                                        {
                                            $redirectLink = "document.getElementById('id06').style.display='none'; document.getElementById('id13').style.display='block'; ";
                                        }
                                    ?>

                                        <span onclick="<?php echo $redirectLink; ?>" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Add Quiz</p>
                                        <p class="opacity-75 font-weight-bold primaryColor">Select the checkbox for the correct Answer.</p>
                                            <div class="modal-content">
                                                <div class="modal-body">


                                                            <div class="col-md-12">
                                                                <div class="input-group">

                                                                    <label for="coursetitle">Question<span class="primaryColor">*</span></label>
                                                                    <input type="text" max-length="50" data-word-count="50;QuizQuestion" name="quizQuestion" id="courseTitle" placeholder="Name your Quiz Question" onkeyup="count_down(this)"  />
                                                                    <div class="badge_num" id="QuizQuestion">50</div>



                                                                </div>
                                                                <input type="hidden" name="quizPackageUniqueId" value ="<?php echo $quizPackageUniqueId ?>">
                                                            </div>

                                                            <div><b class="h1FontSize">Options</b> <span class="text-muted primaryColor">(Please tick the check box for correct answer)</span></div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 1:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx" class="cbx">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx" class="checkbox" value="0" name="checkOption[]">
                                                                                <div class="flip">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option1" name="optionAnswer1" id="courseTitle" placeholder="Option 1 Answer" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option1" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>



                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 2:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx1" class="cbx1">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx1" class="checkbox" value="1" name="checkOption[]">
                                                                                <div class="flip1">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option2" name="optionAnswer2" id="courseTitle" placeholder="Option 2 Answer" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option2" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 3:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx2" class="cbx2">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx2" class="checkbox" value="2" name="checkOption[]">
                                                                                <div class="flip2">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option3" name="optionAnswer3" id="courseTitle" placeholder="Option 3 Answer" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option3" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 4:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx3" class="cbx3">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx3" class="checkbox checkbox4" value="3" name="checkOption[]">
                                                                                <div class="flip3">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option4" name="optionAnswer4" id="courseTitle" placeholder="Option 4 Answer" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option4" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>





                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="<?php echo $redirectLink; ?>"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                    <input type="submit" value="Save" name="saveQuiz" class="btn btn-primary">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="id09"  <?php echo "class='w3-modal ".$EditQuizBlock."'" ?>>
                                <div class="w3-modal-content">
                                    <div class="w3-container">


                                        <?php
                                            if($RedirectValue == null || $RedirectValue == '' || $RedirectValue == 'null')
                                            {
                                                $closeBtnQuizEdit = "window.location='createCurriculum.php?quizPackage=".$QuizPackIdToEdit." '   ";
                                            }
                                            else
                                            {
                                                $closeBtnQuizEdit = "window.location='createCurriculum.php?viewQuizId=".$RedirectValue."  ' ";

                                            }
                                        ?>

                                        <span onclick="<?php echo  $closeBtnQuizEdit ?>" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Edit Quiz</p>
                                        <p class="opacity-75 font-weight-bold primaryColor">Select the checkbox for the correct Answer.</p>
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                            <input type="hidden" name="redirectForViewQuiz" value="<?php echo $RedirectValue ?>">

                                                            <div class="col-md-12">
                                                                <div class="input-group">

                                                                    <label for="coursetitle">Question<span class="primaryColor">*</span></label>
                                                                    <input type="text" max-length="50" data-word-count="50;QuizQuestionEdit" name="quizQuestionEdit" id="courseTitle" placeholder="Name your Quiz Question" onkeyup="count_down(this)" value="<?php echo $quiz_question ?>" />
                                                                    <div class="badge_num" id="QuizQuestionEdit">50</div>



                                                                </div>
                                                                <input type="hidden" name="editQuizId" value ="<?php echo $quiz_id ?>">
                                                            </div>

                                                            <div><b class="h1FontSize">Options</b> <span class="text-muted primaryColor">(Please tick the check box for correct answer)</span></div>
                                                            <input type="hidden" id="correctCheckedBox" value="<?php echo $correct_option; ?>">
                                                            <input type="hidden" name="quizPackUniqueId" value="<?php echo $QuizPackIdToEdit; ?>">

                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 1:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbxEdit" class="cbxEdit">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbxEdit" class="checkboxEdit Checkbox1" value="0" name="checkOptionEdit[]"  <?php if($correct_option == "0") {echo "checked=checked";} ?>  >
                                                                                <div class="flipEdit">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option1Edit" name="optionAnswer1Edit" id="courseTitle" placeholder="Option 1 Answer" value="<?php echo $option1 ?>" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option1Edit" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>



                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 2:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx1Edit" class="cbx1Edit">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx1Edit" class="checkboxEdit" value="1" name="checkOptionEdit[]" <?php if($correct_option == "1") {echo "checked=checked";} ?> >
                                                                                <div class="flip1Edit">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option2Edit" name="optionAnswer2Edit" id="courseTitle" placeholder="Option 2 Answer" value="<?php echo $option2 ?>" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option2Edit" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>


                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 3:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx2Edit" class="cbx2Edit">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx2Edit" class="checkboxEdit" value="2" name="checkOptionEdit[]" <?php if($correct_option == "2") {echo "checked=checked";} ?> >
                                                                                <div class="flip2Edit">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option3Edit" name="optionAnswer3Edit" id="courseTitle" placeholder="Option 3 Answer" value="<?php echo $option3 ?>" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option3Edit" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <div class="col-md-12 mt-2">
                                                                <label for="coursetitle" class><b>Option 4:</b><span class="primaryColor">*</span></label>

                                                                <div class="d-flex">
                                                                    <div class="col-md-1">
                                                                        <label for="cbx3Edit" class="cbx3Edit">
                                                                            <div class="checkmark">
                                                                                <input type="checkbox" id="cbx3Edit" class="checkboxEdit" value="3" name="checkOptionEdit[]" <?php if($correct_option == "3") {echo "checked=checked";} ?> >
                                                                                <div class="flip3Edit">
                                                                                    <div class="front"></div>
                                                                                    <div class="back">
                                                                                        <svg viewBox="0 0 16 14" height="16" width="20">
                                                                                        <path d="M2 8.5L6 12.5L14 1.5"></path>
                                                                                        </svg>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col-md-11">
                                                                        <div class=" input-group mt-2">

                                                                            <input type="text" max-length="15" data-word-count="15;Option4Edit" name="optionAnswer4Edit" id="courseTitle" value="<?php echo $option4 ?>" placeholder="Option 4 Answer" onkeyup="count_down(this)"  />
                                                                            <div class="badge_num" id="Option4Edit" style="top:-30px;">15</div>

                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </div>





                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">

                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"   onclick="<?php echo  $closeBtnQuizEdit ?>" ><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                    <input type="submit" value="Save" name="saveQuizEdit" class="btn btn-primary">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div id="id10" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="<?php if($viewQuizPackId == 'null' || $viewQuizPackId == '' || $viewQuizPackId == null) {  echo "document.getElementById('id10').style.display='none'; document.getElementById('id08').style.display='block';"; } else {   echo " document.getElementById('id10').style.display='none'; document.getElementById('id13').style.display='block';"; } ?>" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Are you sure you want to delete this quiz?</p>
                                        <div class="container">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <button class="lectureButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center" name="yesDeleteQuiz"  style=" background-color: #28a745!important;">
                                                        Yes
                                                    </button>
                                                    <input type="hidden" id="yesDeleteQuizid" name="yesDeleteQuizid">
                                                    <input type="hidden" name="quizPackId" value="<?php echo $quizPackageId; ?>">
                                                </div>
                                                <div class="col d-flex justify-content-center align-items-center">
                
                                                    <div class="quizButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center " style=" background-color: #dc3545!important;" onclick="<?php if($viewQuizPackId == 'null' || $viewQuizPackId == '' || $viewQuizPackId == null) {  echo "document.getElementById('id10').style.display='none'; document.getElementById('id08').style.display='block';"; } else {   echo " document.getElementById('id10').style.display='none'; document.getElementById('id13').style.display='block';"; } ?>" >
                                                        No

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div id="id07"  class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="window.location.assign('createCurriculum.php');" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Quiz Package</p>
                                            <div class="modal-content">
                                                <div class="modal-body">


                                                            <div class="col-md-12">
                                                                <div class="input-group">

                                                                    <label for="coursetitle">Quiz Package Name<span class="primaryColor">*</span></label>
                                                                    <input type="text" max-length="50" data-word-count="50;QuizPackage" name="quizPackageName" id="courseTitle" placeholder="Quiz Package Name" onkeyup="count_down(this)"  />
                                                                    <div class="badge_num" id="QuizPackage">50</div>

                                                                </div>
                                                            </div>




                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="window.location.assign('createCurriculum.php');"><span class="glyphicon glyphicon-remove"></span> Close</button>
                                                    <input type="submit" value="Save" name="saveQuizPackage" class="btn btn-primary">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>



                            <div id="id08"  <?php echo "class='w3-modal ".$displayBlockQuiz."'" ?> >
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id11').style.display='block'; document.getElementById('id08').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Quiz</p>
                                            <div class="modal-content">
                                                <div class="modal-body">


                                                            <div class="col-md-12">
                                                                <div class="input-group" style="justify-content: space-between;">

                                                                        <label for="coursetitle" class="mr-3"><span>Quiz Package Name</span><span class="primaryColor font-weight-bold ml-30px"><?php echo $quizPackName ?></span></label>
                                                                        <button class="edit-button" type='button'>
                                                                            <i class="fa fa-edit"></i>
                                                                        </button>



                                                                </div>


                                                                    <button class="main-btn color btn-hover ml-left" type="button" onclick="document.getElementById('id06').style.display='block'; document.getElementById('id08').style.display='none';" style="background-color: var(--light-gradient); margin-bottom : 30px;">Add Quiz</button>


                                                            </div>

                                                            <?php

                                                                $CourseID = $arrCourse['course_id'];

                                                                $selectQuiz="SELECT * FROM coursequiz
                                                                                WHERE quizPackage_id='$quizPackageId'";
                                                                $runQuiz=mysqli_query($conn,$selectQuiz);
                                                                $countQuiz=mysqli_num_rows($runQuiz);



                                                                if ($countQuiz==0)
                                                                {
                                                                    echo "<p>There is no quiz to show </p>";
                                                                }
                                                                else
                                                                {
                                                                ?>


                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="mb-4 mt-3" style="overflow-x:auto;">
                                                                                <table id="example" class="display table table-striped table-responsive hover" style="width:100%">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>Item</th>
                                                                                            <th>Questions</th>
                                                                                            <th>Latest Date</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>

                                                                                        <?php

                                                                                            for ($i=0; $i < $countQuiz ; $i++) {
                                                                                                $arrSelectQuiz=mysqli_fetch_array($runQuiz);


                                                                                                $quizId = $arrSelectQuiz['quiz_id'];
                                                                                                $quizPackage_id = $arrSelectQuiz['quizPackage_id'];
                                                                                                $QuizQuestion = $arrSelectQuiz['quiz_question'];
                                                                                                $UpdateDate = $arrSelectQuiz['update_date'];


                                                                                                echo "<tr>";

                                                                                                echo  "<td>Quiz-". ($i + 1) ."</td>";
                                                                                                echo  "<td>$QuizQuestion</td>";
                                                                                                echo  "<td>$UpdateDate</td>";
                                                                                                echo  "<td class=\"d-flex justify-content-around\">

                                                                                                <button type='button' class=\"btn btn-primary m-1 mt-2\" style=\" background-color: #0d6efd!important;\"  name=\"editVideoBtn\" data-target-quizEdit='".$quizId."' data-target-quizEdit-packageId='".$quizPackage_id."' onclick='clickEditQuiz(this)' ><i class=\"fas fa-edit\"></i></button>
                                                                                                <button type='button' class=\"btn btn-danger m-1 mt-2\" style=\" background-color: #dc3545!important;\" name=\"deleteVideoBtn\" data-target-quizDelete='".$quizId."' onclick='clickDeleteQuiz(this)' ><i class=\"far fa-trash-alt\"></i></button>

                                                                                                ";



                                                                                                echo"</td>";




                                                                                                echo "</tr>";
                                                                                            }

                                                                                        ?>

                                                                                    </tbody>

                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                            <?php
                                                                }
                                                            ?>




                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.getElementById('id11').style.display='block'; document.getElementById('id08').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                                    <input type="submit" value="Save" name="saveWholeQuizPackage" class="btn btn-primary" onclick="window.location='createCurriculum.php'">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>


                            <div id="id11" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id11').style.display='none'; document.getElementById('id08').style.display='block'" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Are you sure you want to cancel creatinng quiz?</p>
                                        <p class="h1FontSize font-weight-bold">By clicking Yes, all of the quiz in this quiz packge will be discard!!</p>
                                        <div class="container">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <button class="lectureButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center" name="cancelQuizCreate"  style=" background-color: #28a745!important;">
                                                        Yes
                                                    </button>

                                                    <input type="hidden" name="quizPackId" value="<?php echo $quizPackageId; ?>">
                                                </div>
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <div class="quizButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center " style=" background-color: #dc3545!important;" onclick="document.getElementById('id11').style.display='none'; document.getElementById('id08').style.display='block'" >
                                                        No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- For deleting Quiz Package from display button -->
                            <div id="id12" class="w3-modal">
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="document.getElementById('id12').style.display='none';" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <p class="h1FontSize font-weight-bold">Are you sure you want to delete this quiz package?</p>

                                        <div class="container">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <button class="lectureButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center" name="quizPackageDelete"  style=" background-color: #28a745!important;">
                                                        Yes
                                                    </button>

                                                    <input type="hidden" name="deleteQuizPackageuniqueId" id="deleteQuizPackageuniqueId" >
                                                </div>
                                                <div class="col d-flex justify-content-center align-items-center">
                                                    <div class="quizButton square_shape w-50 p-3 rounded m-3 cursorPointer d-flex justify-content-center align-items-center " style=" background-color: #dc3545!important;" onclick="document.getElementById('id11').style.display='none'; document.getElementById('id08').style.display='block'" >
                                                        No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- viewQuizPack -->
                            <div id="id13"  <?php echo "class='w3-modal ".$viewQuizBlock."'" ?> >
                                <div class="w3-modal-content">
                                    <div class="w3-container">
                                        <span onclick="window.location.assign('createCurriculum.php');" class="w3-button w3-display-topright">&times;</span>
                                        <br>
                                        <div class="col-md-12">

                                            <input type="hidden" name="viewQuizId" value="<?php echo $viewQuizPackId; ?>">

                                            <div class="container" style=" display: grid; grid-template-columns: 45% 45% 10%;">
                                                <p class="h1FontSize font-weight-bold" ><b>Quiz Package Name - </b> </p>
                                                <span  style="white-space: nowrap; overflow-x: hidden;"><?php echo $quizPackage_name ?></span>
                                                <button class="edit-button" type='button'>
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>



                                            <button class="main-btn color btn-hover ml-left" type="button" onclick="document.getElementById('id06').style.display='block'; document.getElementById('id13').style.display='none';" style="background-color: var(--light-gradient); margin-bottom : 30px;">Add Quiz</button>


                                        </div>

                                            <div class="modal-content">
                                                <div class="modal-body">



                                                    <?php




                                                        $selectQuiz="SELECT * FROM coursequiz
                                                                            WHERE quizPackage_id='$viewQuizPackId'";
                                                        $runQuiz=mysqli_query($conn,$selectQuiz);
                                                        $countquizView=mysqli_num_rows($runQuiz);


                                                        if ($countquizView==0)
                                                        {
                                                            echo "<p>There is no quiz to show </p>";
                                                        }
                                                        else
                                                        {
                                                        ?>


                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="mb-4 mt-3" style="overflow-x:auto;">
                                                                        <table id="example" class="display table table-striped table-responsive hover" style="width:100%">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Item</th>
                                                                                    <th>Questions</th>
                                                                                    <th>Latest Date</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                                <?php

                                                                                    for ($i=0; $i < $countquizView ; $i++) {
                                                                                        $arrSelectQuiz=mysqli_fetch_array($runQuiz);


                                                                                        $quizId = $arrSelectQuiz['quiz_id'];
                                                                                        $quizPackage_id = $arrSelectQuiz['quizPackage_id'];
                                                                                        $QuizQuestion = $arrSelectQuiz['quiz_question'];
                                                                                        $UpdateDate = $arrSelectQuiz['update_date'];
                                                                                        $quizPackage_id = $arrSelectQuiz['quizPackage_id'];


                                                                                        echo "<tr>";

                                                                                        echo  "<td>Quiz-". ($i + 1) ."</td>";
                                                                                        echo  "<td>$QuizQuestion</td>";
                                                                                        echo  "<td>$UpdateDate</td>";
                                                                                        echo  "<td class=\"d-flex justify-content-around\">

                                                                                        <button type='button' class=\"btn btn-primary m-1 mt-2\" style=\" background-color: #0d6efd!important;\"  name=\"editVideoBtn\" data-target-quizEdit='".$quizId."' data-target-quizEdit-packageId='".$quizPackage_id."' data-target-quizEdit-redirect='".$quizPackage_id."' onclick='clickEditQuiz(this)' ><i class=\"fas fa-edit\"></i></button>
                                                                                        <button type='button' class=\"btn btn-danger m-1 mt-2\" style=\" background-color: #dc3545!important;\" name=\"deleteVideoBtn\" data-target-quizDelete='".$quizId."' data-target-quizDelete-redirect='".$quizPackage_id."' onclick='clickDeleteQuiz(this)' ><i class=\"far fa-trash-alt\"></i></button>

                                                                                        ";



                                                                                        echo"</td>";




                                                                                        echo "</tr>";
                                                                                    }

                                                                                ?>

                                                                            </tbody>

                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    <?php
                                                        }
                                                    ?>




                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="modal-footer mt-3 mb-3" style="justify-content: space-between;">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="document.getElementById('id11').style.display='block'; document.getElementById('id08').style.display='none'"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                                                    <input type="submit" value="Save" name="saveWholeQuizPackage" class="btn btn-primary" onclick="window.location='createCurriculum.php'">
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>





                            <div class="btns-group">
                                <!-- <a href="createNewCourse.php" class="btn btn-prev">Previous</a> -->
                               <input type="submit" name="nextBtn" class="btn" value="Next">

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

$(document).ready(function () {
    $('#example').DataTable({
        pagingType: 'full_numbers',
    });



});

</script>


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


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


function onClickDelete(obj) {

    document.getElementById('id04').style.display='block';
    const idToDelete = obj.getAttribute('data-target-delete');

    document.getElementById('yesDeleteValue').setAttribute("value", idToDelete);

}

function onClickEdit(obj) {

    const idToEdit = obj.getAttribute('data-target-edit');

    window.location.assign("createCurriculum.php?editVideo="+idToEdit);

}

function clickDeleteQuiz(obj) {


    const QuizidToDelete = obj.getAttribute('data-target-quizDelete');
    const redirectViewQuiz = obj.getAttribute('data-target-quizDelete-redirect');

    const combinedValueQuizDelete = QuizidToDelete +"&&"+redirectViewQuiz;

    if(redirectViewQuiz == null || redirectViewQuiz == '' || redirectViewQuiz == 'null')
    {
        document.getElementById('id10').style.display='block';
        document.getElementById('id08').style.display='none';
    }
    else
    {
        document.getElementById('id10').style.display='block';
        document.getElementById('id13').style.display='none';
    }

    document.getElementById('yesDeleteQuizid').setAttribute("value", combinedValueQuizDelete);

}

function clickEditQuiz(obj) {

    const editQuizId = obj.getAttribute('data-target-quizEdit');
    const editQuizIdPackage = obj.getAttribute('data-target-quizEdit-packageId');
    const redirectViewQuiz = obj.getAttribute('data-target-quizEdit-redirect');

    window.location.assign("createCurriculum.php?editQuizId="+editQuizId+"&QuizPackId="+editQuizIdPackage+"&Redirect="+redirectViewQuiz);


}
//Delete Quiz Pack from display button
function clickDeleteQuizPackage(obj) {

    document.getElementById('id12').style.display='block';

    const deleteQuizIdPackage = obj.getAttribute('data-target-deleteQuizPackage');

    document.getElementById('deleteQuizPackageuniqueId').setAttribute("value", deleteQuizIdPackage);

}

function clickEditQuizPackage(obj) {

    const editQuizId = obj.getAttribute('data-target-quizEdit');
    const editQuizIdPackage = obj.getAttribute('data-target-quizEdit-packageId');

    window.location.assign("createCurriculum.php?editQuizId="+editQuizId+"&QuizPackId="+editQuizIdPackage);


}

function clickViewQuizPackage(obj) {

    const viewQuizId = obj.getAttribute('data-target-viewQuizPackage');


    window.location.assign("createCurriculum.php?viewQuizId="+viewQuizId);


}



document.addEventListener("DOMContentLoaded", function() {
  const checkboxes = document.querySelectorAll(".checkbox");
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener("click", function() {
        checkboxes.forEach(function(cb) {
          if (cb !== checkbox)
          {
            cb.checked = false;
          }
      });
    });
  });
});

document.addEventListener("DOMContentLoaded", function() {
  const checkboxesEdit = document.querySelectorAll(".checkboxEdit");
    checkboxesEdit.forEach(function(checkboxEdit) {
      checkboxEdit.addEventListener("click", function() {
        checkboxesEdit.forEach(function(cbEdit) {
          if (cbEdit !== checkboxEdit)
          {
            cbEdit.checked = false;
          }
      });
    });
  });
});




</script>




</body>
</html>