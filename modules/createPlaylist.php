<?php
include_once 'database.php';
include_once 'extraFunctions.php';
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $playlistName = $_POST['playlistName'];
    $playlistDescription = $_POST['playlistDescription'];
    $playlistVisibility = $_POST['visibility'];
    $userId = $_SESSION['user_id'];
    $creationDate = date('Y-m-d');

    // Convert to absolute path using the document root
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/public/images/playlist-cover/";
    $webPath = "/public/images/playlist-cover/"; // Path for web access

    if (isset($_FILES["playlistCover"]) && $_FILES["playlistCover"]["error"] == 0) {
        $playlistCover = $_FILES["playlistCover"];
        $fileName = $userId . "-" . $playlistName . rand(1000, 1000000) . "." . strtolower(pathinfo($playlistCover["name"], PATHINFO_EXTENSION));
        $webFilePath = uploadFile($playlistCover, 'playlist_cover', $fileName);
    } else {
        // Default cover path for web access
        $webFilePath = $webPath . "playlist-cover.png";
    }
    $sql = "INSERT INTO playlists (name, user_id, cover,description,isPublic,creation_date) VALUES (?, ?, ?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sissss', $playlistName, $userId, $webFilePath, $playlistDescription, $playlistVisibility, $creationDate); // Use web accessible path
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(['status' => 200, 'message' => 'Playlist created successfully', 'playlistId' => $mysqli->insert_id]);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to create playlist']);
    }
}