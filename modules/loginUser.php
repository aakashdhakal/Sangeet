<?php
include_once "database.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username = ?  AND password = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_name"] = $row["firstname"] . " " . $row["lastname"];
        $_SESSION["user_email"] = $row["email"];
        $_SESSION["user_image"] = $row["profile_picture"];
        $_SESSION["username"] = $row["username"];
        echo json_encode(["message" => "Logged in successfully", "status" => 200]);
    } else {
        echo json_encode(["message" => "Invalid username or password", "status" => 400]);

    }
} else {
    echo json_encode(["message" => "Invalid Request", "status" => 401]);

}
