<?php
// Start the session
session_start();

// Check if the session is active and destroy it
if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
}
// Redirect to the home page
header("Location: /");
exit();