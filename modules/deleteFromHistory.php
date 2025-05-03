<?php
// add music to history
include_once 'database.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $musicId = $_POST['musicId'];
        $sql = "DELETE FROM music_history WHERE user_id = ? AND music_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $userId, $musicId);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 'error', 'message' => $mysqli->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    }
}

