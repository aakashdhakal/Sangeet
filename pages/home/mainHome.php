<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$website_title = "Sangeet- The Heartbeat of Music";
?>

<!DOCTYPE html>
<html lang="en">
<?php
include_once "pages/head.php";
include_once "modules/extraFunctions.php";
?>
<link rel="stylesheet" href="/public/CSS/home.css">
</head>

<body>
    <?php
    include_once "pages/preloader.php";
    include_once "pages/home/createPlaylist.php";
    ?>
    <dialog id="addToPlaylistModal">
        <div class="max-width">
            <?php
            if (isset($_SESSION['user_id'])) {

                $playlistList = getPlaylistList($_SESSION['user_id']);
                // Remove var_dump($playlistList); if you don't need to debug
                foreach ($playlistList as $playlist) {
                    echo "<button class='playlist-btn' data-playlistid='{$playlist['id']}'>{$playlist['name']}</button>";
                }
            }
            ?>
        </div>
    </dialog>

    <div id="musicControls">
        <div class="full-screen-show">
            <div class="playing-on">
                <img src=" /public/images/logo-circle.png" alt="" srcset="">
                <p>PLAYING ON SANGEET</p>
            </div>
            <div id="lyricsContainer" class="lyrics-container">
                <p class="previous"></p>
                <p class="current"></p>
                <p class="next"></p>
            </div>
        </div>
        <div class="controls">
            <div class="left">
                <img src=" /public\images\song-cover\sarangi.jpg" alt="album art" class="music-cover">
                <div class="song-info">
                    <h3 class="music-title">Saarangi wadawdawd awd</h3>
                    <p class="music-artist">Sushant K.C</p>
                </div>
            </div>
            <div class="center">
                <div class="music-control-btns">
                    <button class="shuffle-btn" data-shuffle="false">
                        <iconify-icon icon="solar:shuffle-linear"></iconify-icon> </button>
                    <button class="prev-btn">
                        <iconify-icon icon="mage:previous"></iconify-icon> </button>
                    <button class="play-pause-btn">
                        <iconify-icon icon='solar:play-bold' style="color:#ff7f11"></iconify-icon>
                    </button>
                    <button class="next-btn">
                        <iconify-icon icon="mage:next"></iconify-icon> </button>
                    <button class="repeat-btn" data-repeat="false">
                        <iconify-icon icon="solar:repeat-bold"></iconify-icon> </button>
                </div>
                <div class="progress-bar">
                    <p class="current-duration duration">00:00</p>
                    <input type="range" name="" id="seekbar" min="0" max="100" value="0" step="0.001"
                        class="range-slider">
                    <p class="total-duration duration">03:00</p>
                </div>
            </div>
            <div class="right">
                <button class="like-btn" title="Add to Favourites" data-liked="0">
                    <iconify-icon icon='fe:heart-o'></iconify-icon></button>
                <button class="add-to-playlist-btn" title="Add to Playlist">
                    <iconify-icon icon='tabler:playlist-add'></iconify-icon> </button>
                <div class="volume-control">
                    <button class="volume-btn">
                        <iconify-icon icon="mage:volume-up"></iconify-icon> </button>
                    <div class="volume-slider">
                        <input type="range" name="" id="volume" min="0" max="100" value="100" step="0.001"
                            class="range-slider">
                    </div>
                </div>
                <button class="expand-current-song" title="Expand">
                    <i class="fa-regular fa-up-right-and-down-left-from-center"></i>
                </button>
            </div>
        </div>
    </div>
    <nav id="sideNav">
        <ul>
            <li>
                <button data-path="/" data-script="public/JS/home.js" data-title="Sangeet - The Heartbeat of Music"
                    class="nav-btn page-load-btn">
                    <iconify-icon icon="fluent:home-24-filled"></iconify-icon>Home
                </button>
            </li>
            <li>
                <button data-path="/discover" class="nav-btn page-load-btn" data-script="/public/JS/discover.js"
                    data-title="Discover new music">
                    <iconify-icon icon="mingcute:compass-fill"></iconify-icon>Discover
                </button>
            </li>
            <li>
                <button data-path="/trending" class="nav-btn page-load-btn" data-title="/Trending Music"
                    data-script="public/JS/trending.js">
                    <iconify-icon icon="mage:fire-b-fill"></iconify-icon>Trending
                </button>
            </li>
        </ul>
        <?php
        if (isset($_SESSION['user_id'])) {
            ?>
            <ul>
                <div class="nav-heading-container">
                    <hr>
                    <p class="nav-heading">Library</p>
                </div>
                <!-- Favourites -->
                <li>
                    <button data-path="/favourites" data-script="/public/JS/favourites.js" class="nav-btn page-load-btn">
                        <iconify-icon icon="si:heart-fill"></iconify-icon>Favourites
                    </button>
                </li>
                <!-- Recently Played -->
                <li>
                    <button data-path="/history" class="nav-btn page-load-btn" data-script="/public/JS/history.js">
                        <iconify-icon icon="akar-icons:history"></iconify-icon>History
                    </button>
                </li>
            </ul>
            <ul>
                <div class="nav-heading-container">
                    <hr>
                    <p class="nav-heading">Playlists</p>
                </div>
                <!-- My Playlists -->
                <div class="sidebar-playlist-container">
                    <?php
                    $playlistList = getPlaylistList($_SESSION['user_id']);
                    foreach ($playlistList as $playlist) {
                        echo "
                    <div class='playlist-card page-load-btn' data-playlistId = '{$playlist['id']}' data-path='/playlist/{$playlist['id']}' data-title='{$playlist['name']} - by " . getFullName($_SESSION['username']) . "' data-script='/public/JS/playlist.js'>
                        <img src='{$playlist['cover']}' alt='' srcset=''>
                        <div class='playlist-info'>
                            <h3 class='playlist-title'>{$playlist['name']}</h3>
                            <p class='song-count'> <span class='count'>{$playlist['song_count']}</span> songs</p>
                        </div>
                    </div>
                    ";
                    }
                    ?>
                </div>
                <button class="secondary-btn" id="createPlaylistDialogShowBtn">
                    <iconify-icon icon="lucide:plus"></iconify-icon>
                    <p class="nav-text">Create Playlist</p>
                </button>

            </ul>
            <?php
        } else {
            ?>
            <hr>
            <div class="not-logged-in">
                <p class="nav-heading">Sign in to you account to access your library</p>
                <button class="secondary-btn login-form-show-btn" id="signupBtn">
                    <iconify-icon icon="solar:user-linear"></iconify-icon>
                    <p class="nav-text">Sign in</p>
                </button>
            </div>
        <?php } ?>
    </nav>
    <header id="topNav">
        <div class="left">
            <button id="collapseExpandSidebar">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <div class="logo-container">
                <a href="/">
                </a>
            </div>

        </div>
        <div class="search-container">
            <form class="search-form">
                <div class="form-group">
                    <input type="text" name="search" id="search" placeholder="Search for songs, artists, albums">
                    <button type="submit">
                        <iconify-icon icon="mingcute:search-3-line"></iconify-icon>
                    </button>
                </div>
            </form>
        </div>
        <div class="right">
            <?php
            if (isset($_SESSION['user_id'])) {
                ?>
                <button id="uploadMusicShowBtn" title="Upload Music" data-title="Upload Music" data-path="/upload"
                    class="page-load-btn" data-script="/public/JS/uploadMusic.js">
                    <iconify-icon icon="iconoir:music-note-plus"></iconify-icon> </button>
                <button class="dark-mode-btn">
                    <iconify-icon icon="flowbite:moon-outline"></iconify-icon>
                </button>
                <button class="notification-btn">
                    <iconify-icon icon="ph:bell-bold"></iconify-icon>
                </button>
                <button class="profile-btn">
                    <img src=" <?php echo $_SESSION["user_image"] ?>" alt="profile-pic">
                </button>
                <div id="notificationWindow">
                    <div class="notification-header">
                        <h3>Notifications</h3>
                        <button class="mark-all-as-read"> Mark all as read <iconify-icon
                                icon="charm:circle-tick"></iconify-icon>
                        </button>
                    </div>
                    <hr>
                    <div class="notification-body"></div>
                </div>

                <div id="profileWindow">
                    <ul>

                        <li>
                            <a href="/<?php echo $_SESSION["username"] ?>">
                                <iconify-icon icon="bi:person-circle"></iconify-icon>Profile
                            </a>
                        </li>
                        <li>
                            <a href="/settings">
                                <iconify-icon icon="bi:gear-wide-connected"></iconify-icon>Settings
                            </a>
                        </li>
                        <li>
                            <a href="/help">
                                <iconify-icon icon="bi:question-circle"></iconify-icon>Help
                            </a>
                        </li>
                        <li>
                            <a href="/logout">
                                <iconify-icon icon="bi:box-arrow-right"></iconify-icon>Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <?php
            } else {
                include_once "pages/home/login.php";
                include_once "pages/home/signup.php";
                include_once "pages/home/resetPassword.php";
                ?>
                <div class="login-signup-btn-container">
                    <button class="login-form-show-btn secondary-btn" id="loginFormShowBtn">Login</button>
                    <button class="signup-form-show-btn primary-btn" id="signupFormShowBtn">Sign Up</button>
                </div>
                <?php
            }
            ?>
        </div>


    </header>

    <main>
        <?php include "home.php" ?>
    </main>
    <script class="dynamic-script" src=""></script>
    <script src="/public/JS/script.js"></script>
    <script src="/public/JS/temp-musicplayer.js"></script>
    <?php
    if (!isset($_SESSION['user_id'])) {
        ?>
        <script src="/public/JS/login.js"></script>
        <script src="/public/JS/signup.js"></script>
        <script src="/public/JS/forgotPassword.js"></script>
        <?php
    }
    ?>
</body>

</html>

<!-- jcettrwbpewjnqrt -->