<?php

include_once "database.php";
include_once "extraFunctions.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $playlistId = $_POST['playlistId'];
    //get playlist info with songs
    $sql = "SELECT playlists.id AS playlist_id, playlists.name, playlists.description, 
                   musics.id AS music_id, musics.title, musics.artist, musics.duration, musics.filePath
            FROM playlists 
            LEFT JOIN playlist_songs ON playlists.id = playlist_songs.playlist_id
            LEFT JOIN musics ON playlist_songs.music_id = musics.id
            WHERE playlists.id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $playlistId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $playlist = array();
        while ($row = $result->fetch_assoc()) {
            if (empty($playlist)) {
                $playlist['id'] = $row['playlist_id'];
                $playlist['name'] = $row['name'];
                $playlist['description'] = $row['description'];
                $playlist['songs'] = [];
            }
            if ($row['music_id'] !== null) {
                $playlist['songs'][] = [
                    'id' => $row['music_id'],
                    'name' => $row['title'],
                    'artist' => $row['artist'],
                    'duration' => $row['duration'],
                    'url' => $row['filePath']
                ];
            }
        }
        echo json_encode($playlist);
    } else {
        echo json_encode(['error' => 'No playlist found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}