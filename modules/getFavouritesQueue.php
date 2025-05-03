<?php
include_once 'database.php';
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = 'SELECT song_id FROM favourite_songs WHERE user_id = ?;';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $songs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $songs[] = $row;
    }
    echo json_encode($songs);
} else {
    echo json_encode(["error" => "Invalid request method"]);
}