<?php
require_once __DIR__ . '/../../modules/database.php';
require_once __DIR__ . '/../../modules/extraFunctions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /404');
}

$playlistId = $id;
$sql = 'SELECT playlists.id,
        playlists.name,
        playlists.description,
        playlists.cover,
        playlists.isPublic,
        playlists.user_id,
        musics.id AS music_id,
        musics.coverImage,
        musics.title,
        musics.artist,
        musics.duration,
        musics.filePath,
        users.username,
        users.profile_picture
        FROM playlists
        LEFT JOIN playlist_songs ON playlists.id = playlist_songs.playlist_id
        LEFT JOIN musics ON playlist_songs.music_id = musics.id
        INNER JOIN users ON playlists.user_id = users.id
        WHERE playlists.id = ?
        ORDER BY playlist_songs.id DESC';
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('i', $playlistId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $playlist = $result->fetch_assoc();
    if (!$playlist['isPublic'] && $playlist['user_id'] != $_SESSION['user_id']) {
        header('Location: /404');
        exit();
    }
} else {
    // Handle case where playlist is not found
    header('Location: /404');
    exit();
}

// Count the number of non-null music_id values
$songCount = 0;
$result->data_seek(0);
while ($row = $result->fetch_assoc()) {
    if ($row['music_id'] !== null) {
        $songCount++;
    }
}
?>
<section id="playlistPageContainer">
    <div class="right">
        <div class="song-list-container">
            <?php
            $i = 1;
            $totalTime = 0;
            $result->data_seek(0);
            if ($songCount > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['music_id'] !== null) {
                        $cover = $row['coverImage'];
                        $title = $row['title'];
                        $artist = getFullName($row['artist']);
                        $musicId = $row['music_id'];
                        $duration = formatDuration($row['duration']);
                        $filePath = $row['filePath'];
                        $totalTime += $row['duration'];
                        $playlistId = $row['id'];

                        echo "
                        <div class='song-list-wrapper'>
                            <p class='song-number'>#" . $i++ . "</p>
                            <div class='song-list'>
                                <img src='$cover' alt='' srcset=''>
                                <button class='start-play-music' data-musicId='$musicId' data-filePath='$filePath' data-playlistId='$playlistId'><iconify-icon icon='gravity-ui:play-fill'></iconify-icon></button>
                                <div class='song-info'>
                                    <p class='music-title'>$title</p>
                                    <p class='artist-name'>$artist</p>
                                </div>
                                <div class='song-options btn-container'>
                                    <button class='delete-from-playlist-btn' title='Remove From Playlist' data-musicid='$musicId' data-playlistid='$playlistId'>
                                        <iconify-icon icon='oui:cross-in-circle-empty'></iconify-icon>
                                    </button>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }
            } else {
                echo "<p class='no-songs'>This playlist is empty.</p>";
            }
            $totalDuration = formatTime($totalTime);
            ?>
        </div>
    </div>
    <div class="left">
        <div class="playlist-info">
            <img src=" <?php echo $playlist['cover'] ?>" alt="Playlist Cover" class="playlist-cover">
            <div class="songs-duration-creator">
                <div class="playlist-creator">
                    <img src=" <?php echo $playlist['profile_picture'] ?>" alt="Profile Picture">
                    <p class="username"><?php echo getFullName($playlist['username']) ?></p>
                </div>
                <iconify-icon icon="radix-icons:dot-filled"></iconify-icon>
                <p class="total-songs"><?php echo $songCount ?> Songs</p>
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
                <p class="playlist-name"><?php echo $playlist['name'] ?></p>
                <p class="playlist-description"><?php echo $playlist['description'] ?></p>
            </div>
            <div class="btn-container">
                <button class="start-playing-playlist secondary-btn">
                    Play All
                </button>
            </div>
        </div>
    </div>
</section>