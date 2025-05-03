<?php
// database.php

// Connect to the database
//use environment variables to store the database credentials

$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];


<<<<<<< HEAD
//connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "sangeet";
=======
>>>>>>> 532633b780780f32aaacb13c66bf24a0cda4baee
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: {$mysqli->connect_error}");
}

