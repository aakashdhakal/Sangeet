<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/database.php';

function get_url($path) {
    // Ensure ROOT_URL is always defined; index.php sets it to '' so URLs are domain-relative
    if (!defined('ROOT_URL')) {
        define('ROOT_URL', '');
    }

    // Ensure path starts with /
    if (strpos($path, '/') !== 0) {
        $path = '/' . $path;
    }

    return ROOT_URL . $path;
}

function isFavourites($musicId)
{
    if (isset($_SESSION['user_id'])) {
        require __DIR__ . '/database.php';
        $userId = $_SESSION['user_id'];
        $sql = "SELECT * FROM favourite_songs WHERE user_id = ? AND song_id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ii', $userId, $musicId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return true;
        }
    }
    return false;
}

function checkSongInPlaylist($playlistId, $musicId)
{
    require __DIR__ . '/database.php';
    $sql = "SELECT * FROM playlist_songs WHERE playlist_id = ? AND music_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ii', $playlistId, $musicId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    }
    return false;
}

function getFullName($userName)
{
    require __DIR__ . '/database.php';
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $userName);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['firstname'] . ' ' . $row['lastname'];
}

function createSlug($string)
{
    // Convert the string to lowercase
    $string = strtolower($string);
    // Remove special characters
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    // Replace multiple spaces or hyphens with a single hyphen
    $string = preg_replace('/[\s-]+/', ' ', $string);
    // Replace spaces with hyphens
    $string = preg_replace('/\s/', '-', $string);
    return $string;
}

function uploadFile($file, $type, $fileName)
{
    switch ($type) {
        case 'music':
            $uploadDir = APP_PATH . "/public/music/";
            $webPath = "public/music/"; // Path for web access
            break;
        case 'playlist_cover':
            $uploadDir = APP_PATH . "/public/images/playlist-cover/";
            $webPath = "public/images/playlist-cover/"; // Path for web access
            break;
        case 'song_cover':
            $uploadDir = APP_PATH . "/public/images/song-cover/";
            $webPath = "public/images/song-cover/"; // Path for web access
            break;
        case 'profile_pic':
            $uploadDir = APP_PATH . "/public/images/song-cover/";
            $webPath = "public/images/song-cover/"; // Path for web access
            break;
        case 'song_lyrics':
            $uploadDir = APP_PATH . "/public/lyrics/";
            $webPath = "public/lyrics/"; // Path for web access
            break;
        default:
            echo "Invalid file type.";
            return;
    }
    $uploadFilePath = $uploadDir . $fileName; // Absolute path for file operations
    $uploadFileWebPath = $webPath . $fileName; // Relative path for database and web usage

    if (!move_uploaded_file($file["tmp_name"], $uploadFilePath)) {
        // Handle error if file wasn't moved successfully
        echo "Failed to upload file.";
        return;
    } else {
        return $uploadFileWebPath;
    }
}

function getGenreList()
{
    require __DIR__ . '/database.php';
    $sql = "SELECT genre FROM musics GROUP BY genre";
    $result = $mysqli->query($sql);
    $genreList = array();
    while ($row = $result->fetch_assoc()) {
        $genreList[] = $row['genre'];
    }
    return $genreList;
}



function getLanguageList()
{
    $languages = [
        "Afrikaans",
        "Albanian",
        "Amharic",
        "Arabic",
        "Armenian",
        "Azerbaijani",
        "Basque",
        "Belarusian",
        "Bengali",
        "Bosnian",
        "Bulgarian",
        "Catalan",
        "Cebuano",
        "Chichewa",
        "Chinese",
        "Corsican",
        "Croatian",
        "Czech",
        "Danish",
        "Dutch",
        "English",
        "Esperanto",
        "Estonian",
        "Filipino",
        "Finnish",
        "French",
        "Frisian",
        "Galician",
        "Georgian",
        "German",
        "Greek",
        "Gujarati",
        "Haitian Creole",
        "Hausa",
        "Hawaiian",
        "Hebrew",
        "Hindi",
        "Hmong",
        "Hungarian",
        "Icelandic",
        "Igbo",
        "Indonesian",
        "Irish",
        "Italian",
        "Japanese",
        "Javanese",
        "Kannada",
        "Kazakh",
        "Khmer",
        "Kinyarwanda",
        "Korean",
        "Kurdish",
        "Kyrgyz",
        "Lao",
        "Latin",
        "Latvian",
        "Lithuanian",
        "Luxembourgish",
        "Macedonian",
        "Malagasy",
        "Malay",
        "Malayalam",
        "Maltese",
        "Maori",
        "Marathi",
        "Mongolian",
        "Myanmar",
        "Nepali",
        "Norwegian",
        "Odia",
        "Pashto",
        "Persian",
        "Polish",
        "Portuguese",
        "Punjabi",
        "Romanian",
        "Russian",
        "Samoan",
        "Scots Gaelic",
        "Serbian",
        "Sesotho",
        "Shona",
        "Sindhi",
        "Sinhala",
        "Slovak",
        "Slovenian",
        "Somali",
        "Spanish",
        "Sundanese",
        "Swahili",
        "Swedish",
        "Tajik",
        "Tamil",
        "Tatar",
        "Telugu",
        "Thai",
        "Turkish",
        "Turkmen",
        "Ukrainian",
        "Urdu",
        "Uyghur",
        "Uzbek",
        "Vietnamese",
        "Welsh",
        "Xhosa",
        "Yiddish",
        "Yoruba",
        "Zulu"
    ];
    return $languages;
}

function getPlaylistSongsCount($playlistId)
{
    require __DIR__ . '/database.php';
    $sql = "SELECT * FROM playlist_songs WHERE playlist_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $playlistId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}

function getPlaylistList($userId)
{
    require __DIR__ . '/database.php';
    $sql = "SELECT * FROM playlists WHERE user_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $playlistList = [];
    while ($row = $result->fetch_assoc()) {
        $row['song_count'] = getPlaylistSongsCount($row['id']);
        $playlistList[] = $row;
    }
    return $playlistList;
}

function formatDuration($duration)
{
    $minutes = floor($duration / 60);
    $seconds = $duration % 60;
    return $minutes . ':' . str_pad($seconds, 2, '0', STR_PAD_LEFT);
}

function formatTime($time)
{
    $hours = floor($time / 3600);
    $minutes = floor(($time % 3600) / 60);
    $seconds = $time % 60;
    return [
        'hrs' => $hours,
        'mins' => $minutes,
        'secs' => $seconds
    ];
}


function incrementPlays($musicId)
{
    require __DIR__ . '/database.php';
    $sql = "UPDATE musics SET plays = plays + 1 WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $musicId);
    $stmt->execute();
}