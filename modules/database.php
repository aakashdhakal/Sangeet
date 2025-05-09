<?php
// database.php

// Connect to the database
//use environment variables to store the database credentials

$servername = getenv('DB_SERVER');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');
$port = getenv('DB_PORT');

$mysqli = new mysqli("192.168.1.66", "aakashdhakal", "A@kash123", "mydb", "3306");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: {$mysqli->connect_error}");
}

