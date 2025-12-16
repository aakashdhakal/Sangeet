<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$website_title = "Sangeet- The Heartbeat of Music";
?>

<!DOCTYPE html>
<html lang="en">
<?php
include_once "modules/extraFunctions.php";
include_once "pages/head.php";
?>
<link rel="stylesheet" href="<?php echo get_url('/public/CSS/home.css'); ?>">
</head>

<body>
    <?php
    include_once "pages/preloader.php";
    ?>
    <nav id="sideNav">
        <ul>
            <li>
                <button data-path="<?php echo get_url('/'); ?>"
                    data-script="<?php echo get_url('/public/JS/home.js'); ?>"
                    data-title="Sangeet - The Heartbeat of Music" class="nav-btn page-load-btn">
                    <iconify-icon icon="fluent:home-24-filled"></iconify-icon>Home
                </button>
            </li>
            <li>
                <button data-path="<?php echo get_url('/discover'); ?>" class="nav-btn page-load-btn"
                    data-script="<?php echo get_url('/public/JS/discover.js'); ?>" data-title="Discover new music">
                    <iconify-icon icon="mingcute:compass-fill"></iconify-icon>Discover
                </button>
            </li>
            <li>
                <button data-path="<?php echo get_url('/trending'); ?>" class="nav-btn page-load-btn"
                    data-title="/Trending Music" data-script="<?php echo get_url('/public/JS/trending.js'); ?>">
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
                    <button data-path="<?php echo get_url('/favourites'); ?>"
                        data-script="<?php echo get_url('/public/JS/favourites.js'); ?>" class="nav-btn page-load-btn">
                        <iconify-icon icon="si:heart-fill"></iconify-icon>Favourites
                    </button>
                </li>
                <!-- Recently Played -->
                <li>
                    <button data-path="<?php echo get_url('/history'); ?>" class="nav-btn page-load-btn"
                        data-script="<?php echo get_url('/public/JS/history.js'); ?>">
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
                    <div class='playlist-card page-load-btn' data-playlistId = '{$playlist['id']}' data-path='" . get_url("/playlist/{$playlist['id']}") . "' data-title='{$playlist['name']} - by " . getFullName($_SESSION['username']) . "' data-script='" . get_url('/public/JS/playlist.js') . "'>
                        <img src='" . get_url($playlist['cover']) . "' alt='' srcset=''>
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
                <a href="<?php echo get_url('/'); ?>">
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
                <button id="uploadMusicShowBtn" title="Upload Music" data-title="Upload Music"
                    data-path="<?php echo get_url('/upload'); ?>" class="page-load-btn"
                    data-script="<?php echo get_url('/public/JS/uploadMusic.js'); ?>">
                    <iconify-icon icon="iconoir:music-note-plus"></iconify-icon> </button>
                <button class="dark-mode-btn">
                    <iconify-icon icon="flowbite:moon-outline"></iconify-icon>
                </button>
                <button class="notification-btn">
                    <iconify-icon icon="ph:bell-bold"></iconify-icon>
                </button>
                <button class="profile-btn">
                    <img src=" <?php echo get_url($_SESSION["user_image"]); ?>" alt="profile-pic">
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
                            <a href="<?php echo get_url('/' . $_SESSION["username"]); ?>">
                                <iconify-icon icon="bi:person-circle"></iconify-icon>Profile
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_url('/settings'); ?>">
                                <iconify-icon icon="bi:gear-wide-connected"></iconify-icon>Settings
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_url('/help'); ?>">
                                <iconify-icon icon="bi:question-circle"></iconify-icon>Help
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo get_url('/logout'); ?>">
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

    <section id="musicControls" role="region" aria-label="Music Player Controls">
        <div class="music-info-container">
            <img src="" alt="Current song cover" class="music-cover" />
            <div class="music-info">
                <h4 class="music-title" aria-live="polite"></h4>
                <p class="music-artist" aria-live="polite"></p>
            </div>
            <button class="like-btn" data-liked="0" aria-label="Like song" title="Like">
                <iconify-icon icon="fe:heart-o"></iconify-icon>
            </button>
        </div>

        <div class="player-controls-container">
            <div class="controls-btn-container" role="group" aria-label="Playback controls">
                <button class="shuffle-btn" data-shuffle="false" aria-label="Shuffle" title="Shuffle">
                    <iconify-icon icon="solar:shuffle-linear"></iconify-icon>
                </button>
                <button class="prev-btn" aria-label="Previous" title="Previous">
                    <iconify-icon icon="solar:skip-previous-bold"></iconify-icon>
                </button>
                <button class="play-pause-btn" aria-label="Play/Pause" title="Play/Pause">
                    <iconify-icon icon="solar:play-bold"></iconify-icon>
                </button>
                <button class="next-btn" aria-label="Next" title="Next">
                    <iconify-icon icon="solar:skip-next-bold"></iconify-icon>
                </button>
                <button class="repeat-btn" data-repeat="false" aria-label="Repeat" title="Loop">
                    <iconify-icon icon="solar:repeat-linear"></iconify-icon>
                </button>
            </div>
            <div class="seekbar-container">
                <label for="seekbar" class="visually-hidden">Seek</label>
                <p class="current-duration" aria-live="polite">0:00</p>
                <input type="range" name="seekbar" id="seekbar" value="0" min="0" max="100" aria-valuemin="0"
                    aria-valuemax="100" aria-valuenow="0" aria-label="Seek">
                <p class="total-duration" aria-live="polite">0:00</p>
            </div>
        </div>

        <div class="volume-container">
            <button class="volume-btn" aria-label="Mute/Unmute" title="Mute/Unmute">
                <iconify-icon icon="mage:volume-up"></iconify-icon>
            </button>
            <label for="volume" class="visually-hidden">Volume</label>
            <input type="range" name="volume" id="volume" value="100" min="0" max="100" aria-valuemin="0"
                aria-valuemax="100" aria-valuenow="100" aria-label="Volume">
            <button class="expand-current-song" aria-label="Expand Player" title="Expand Player">
                <iconify-icon icon="solar:maximize-square-minimalistic-linear"></iconify-icon>
            </button>
        </div>
        <div class="lyrics-container" aria-live="polite"></div>
    </section>

    <dialog id="addToPlaylistModal">
        <div class="modal-header">
            <h3>Add to Playlist</h3>
            <button class="close-dialog-btn"><iconify-icon icon="mingcute:close-line"></iconify-icon></button>
        </div>
        <div class="playlist-list-container">
            <?php
            if (isset($_SESSION['user_id'])) {
                $playlists = getPlaylistList($_SESSION['user_id']);
                if (empty($playlists)) {
                    echo "<p>No playlists found</p>";
                }
                foreach ($playlists as $playlist) {
                    echo "<button class='playlist-btn' data-playlistId='{$playlist['id']}'>
                     <img src='" . get_url($playlist['cover']) . "' >
                     <div class='playlist-info'>
                     <p class='playlist-name'>{$playlist['name']}</p>
                     </div>
                     </button>";
                }
            }
            ?>
        </div>
    </dialog>

    <dialog id="createPlaylistDialog">
        <div class="modal-header">
            <h3>Create Playlist</h3>
            <button class="close-dialog-btn"><iconify-icon icon="mingcute:close-line"></iconify-icon></button>
        </div>
        <form id="createPlaylistForm">
            <div class="form-group">
                <label for="playlistName">Name</label>
                <input type="text" name="playlistName" id="playlistName" placeholder="My Playlist" required>
            </div>
            <div class="form-group">
                <label for="playlistDescription">Description</label>
                <textarea name="playlistDescription" id="playlistDescription" placeholder="Description"
                    required></textarea>
            </div>
            <div class="form-group">
                <label for="visibility">Visibility</label>
                <div class="custom-select">
                    <div class="select-display">Public</div>
                    <div class="select-options">
                        <div class="select-option" data-value="public">Public</div>
                        <div class="select-option" data-value="private">Private</div>
                    </div>
                    <input type="hidden" name="visibility" id="visibility" value="public">
                </div>
            </div>
            <div class="error-container"></div>
            <button type="submit" class="primary-btn">Create Playlist</button>
        </form>
    </dialog>
    <script src="<?php echo get_url('/public/JS/script.js'); ?>"></script>
    <script src="<?php echo get_url('/public/JS/temp-musicplayer.js'); ?>"></script>
    <?php
    if (!isset($_SESSION['user_id'])) {
        ?>
        <script src="<?php echo get_url('/public/JS/login.js'); ?>"></script>
        <script src="<?php echo get_url('/public/JS/signup.js'); ?>"></script>
        <script src="<?php echo get_url('/public/JS/forgotPassword.js'); ?>"></script>
        <?php
    }
    ?>
</body>

</html>

<!-- jcettrwbpewjnqrt -->