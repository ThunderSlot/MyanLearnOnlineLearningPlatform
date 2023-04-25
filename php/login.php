<?php

    session_start();
    include_once "../config.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $originalPassword = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($originalPassword);

    // echo "login form";
    if(!empty($email) && !empty($password))
    {

        $sql = mysqli_query($conn, "Select * From users Where email = '{$email}' And password = '{$password}' ");
        if(mysqli_num_rows($sql) > 0)
        {
            $row = mysqli_fetch_assoc($sql);
            $status = "Active now";
            $sql2 = mysqli_query($conn, "Update users set status = '{$status}' Where unique_id = {$row['unique_id']} ");
            if($sql2)
            {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            }

           
        }
        else{
            echo "Email or Password is incorrect!";
        }
    }
    else{
        echo "ALl the input fields are required!";
    }

?>