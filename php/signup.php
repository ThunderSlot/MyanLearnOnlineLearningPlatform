<?php
    session_start();
    include_once "../config.php";
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $originalPassword = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($originalPassword);
    $originalConfirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $confirmPassword = md5($originalConfirmPassword);
    $checkCheckBox = isset($_POST['agreeCheck']);
    

    if(!empty($fullName) && !empty($email) && !empty($password) && !empty($confirmPassword) )
    {
        //check email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) //email is valid
        {
            //checking email already exist in database
            $sql = mysqli_query($conn, "Select email From users Where email = '{$email}' ");
            if(mysqli_num_rows($sql)>0) //if email already exist
            {
                echo "$email - This email already exists";              
            }
            elseif($password != $confirmPassword)
            {        
                echo "Confirm password must be the same with password.";
            }
            elseif (strlen($originalPassword) < 8)
            {
                echo  "Your Password Must Contain At Least 8 Characters!";
                
            }
            elseif(!preg_match("#[0-9]+#",$originalPassword)) {
                echo  "Your Password Must Contain At Least 1 Number!";
            }
            elseif(!preg_match("#[A-Z]+#",$originalPassword)) {
                echo  "Your Password Must Contain At Least 1 Capital Letter!";
            }
            elseif(!preg_match("#[a-z]+#",$originalPassword)) {
                echo  "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
            elseif($checkCheckBox != 1)
            {
                echo "Please agree to the Terms of Service and Privacy Policy!";
                
            }
            else{
                // checking users upload image file or not
                
                   
                        $time = time();
                       

                        
                          $status = "Active now";
                          $random_id = rand(time(), 1000000); //creating random id for user
                          
                          //inserting data
                          $sql2 = mysqli_query($conn, "Insert into users (unique_id, fullName, email, password, confirmPassword, status)
                                                Values ({$random_id}, '{$fullName}', '{$email}', '{$password}', '{$confirmPassword}', '{$status}' ) ");
                           if($sql2)
                           {
                                $sql3 = mysqli_query($conn, "Select * From users Where email = '{$email}' ");
                                if(mysqli_num_rows($sql3)>0)
                                {
                                    $row = mysqli_fetch_assoc($sql3);

                                    echo "success";

                                }
                           } 
                           else
                           {
                                echo "Something went wrong";
                           }
                          
                        
                       

                    

                
            }
        }
        else{
            echo ("$email Please enter a valid email!");
        }
    }
    else{
        echo "All input field are required!";
    }
?>