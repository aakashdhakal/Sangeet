<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the router file
require_once 'router.php';

//load .env file to $ENV variable
$_ENV = parse_ini_file('.env');
echo getenv('DB_SERVER');
// Connect to the database using environment variables


// Define GET routes
get('/', 'pages/home/mainHome.php'); // Route for the root URL
get('/home', './pages/home/mainHome.php'); // Route for the /home URL
get('/discover', 'pages/home/mainHome.php'); // Route for the /discover URL
get('/trending', 'pages/home/mainHome.php'); // Route for the /trending URL
get('/favourites', 'pages/home/mainHome.php'); // Route for the /favourites URL
get('/search', 'pages/home/mainHome.php'); // Route for the /search URL
get('/search/$tag', 'pages/home/mainHome.php'); // Route for the /search URL
get('/upload', 'pages/home/mainHome.php'); // Route for the /upload URL
get('/logout', 'modules/logoutUser.php'); // Route for logging out
get('/playlist/$id', 'pages/home/mainHome.php'); // Route for the /playlist URL
get('/history', 'pages/home/mainHome.php'); // Route for the /history URL

// Define POST routes for dynamically loading pages
post('/', '/pages/home/home.php'); // Route for the root URL
post('/favourites', 'pages/favourites/favourites.php'); // Route for the /favourites URL
post('/discover', 'pages/discover/discover.php'); // Route for the /discover URL
post('/trending', 'pages/trending/trending.php'); // Route for the /trending URL
post('/search/$tag', 'pages/search/search.php'); // Route for the /search URL
post('/upload', 'pages/upload/upload.php'); // Route for the /upload URL
post('/playlist/$id', 'pages/playlist/playlist.php'); // Route for the /playlist URL
post('/history', 'pages/history/history.php'); // Route for the /history URL

// Define POST routes for various modules
post('/checkUsername', 'modules/checkUsername.php'); // Route for checking username availability
post('/getPlaylistQueue', 'modules/getPlaylistQueue.php'); // Route for getting playlist queue
post('/fetchmusic', 'modules/fetchMusic.php'); // Route for fetching music
post('/addToFavourite', 'modules/addToFavourite.php'); // Route for adding to favourites
post('/addToPlaylist', 'modules/addToPlaylist.php'); // Route for adding to playlist
post('/createPlaylist', 'modules/createPlaylist.php'); // Route for creating a playlist
post('/getPlaylist', 'modules/getPlaylists.php'); // Route for getting a playlist
post('/addToHistory', 'modules/addToHistory.php'); // Route for adding to history
post('/checkLoginStatus', 'modules/checkLoginStatus.php'); // Route for checking login status
post('/setNotificationReadStatus', 'modules/setNotificationReadStatus.php'); // Route for setting notification read status
post('/deleteNotification', 'modules/deleteNotification.php'); // Route for deleting a notification
post('/otpConfig', 'modules/otpConfig.php'); // Route for OTP configuration
post('/checkEmail', 'modules/checkEmail.php'); // Route for checking email
post('/loginUser', 'modules/loginUser.php'); // Route for logging in a user
post('/registerUser', 'modules/registerUser.php'); // Route for registering a user
post('/resetPassword', 'modules/resetPassword.php'); // Route for resetting password
post('/getTrendingQueue', 'modules/getTrendingQueue.php'); // Route for getting trending queue
post('/getFavouritesQueue', 'modules/getFavouritesQueue.php'); // Route for getting favourites queue
post('/getMusicQueue', 'modules/getMusicQueue.php'); // Route for getting music queue
post('/fetchNotifications', 'modules/fetchNotifications.php'); // Route for fetching notifications
post('/uploadMusic', 'modules/uploadMusic.php'); // Route for uploading music
post('/getPlaylistInfo', 'modules/getPlaylistInfo.php'); // Route for getting playlist info
post('/deleteMusicFromPlaylist', 'modules/deleteFromPlaylist.php'); // Route for deleting a playlist
post('/deleteFromHistory', 'modules/deleteFromHistory.php'); // Route for deleting from history

// Define a catch-all route for 404 errors
any('/404', 'pages/404/404.php'); // Route for 404 error page
