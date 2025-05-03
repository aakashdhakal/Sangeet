<?php

include_once 'database.php';
include_once 'extraFunctions.php';
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        echo json_encode(["message" => "Username already exists", "status" => 409]);
    } else {
        echo json_encode(["message" => "Username available", "status" => 200]);
    }
} else {
    echo json_encode(["message" => "Invalid Request", "status" => 400]);
}