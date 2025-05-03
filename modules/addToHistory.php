<?php
// add music to history
include_once 'database.php';
include_once 'extraFunctions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $musicId = $_POST['musicId'];
        $sql = "INSERT INTO music_history (user_id, music_id) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $userId, $musicId);
        $stmt->execute();
        incrementPlays($musicId);
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $mysqli->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    }
}

