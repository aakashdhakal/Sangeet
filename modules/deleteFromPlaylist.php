<?php
include_once 'database.php';
include_once 'extraFunctions.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $playlist_id = $_POST['playlistId'];
    $song_id = $_POST['musicId'];
    if (!checkSongInPlaylist($playlist_id, $song_id)) {
        echo json_encode(['status' => 'error', 'code' => 403]);
    } else {
        $sql = "DELETE FROM playlist_songs WHERE playlist_id = ? AND music_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $playlist_id, $song_id);
        $stmt->execute();
        if ($stmt->affected_rows === 0) {
            echo json_encode(['status' => 'error', 'code' => 500]);
            exit();
        } else {
            echo json_encode(['status' => 200]);
        }
    }
}