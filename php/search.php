<?php
session_start();
include('../config.php');

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} AND (fullName LIKE '%{$searchTerm}%') ";
$output = "";
$output1 = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
  while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result = "No message available";
    (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
      ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
      $you = "";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";

    $output .= '<a href="users1.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src=' . $row['image'] . ' alt="">
                    <div class="details">
                        <span>' . $row['fullName'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';

    $output1 .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                    <div class="content">
                    <img src=' . $row['image'] . ' alt="">
                    <div class="details">
                        <span>' . $row['fullName'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
  }
} else {
  $output .= 'No user found related to your search term';
  $output1 .= 'No user found related to your search term';
}
echo json_encode(array("output"=>$output, "output1"=>$output1));

