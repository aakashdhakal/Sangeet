<?php
include_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["playlistId"])) {
        $playlistId = $_POST["playlistId"];
        $sql = "SELECT music_id from playlist_songs where playlist_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $playlistId);
        $stmt->execute();
        $result = $stmt->get_result();
        $songs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $songs[] = $row;
        }
        echo json_encode($songs);
    } else {
        echo json_encode(["error" => "No playlist id provided"]);
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}