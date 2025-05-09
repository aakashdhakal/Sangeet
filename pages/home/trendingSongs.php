<?php
include_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/modules/database.php";
include_once realpath($_SERVER["DOCUMENT_ROOT"]) . "/modules/extraFunctions.php";
$sql = 'SELECT musics.id, musics.coverImage, musics.title, musics.artist, COUNT(music_history.music_id) as plays 
        FROM music_history
        INNER JOIN musics ON music_history.music_id = musics.id
        INNER JOIN users ON musics.artist = users.username
        GROUP BY musics.id, musics.coverImage, musics.title, musics.artist 
        ORDER BY plays DESC 
        LIMIT 5;';
$result = mysqli_query($mysqli, $sql);

if ($result instanceof mysqli_result) {
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $cover = $row['coverImage'];
            $title = $row['title'];
            $artist = getFullName($row['artist']);
            $musicId = $row['id'];
            $plays = $row['plays'];


            echo "
             <div class='song-list-wrapper'>
             <p class='song-number'>#" . $i++ . "</p>
            <div class='song-list'>
    <img src='/$cover' alt=' srcset='>
    <button class='start-play-music' data-musicId='$musicId'><iconify-icon icon='gravity-ui:play-fill'></iconify-icon></button>
    <div class='song-info'>
        <p class='music-title'>$title</p>
        <p class='artist-name'>$artist</p>
    </div>
    <div class='song-options btn-container'>
        <button class='add-to-playlist-btn' title='Add to Playlist' data-musicId='$musicId'>
            <iconify-icon icon='tabler:playlist-add'></iconify-icon></button>
</div>
    </div>
</div>
            ";
        }
    } else {
        echo '<h1>No Trending Songs</h1>';
    }
} else {
    echo 'Error: ' . mysqli_error($mysqli);
}