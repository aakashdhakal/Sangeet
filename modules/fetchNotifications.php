<?php
include_once 'database.php';
include_once 'extraFunctions.php';
header('Content-Type: application/json');


$userId = $_SESSION['user_id'];



$sql = "SELECT * FROM notifications WHERE receiver_id = $userId ORDER BY time DESC";

$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notification[] = $row;
    }
    if ($notification) {
        echo json_encode($notification);
    }
} else {
    echo json_encode(array("message" => "No notifications found", "status" => 404));
}
