<?php

    require_once __DIR__ . '/../db/connection.php';

    $db = new database();
    $conn = $db->connect();



    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $player = $_POST['player_name'];
        $kills = $_POST['kills'];
        $deaths = $_POST['deaths'];
        $matches = $_POST['matches'];
    }


    $stmt = $conn->prepare("INSERT INTO playerstats (player_name, kills, deaths, matches) VALUES (?, ?, ?, ?)");
    $stmt->bindParam(1, $player);
    
?>