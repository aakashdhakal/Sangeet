<?php
include_once "database.php";
include_once "extraFunctions.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $profilePicture = $_FILES['profile_pic']['name'];
    $gender = $_POST['gender'];

    //if profilepicture is empty use default profile picture
    if (empty($profilePicture)) {
        $profilePicture = "public/images/profile-pics/default.jpg";
    } else {
        $profilePicture = createSlug($username) . "-profile-pic." . pathinfo($profilePicture, PATHINFO_EXTENSION);
        $profilePicture = uploadFile($_FILES['profile_pic'], 'profile_pic', $profilePicture);
    }

    $sql = "INSERT INTO users (username, email, password, firstName, lastName, dob,profile_picture,gender) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssssss", $username, $email, $password, $firstName, $lastName, $dob, $profilePicture, $gender);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(["message" => "User registered successfully", "status" => 200]);
    } else {
        echo json_encode(["message" => "Failed to register user", "status" => 500]);
    }
} else {
    echo json_encode(["message" => "Invalid Request", "status" => 400]);
}