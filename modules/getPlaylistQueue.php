<?php
include_once 'database.php';
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    if (isset($_POST["playlistId"])) {
        $playlistId = $_POST["playlistId"];
        $sql = "SELECT music_id from playlist_songs where playlist_id = ? and music_id != ? ORDER BY id DESC";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ii", $playlistId, $id);
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