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
    ?>
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
                <dialog id="loginForm">
                    <div class="max-width">
                        <button class="close-dialog-btn" id="closeLoginForm">
                            <iconify-icon icon="system-uicons:cross"></iconify-icon> </button>
                        <h2>Login</h2>
                        <form action="#" method="POST" class="login-form">
                            <div class="form-group">
                                <input type="text" name="username" id="username" placeholder=" " required>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" autocomplete="off" placeholder=" "
                                    required>
                                <label for="password">Password</label>
                                <button class="toggle-password-visibility" type="button">
                                    <iconify-icon icon="fluent:eye-24-regular"></iconify-icon> </button>
                            </div>
                            <a href="forgot-password">Forgot Password?</a>
                            <button type="submit" class="primary-btn">Login</button>
                            <p>Don't have an account? <a href="#" id="signupFromLogin">Sign Up</a></p>
                        </form>
                    </div>
                </dialog>
                <dialog id="signupForm">
                    <div class="max-width">
                        <button class="close-dialog-btn" id="closeSignupForm">
                            <iconify-icon icon="system-uicons:cross"></iconify-icon> </button>
                        <h2>Sign Up</h2>
                        <form action="#" method="POST" class="signup-form">
                            <div class="form-group">
                                <input type="text" name="username" id="signupUsername" placeholder=" " required>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="signupEmail" placeholder=" " required>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="signupPassword" autocomplete="off"
                                    placeholder=" " required>
                                <label for="password">Password</label>
                                <button class="toggle-password-visibility" type="button">
                                    <iconify-icon icon="fluent:eye-24-regular"></iconify-icon> </button>
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirmPassword" id="confirmPassword" autocomplete="off"
                                    placeholder=" " required>
                                <label for="confirmPassword">Confirm Password</label>
                                <button class="toggle-password-visibility" type="button">
                                    <iconify-icon icon="fluent:eye-24-regular"></iconify-icon> </button>
                            </div>
                            <button type="submit" class="primary-btn" id="nextStep">Sign Up</button>
                            <p>Already have an account? <a href="#" id="loginFromSignup">Login</a></p>
                        </form>
                        <form action="#" method="POST" class="otp-verify">
                            <p>Enter the OTP sent to your email</p>
                            <div class="form-group otp-group">
                                <!-- one digit per input -->
                                <input type="text" inputmode="numeric" pattern="[0-9]+" name="otp[]" id="otp1" maxlength="1"
                                    required>
                                <input type="text" inputmode="numeric" name="otp[]" id="otp2" maxlength="1" required
                                    autocomplete="off">
                                <input type="text" inputmode="numeric" name="otp[]" id="otp3" maxlength="1" required
                                    autocomplete="off">
                                <input type="text" inputmode="numeric" name="otp[]" id="otp4" maxlength="1" required
                                    autocomplete="off">
                                <input type="text" inputmode="numeric" name="otp[]" id="otp5" maxlength="1" required
                                    autocomplete="off">
                                <input type="text" inputmode="numeric" name="otp[]" id="otp6" maxlength="1" required
                                    autocomplete="off">
                            </div>
                            <p class="resend-otp"></p>
                            <button type="submit" class="primary-btn">Verify</button>
                        </form>
                    </div>
                </dialog>

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