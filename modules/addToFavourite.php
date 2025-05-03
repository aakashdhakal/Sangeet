<?php
include_once 'database.php';
include_once 'extraFunctions.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $musicId = $_POST['musicId'];
        $action = $_POST['action'];

        if ($action == 'check' && isFavourites($musicId)) {
            echo json_encode(['status' => 200, 'message' => 'Music already in favourites']);
        } else if ($action == 'check' && !isFavourites($musicId)) {
            echo json_encode(['status' => 201, 'message' => 'Music not in favourites']);
        } else {

            $message;
            $status;

            // Correct the logic for checking if the music is already in favourites
            if (!isFavourites($musicId)) {
                global $message;
                $sql = "INSERT INTO favourite_songs (user_id, song_id) VALUES (?, ?)";
                $message = "Music added to favourites";
                $status = 200;
            } else {
                global $message;
                $sql = "DELETE FROM favourite_songs WHERE user_id = ? AND song_id = ?";
                $message = "Music removed from favourites";
                $status = 200;
            }

            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('ii', $userId, $musicId);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                global $message;

                echo json_encode(['status' => $status, 'message' => $message]);
            } else {
                global $message;

                echo json_encode(['status' => 400, 'message' => $mysqli->error]);
            }
        }
    } else {
        echo json_encode(['status' => 401, 'message' => 'User not logged in']);
    }
} else {
    echo json_encode(['status' => 500, 'message' => 'Invalid Request']);
}