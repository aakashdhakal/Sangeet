<?php
require_once APP_PATH . '/modules/database.php';
require_once APP_PATH . '/modules/extraFunctions.php';
$sql = "SELECT music_history.music_id, musics.*, MAX(music_history.id) as max_id
        FROM music_history 
        INNER JOIN musics ON music_history.music_id = musics.id 
        WHERE user_id = ? 
        GROUP BY music_history.music_id
        ORDER BY max_id DESC 
        LIMIT 13";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    return;
} else {
    echo "
     <div class='recently-played-songs songs-container'>
            <h2 class='section-title'> <iconify-icon icon='akar-icons:history'></iconify-icon>Recently Played
            </h2>
            <button id='prevInContainer'><iconify-icon icon='cuida:caret-left-outline'></iconify-icon></button>
            <div class='recent-songs-container song-card-container'>
                <div class='song-card-wrapper'>
              
    ";
    while ($row = $result->fetch_assoc()) {
        $cover = $row['coverImage'];
        $title = $row['title'];
        $artist = getFullName($row['artist']);
        $musicId = $row['music_id'];
        echo "
                        <div class='song-card' title='$title - $artist'>
                            <img src='" . get_url($cover) . "' alt='' srcset=''>
                            <button class='start-play-music' data-musicId='$musicId'><iconify-icon
                                    icon='gravity-ui:play-fill'></iconify-icon></button>
                            <div class='song-info'>
                                <p class='music-title'>$title</p>
                            </div>
                        </div>
        ";
    }
    echo " </div>
                </div>
                <button id='nextInContainer'><iconify-icon icon='cuida:caret-right-outline'></iconify-icon></button>
                </div>";
}