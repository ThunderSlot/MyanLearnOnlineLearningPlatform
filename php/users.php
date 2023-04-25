<?php
session_start();
include_once "../config.php";
$outgoing_id = $_SESSION['unique_id'];

$sql = "SELECT * FROM purchasedetail WHERE user_unique_id = {$outgoing_id} || instructor_unique_id = {$outgoing_id} GROUP BY instructor_unique_id ORDER BY purchase_time DESC";
$query = mysqli_query($conn, $sql);
$output = "";
$output1 = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "No users are available to chat";
    $output1 .= "No users are available to chat";
} elseif (mysqli_num_rows($query) > 0) {

    while ($row = mysqli_fetch_assoc($query)) {


        $selectInstructor = "SELECT * from users WHERE unique_id = {$row['instructor_unique_id']}";
        $queryInstructor = mysqli_query($conn, $selectInstructor);
        $rowInstructor = mysqli_fetch_assoc($queryInstructor);

        $selectUser = "SELECT * from users WHERE unique_id = {$row['user_unique_id']}";
        $queryUser = mysqli_query($conn, $selectUser);
        $rowUser = mysqli_fetch_assoc($queryUser);

        // if outgoingid == instructor id 
        // then i am a teacher so the message is by student
        // or else i am not a teacher


        if ($outgoing_id == $row['instructor_unique_id']) {

            $linkUniqueId = $row['user_unique_id'];
            $imgToShow = $rowUser['image'];
            $nameToShow = $rowUser['fullName'];

            $sql2 = "SELECT * FROM messages
                     WHERE (incoming_msg_id = {$row['user_unique_id']} OR outgoing_msg_id = {$row['user_unique_id']}) 
                      AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
                      ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

            if (isset($row2['outgoing_msg_id'])) {
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            } else {
                $you = "";
            }

            ($rowUser['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $rowUser['unique_id']) ? $hid_me = "hide" : $hid_me = "";
        } else {

            $linkUniqueId = $row['instructor_unique_id'];
            $imgToShow = $rowInstructor['image'];
            $nameToShow = $rowInstructor['fullName'];

            $sql2 = "SELECT * FROM messages 
                    WHERE 
                    (incoming_msg_id = {$row['instructor_unique_id']} OR outgoing_msg_id = {$row['instructor_unique_id']}) 
                    AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id})
                    ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;

            if (isset($row2['outgoing_msg_id'])) {
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            } else {
                $you = "";
            }

            ($rowInstructor['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $rowInstructor['unique_id']) ? $hid_me = "hide" : $hid_me = "";
        }






        $output .= '<a href="users1.php?user_id=' . $linkUniqueId . '">
                        <div class="content">
                        <img src=' . $imgToShow . ' alt="">
                        <div class="details">
                            <span>' . $nameToShow . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';

        $output1 .= '<a href="chat.php?user_id=' . $linkUniqueId . '">
                        <div class="content">
                        <img src=' . $imgToShow . ' alt="">
                        <div class="details">
                            <span>' . $nameToShow . '</span>
                            <p>' . $you . $msg . '</p>
                        </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
    }
}

echo json_encode(array("output" => $output, "output1" => $output1));
