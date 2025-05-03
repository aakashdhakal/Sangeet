<?php
require_once __DIR__ . '/../../modules/database.php';
require_once __DIR__ . '/../../modules/extraFunctions.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: /404');
}
$userId = $_SESSION['user_id'];
$sql = 'SELECT * FROM favourite_songs
        INNER JOIN musics ON favourite_songs.song_id = musics.id
        WHERE user_id = ?
        ORDER BY favourite_songs.id DESC';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
?>
<section id="playlistPageContainer">
    <div class="right">
        <div class="song-list-container">
            <?php
            $i = 1;
            $totalTime = 0;
            while ($row = $result->fetch_assoc()) {
                $cover = $row['coverImage'];
                $title = $row['title'];
                $artist = getFullName($row['artist']);
                $musicId = $row['song_id'];
                $filePath = $row['filePath'];
                $totalTime += $row['duration'];

                echo "
                <div class='song-list-wrapper'>
                    <p class='song-number'>#" . $i++ . "</p>
                    <div class='song-list'>
                        <img src='$cover' alt=' srcset='>
                        <button class='start-play-music' data-musicId='$musicId' data-filePath='$filePath' data-favourites'true'><iconify-icon icon='gravity-ui:play-fill'></iconify-icon></button>
                        <div class='song-info'>
                            <p class='music-title'>$title</p>
                            <p class='artist-name'>$artist</p>
                        </div>
                        <div class='song-options btn-container'>
                            <button class='like-btn remove-from-favourites-btn' title='Remove From Favourites' data-musicId='$musicId' data-liked='1'>
                                <iconify-icon icon='oui:cross-in-circle-empty'></iconify-icon>
                            </button>
                        </div>
                    </div>
                </div>
                ";
            }
            $totalDuration = formatTime($totalTime);
            ?>
        </div>
    </div>
    <div class="left">
        <div class="playlist-info">
            <img src=" /public/images/liked.jpg" alt="Playlist Cover" class="playlist-cover">
            <div class="songs-duration-creator">
                <div class="playlist-creator">
                    <img src=" <?php echo $_SESSION["user_image"] ?>" alt="Profile Picture">
                    <p class="username"><?php echo getFullName($_SESSION['username']) ?></p>
                </div>
                <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                <p class="total-songs"><?php echo $result->num_rows ?> Songs</p>
                <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                <div class="total-duration">
                    <?php
                    echo "About ";
                    if ($totalDuration['hrs'] > 0) {
                        echo "$totalDuration[hrs] hr ";
                    }
                    echo "$totalDuration[mins] min $totalDuration[secs] sec";
                    ?>
                </div>
            </div>
            <div class="playlist-details">
                <p class="playlist-name">Liked Songs</p>
                <p class="playlist-description">
                    All your favourite songs in one place
                </p>

            </div>
            <div class="btn-container">
                <button class="start-playing-playlist secondary-btn">
                    Play All
                </button>
            </div>
        </div>
    </div>
</section>