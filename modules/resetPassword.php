<?php
include_once "database.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $sql = "UPDATE TABLE users SET password = ? WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $password, $email);
    if ($stmt->execute()) {

        echo json_encode(["message" => "Password Changed Successfully", "status" => 200]);
    } else {
        echo json_encode(["message" => "Error changing password", "status" => 400]);

    }
} else {
    echo json_encode(["message" => "Invalid Request", "status" => 401]);

}
