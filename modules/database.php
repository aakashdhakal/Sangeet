<?php
// database.php

// Connect to the database
//use environment variables to store the database credentials

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $servername = getenv('DB_SERVER') ?: 'localhost';
    $username = getenv('DB_USERNAME') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: '';
    $database = getenv('DB_NAME') ?: 'sangeet';
    $port = getenv('DB_PORT') ?: 3306;

    $mysqli = new mysqli($servername, $username, $password, $database, $port);
    $mysqli->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

