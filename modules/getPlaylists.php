<?php
require 'database.php';
require 'extraFunctions.php';


$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM playlists WHERE user_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$playlistList = [];
while ($row = $result->fetch_assoc()) {
    $row['song_count'] = getPlaylistSongsCount($row['id']);
    $row['cover'] = get_url($row['cover']);
    $playlistList[] = $row;
}
echo json_encode($playlistList);