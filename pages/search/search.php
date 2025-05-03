<?php
require_once __DIR__ . '/../../modules/database.php';
require_once __DIR__ . '/../../modules/extraFunctions.php';

function searchDatabase($mysqli, $sql, $params, $types)
{
    $stmt = $mysqli->prepare($sql);
    if ($stmt) {
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt->get_result();
    } else {
        echo "Failed to prepare statement";
        return false;
    }
}

if (isset($tag)) {
    $tag = str_replace("%20", " ", $tag);
    $searchTerm = "%" . $tag . "%";
    $isResultFound = false;
    echo "
    <div class='search-result-container songs-container'>
    ";

    // Search for musics
    $musicSql = "SELECT * FROM musics WHERE title LIKE ? OR artist LIKE ?";
    $musicResult = searchDatabase($mysqli, $musicSql, [$searchTerm, $searchTerm], 'ss');

    if ($musicResult && $musicResult->num_rows > 0) {
        $isResultFound = true;
        echo "
        <p class='search-result-title'>Search results for '$tag'</p>
        <div class='song-card-container'>
        ";
        while ($row = $musicResult->fetch_assoc()) {
            $cover = $row['coverImage'];
            $title = $row['title'];
            $artist = getFullName($row['artist']);
            $musicId = $row['id'];
            echo "
            <div class='song-card' title='$title - $artist'>
                <img src='$cover' alt='' srcset=''>
                <button class='start-play-music' data-musicId='$musicId'><iconify-icon
                        icon='gravity-ui:play-fill'></iconify-icon></button>
                <div class='song-info'>
                    <p class='music-title'>$title</p>
                    </div>
            </div>
            ";
        }
        echo "
        </div>
        ";
    }

    // Search for artists
    $artistSql = "SELECT * FROM users WHERE firstName LIKE ? OR lastName LIKE ? OR username LIKE ?";
    $artistResult = searchDatabase($mysqli, $artistSql, [$searchTerm, $searchTerm, $searchTerm], 'sss');

    if ($artistResult && $artistResult->num_rows > 0) {
        $isResultFound = true;
        echo "
        <div class='song-card-container'>
        ";
        while ($row = $artistResult->fetch_assoc()) {
            $profilePic = $row['profile_picture'];
            $artist = getFullName($row['username']);
            $userId = $row['id'];
            echo "
            <div class='song-card artist-card' title='$artist'>
                            <img src='$profilePic' alt='' srcset=''>
                            <div class='song-info'>
                                <p class='music-title'>$artist</p>
                            </div>
                        </div>
            ";
        }
        echo "
        </div>
        </div>
        ";
    }

    if (!$isResultFound) {
        echo "<p class='search-result-title'>No results found for '$tag'</p>";
    }
} else {
    include "searchPage.php";
}
?>