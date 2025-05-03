<?php
include_once 'database.php';
header('Content-Type: application/json');

//fetch random music queue
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $sql = "SELECT id FROM musics WHERE id != ? ORDER BY RAND()";
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