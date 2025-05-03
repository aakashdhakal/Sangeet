<?php

include_once 'database.php';
include_once 'extraFunctions.php';
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(["message" => "Username already exists", "status" => 409]);
    } else {
        echo json_encode(["message" => "Username available", "status" => 200]);
    }
} else {
    echo json_encode(["message" => "Invalid Request", "status" => 400]);
}