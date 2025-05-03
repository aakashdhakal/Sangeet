<?php
include_once 'database.php';
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sql = 'SELECT musics.id ,COUNT(music_history.music_id) as plays 
        FROM music_history
        INNER JOIN musics ON music_history.music_id = musics.id
        INNER JOIN users ON musics.artist = users.username
        GROUP BY musics.id
        AND musics.id != ?
        ORDER BY plays DESC;';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
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