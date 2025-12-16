<?php
require_once APP_PATH . '/modules/database.php';
require_once APP_PATH . '/modules/extraFunctions.php';
$sql = "SELECT * FROM musics ORDER BY id DESC LIMIT 13";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $cover = $row['coverImage'];
    $title = $row['title'];
    $artist = getFullName($row['artist']);
    $musicId = $row['id'];
    echo "
                        <div class='song-card' title='$title - $artist'>
                            <img src='" . get_url($cover) . "' alt='' srcset='' loading='lazy'>
                            <button class='start-play-music' data-musicId='$musicId'><iconify-icon
                                    icon='gravity-ui:play-fill'></iconify-icon></button>
                            <div class='song-info'>
                                <p class='music-title'>$title</p>
                            </div>
                        </div>
        ";
}