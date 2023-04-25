<?php
    $conn = mysqli_connect("localhost", "root", "", "online_learning_platform");
    if (!$conn) {
        echo "Database not connected" . mysqli_connect_error();
        // echo "<script>document.querySelector('body').style.display = none;</script>";
    }
?>