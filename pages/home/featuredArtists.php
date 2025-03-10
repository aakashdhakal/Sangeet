<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/extraFunctions.php';
$sql = "SELECT * from users where is_artist = 1 ORDER BY id DESC LIMIT 13";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $cover = $row['profile_picture'];
    $title = $row['username'];
    $artist = getFullName($row['username']);
    $musicId = $row['id'];

    echo "
                        <div class='song-card artist-card' title='$artist'>
                            <img src='$cover' alt='' srcset=''>
                            <div class='song-info'>
                                <p class='music-title'>$artist</p>
                            </div>
                        </div>
        ";
}