<?php
include_once 'database.php';
header('Content-Type: application/json');


$notificationId = $_POST['notificationId'];

$sql = "UPDATE notifications SET read_status = 1 WHERE id = '$notificationId'";

if ($mysqli->query($sql) === TRUE) {
    echo json_encode(array("message" => "successfull", "status" => 200));
} else {
    echo json_encode(array("message" => "Error: " . $sql . "<br>" . $mysqli->error, "status" => 400));
}