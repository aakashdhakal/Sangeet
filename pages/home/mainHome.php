<!DOCTYPE html>
<html lang="en">
<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$website_title = "Sangeet- The Heartbeat of Music";
include_once "pages/head.php";
?>
<link rel="stylesheet" href="public/CSS/home.css">
</head>

<body>
    <?php
    include_once "pages/preloader.php";
    ?>
    <nav id="sideNav">
        <ul>
            <li class="active">
                <button data-path="pages/home/home.php" data-script="public/JS/home.js" class="nav-btn">
                    <iconify-icon icon="fluent:home-24-filled"></iconify-icon>Home
                </button>
            </li>
            <li>
                <button data-path="pages/tempHome/home.php" data-script="public/JS/home.js" class="nav-btn">
                    <iconify-icon icon="mingcute:compass-fill"></iconify-icon>Discover
                </button>
            </li>
            <li>
                <button data-path="pages/tempHome/home.php" data-script="public/JS/home.js" class="nav-btn">
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
                    <button data-path="pages/favourites/favourites.php" data-script="public/JS/favourites.js"
                        class="nav-btn">
                        <iconify-icon icon="si:heart-fill"></iconify-icon>Favourites
                    </button>
                </li>
                <!-- Recently Played -->
                <li>
                    <button data-path="pages/tempHome/home.php" class="nav-btn">
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
                    <!-- <div class="playlist-card">
                        <img src="public/images/playlist-cover/playlist-cover.png" alt="">
                        <div class="playlist-info">
                            <p class="playlist-title">My Playlist</p>
                            <p class="no-of-songs">10 songs</p>
                        </div>
                    </div>
                    <div class="playlist-card">
                        <img src="public/images/playlist-cover/playlist-cover.png" alt="">
                        <div class="playlist-info">
                            <p class="playlist-title">My Playlist</p>
                            <p class="no-of-songs">10 songs</p>
                        </div>
                    </div> -->
                    <?php include "modules/getPlaylist.php" ?>
                </div>
            </ul>
            <?php
        } else {
            ?>
            <div class="not-logged-in">
                <p>Sign in to access your library</p>
                <button class="secondary-btn" id="signupBtn">Sign Up</button>
            </div>
        <?php } ?>
    </nav>
    <header id="topNav">
        <div class="left">
            <button id="collapseExpandSidebar">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>
            <div class="logo-container">
                <a href="
                    <?php echo $baseUrl ?>">
                </a>
            </div>

        </div>
        <div class="right">
            <?php
            if (isset($_SESSION['user_id'])) {
                ?>
                <button id="uploadMusicShowBtn" title="Upload Music">
                    <iconify-icon icon="icon-park-solid:add-music"></iconify-icon>
                </button>
                <button class="dark-mode-btn">
                    <iconify-icon icon="flowbite:moon-outline"></iconify-icon>
                </button>
                <button class="notification-btn">
                    <iconify-icon icon="ph:bell-bold"></iconify-icon>
                </button>
                <button class="profile-btn">
                    <img src="public\images\profile-pics\profile.jpeg" alt="profile-pic">
                </button>
                <?php
            } else {
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
                    <a href="pages/tempHome/profile.php">
                        <iconify-icon icon="bi:person-circle"></iconify-icon>Profile
                    </a>
                </li>
                <li>
                    <a href="pages/tempHome/settings.php">
                        <iconify-icon icon="bi:gear-wide-connected"></iconify-icon>Settings
                    </a>
                </li>
                <li>
                    <a href="pages/tempHome/help.php">
                        <iconify-icon icon="bi:question-circle"></iconify-icon>Help
                    </a>
                </li>
                <li>
                    <a href="modules/logoutUser.php">
                        <iconify-icon icon="bi:box-arrow-right"></iconify-icon>Logout
                    </a>
                </li>
            </ul>
        </div>

    </header>
    <div id="musicControls">
        <div class="left">
            <img src="<?php echo $baseUrl ?>\public\images\song-cover\sarangi.jpg" alt="album art" class="music-cover">
            <div class="song-info">
                <h3 class="music-title">Saarangi</h3>
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
                <input type="range" name="" id="seekbar" min="0" max="100" value="0" step="0.001" class="range-slider">
                <p class="total-duration duration">03:00</p>
            </div>
        </div>
        <div class="right">
            <button class="like-btn" title="Add to Favourites" data-liked="false" data-musicId="2">
                <iconify-icon icon='fe:heart-o'></iconify-icon></button>
            <button class="add-to-playlist-dialog-show-btn" title="Add to Playlist">
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
    <main>
        <?php include "home.php" ?>
    </main>
    <script class="dynamic-script" src="public/JS/home.js"></script>
    <script src="public/JS/script.js"></script>
    <script src="public/JS/temp-musicplayer.js"></script>
    <script src="public/JS/login.js"></script>
    <script src="public/JS/signup.js"></script>
</body>

</html>