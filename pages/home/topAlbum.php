<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/extraFunctions.php';
$sql = 'SELECT * from musics WHERE artist = ? ORDER BY id DESC LIMIT 5';
$stmt = $mysqli->prepare($sql);
$artist = 'sushantkc';
$stmt->bind_param('s', $artist);
$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    echo "
       <div class='playlist-image'>
                        <img src='/public/images/profile-pics/sushantkc.jpg' alt=''>
                    </div>
                    <div class='playlist-info'>
                        <div class='title-artist'>
                            <p class='playlist-title'>Sushant K.C Collection</p>
                            <p class='artist-name'>" . getFullName($artist) . "<iconify-icon icon='mdi:dot'></iconify-icon> <span
                                    class='no-of-songs'>" . mysqli_num_rows($result) . " tracks</span></p>
                        </div>
                        <div class='btn-container'>
                            <button class='save-playlist-btn secondary-btn'>
                                <iconify-icon icon='tabler:playlist-add'></iconify-icon>
                            </button>
                        </div>
                    </div>
                    <div class='song-list-container'>
                    ";
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $cover = $row['coverImage'];
            $title = $row['title'];
            $artist = getFullName($row['artist']);
            $musicId = $row['id'];
            $duration = $row['duration'];
            //convert seconds to m:s format
            $duration = gmdate("i:s", $duration);



            echo "
            <div class='song-list start-play-music' data-musicId='$musicId'>
                <p class='song-number'>" . $i++ . ".</p>
                <div class='song-info'>
                    <p class='music-title'>$title</p>
                    <p class='artist-name'>$artist</p>
                </div>
                <p class='song-duration'>$duration</p>
            </div>";
        }
        echo "</div>";
    } else {
        echo '<h1>No Trending Songs</h1>';
    }
} else {
    echo 'Error: ' . mysqli_error($mysqli);
}