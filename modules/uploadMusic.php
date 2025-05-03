<?php
include_once "database.php";
include_once "extraFunctions.php";
header('Content-Type: application/json');

//upload music in database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $artist = $_SESSION['username'];
    $language = $_POST['language'];
    $isPublic = $_POST['visibility'];
    $description = $_POST['description'];
    $releaseDate = date('Y-m-d');
    $userId = $_SESSION['user_id'];
    $duration = $_POST['duration'];


    if (isset($_FILES["musicFile"]) && $_FILES["musicFile"]["error"] == 0) {
        $song = $_FILES["musicFile"];
        $fileName = createSlug($title) . "-music." . strtolower(pathinfo($song["name"], PATHINFO_EXTENSION));
        $songFilePath = uploadFile($song, 'music', $fileName);
    }


    if (isset($_FILES["coverImage"]) && $_FILES["coverImage"]["error"] == 0) {
        $songCover = $_FILES["coverImage"];
        $fileName = createSlug($title) . "-cover." . strtolower(pathinfo($songCover["name"], PATHINFO_EXTENSION));
        $songCoverFilePath = uploadFile($songCover, 'song_cover', $fileName);
    } else {
        $songCoverFilePath = 'public/images/song-cover/music.jpg';
    }

    if (isset($_FILES["lyricsFile"]) && $_FILES["lyricsFile"]["error"] == 0) {
        $songCover = $_FILES["lyricsFile"];
        $fileName = createSlug($title) . "-lyrics." . strtolower(pathinfo($songCover["name"], PATHINFO_EXTENSION));
        $songCoverFilePath = uploadFile($songCover, 'song_lyrics', $fileName);
    }

    $sql = "INSERT INTO musics (title, artist, genre, duration, releaseDate,filePath,coverImage,lyricsPath,isPublic,language,description) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssssssssss', $title, $artist, $genre, $duration, $releaseDate, $songFilePath, $songCoverFilePath, $lyricsPath, $isPublic, $language, $description);
    $stmt->execute();
    if ($stmt->affected_rows == 1) {
        echo json_encode(['status' => 200, 'message' => 'Music uploaded successfully.']);
    } else {
        echo json_encode(['status' => 400, 'message' => 'Failed to upload music.']);
    }
    $stmt->close();

}

