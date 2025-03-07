<?php
// database.php

// Connect to the database
//use environment variables to store the database credentials

$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];


$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: {$mysqli->connect_error}");
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
