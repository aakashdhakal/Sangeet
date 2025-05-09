<?php
// database.php

// Connect to the database
//use environment variables to store the database credentials

$servername = getenv('DB_SERVER');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_NAME');
$port = getenv('DB_PORT');

$mysqli = new mysqli($servername, $username, $password, $database, $port);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: {$mysqli->connect_error}");
}

