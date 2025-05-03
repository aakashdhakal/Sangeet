<?php
header('Content-Type: application/json');

if (isset($_SESSION["user_id"])) {
    echo json_encode(['status' => 200, 'message' => 'User is logged in', 'user_id' => $_SESSION["user_id"], 'username' => $_SESSION["username"], "name" => $_SESSION["user_name"]]);
} else {
    echo json_encode(['status' => 401, 'message' => 'User is not logged in']);
}