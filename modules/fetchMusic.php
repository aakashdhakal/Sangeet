<?php
include_once "extraFunctions.php";
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["musicId"])) {
        include_once "database.php";
        $musicId = $_POST["musicId"];
        $sql = "SELECT musics.*, users.username,users.firstname,users.lastname,users.isVerified FROM musics INNER JOIN users ON musics.artist = users.username WHERE musics.id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $musicId);
        $stmt->execute();
        $result = $stmt->get_result();
        $music = mysqli_fetch_assoc($result);
        $isFavourite = isFavourites($musicId);
        $music["isFavourite"] = $isFavourite;
        echo json_encode($music);
    } else {
        echo json_encode(["error" => "No music id provided"]);
    }
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
