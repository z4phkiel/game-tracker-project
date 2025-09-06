<?php
    
    session_start();
    require_once __DIR__ . '/../db/connection.php';


    // initialization
    $db = new Database();
    $conn = $db->connect();


    // request method
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $player = $_POST['player_name'];
        $kills = $_POST['kills'];
        $deaths = $_POST['deaths'];
        $matches = $_POST['matches'];
        $wins = $_POST['wins'];


        try {

            $stmt = $conn->prepare("INSERT INTO playerstats (player_name, kills, deaths, matches, wins) VALUES (?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $player);
    $stmt->bindParam(2, $kills);
    $stmt->bindParam(3, $deaths);
    $stmt->bindParam(4, $matches);
    $stmt->bindParam(5, $wins);
    
    $stmt->execute();

    $_SESSION['insert_msg'] = "Player " . htmlspecialchars($player) . " added";



    header("Location: home.php");
    exit;
            
            
        } catch (PDOException $e) {
            echo 'Error inserting player stat' . $e->getMessage();
        }
        

    };


?>

<!-- HTML stuff -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAT INPUT</title>
</head>
<body>
    <a href="home.php"> Database </a>


    <form action="insert.php" method="POST">

    <label>Player Name: </label>
    <input type="text" name="player_name" required><br> 

    <label>Kills: </label>
    <input type="number" name="kills"><br> 

    <label>Deaths: </label>
    <input type="number" name="deaths"><br> 

    <label>Matches: </label>
    <input type="number" name="matches" required><br> 

    <label>Wins: </label>
    <input type="number" name="wins" required><br> 

    <button type="submit">Submit</button>
    </form>
    
</body>
</html>