<?php

include_once 'database.php';
include_once 'extraFunctions.php';
header('Content-Type: application/json');


$userId = $_SESSION['user_id'];
$notificationId = $_POST['notificationId'];

$sql = "DELETE FROM notifications WHERE receiver_id = $userId AND id = $notificationId";

if ($mysqli->query($sql)) {
    echo json_encode(array("message" => "Notification deleted successfully", "status" => 200));
} else {
    echo json_encode(array("message" => "Failed to delete notification", "status" => 404));
}
