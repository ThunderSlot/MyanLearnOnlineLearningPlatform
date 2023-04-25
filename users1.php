<?php
include_once "config.php";

?>
<?php include_once "header.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/chatstyle.css">
    <link rel="stylesheet" href="assets/css/app.css">


</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-4" style="padding: 0px;">
                <!-- left column for users list -->

                <nav>
                    <div class="wrapper">
                        <section class="users">
                            <header>
                                <div class="content">
                                    <?php
                                    
                                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                                    if (mysqli_num_rows($sql) > 0) {
                                        $row = mysqli_fetch_assoc($sql);
                                    }
                                    ?>
                                    <img src="<?php echo $row['image']; ?>" alt="">
                                    <div class="details">
                                        <span><?php echo $row['fullName'] ?></span>
                                        <p><?php echo $row['status']; ?></p>
                                    </div>
                                </div>
                            </header>
                            <div class="search" style="width: 80%;">
                                <span class="text">Select an user to start chat</span>
                                <input type="text" class="searchChatUser" placeholder="Enter name to search...">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                            <div class="users-list">

                            </div>
                            <div class="users-list1">

                            </div>
                        </section>
                    </div>
                </nav>

            </div>
            <div class="col-md-8 chatpanel" style="padding: 0px;">
                <div class="wrapper" style="max-width: 100%;">
                    <section class="chat-area">
                        <?php
                        if (!isset($_GET['user_id'])) {
                        ?>

                            <div class="container-box">
                                <p style="color:white!important;">Please Select a chat to start messaging</p>
                            </div>


                        <?php
                        } else { ?>

                            <header>
                                <?php
                                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                                if (mysqli_num_rows($sql) > 0) {
                                    $row = mysqli_fetch_assoc($sql);
                                } else {
                                    header("location: users1.php");
                                }
                                ?>
                                <a href="users1.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                                <img src="<?php echo $row['image']; ?>" alt="">
                                <div class="details">
                                    <span><?php echo $row['fullName']?></span>
                                    <p><?php echo $row['status']; ?></p>
                                </div>
                            </header>
                            <div class="chat-box">

                            </div>
                            <form action="users1.php" class="typing-area">
                                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                                <button><i class="fab fa-telegram-plane"></i></button>
                            </form>

                        <?php

                        }

                        ?>
                    </section>
                </div>
            </div>
        </div>
    </div>


    <script src="javascript/users.js"></script>
  <script src="javascript/chat.js"></script>




</body>

</html>