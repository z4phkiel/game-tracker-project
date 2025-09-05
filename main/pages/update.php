<?php

require_once __DIR__ . "/../db/connection.php";

$db = new Database();
$conn = $db->connect();


// fetch player by id
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Player with" . htmlspecialchars($id) .  " not found.");
}

try {
$sql = "SELECT * FROM playerstats WHERE player_id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute(['id' => $id]);
$player = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$player) {
    die("No player found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['player_name'];
    $kills = $_POST['kills'];
    $deaths = $_POST['deaths'];
    $matches = $_POST['matches'];
    $wins = $_POST['wins'];

    $update = "UPDATE playerstats SET player_name = :name, kills = :kills, deaths = :deaths, matches = :matches, wins = :wins WHERE player_id = :id";
    $stmt = $conn->prepare($update);

    $stmt->execute([
        'name' => $name,
        'kills' => $kills,
        'deaths' => $deaths,
        'matches' => $matches,
        'wins' => $wins,
        'id' => $id
    ]);

    echo 'player ' . htmlspecialchars($name) . ' with id' . htmlspecialchars($id) . ' updated!';
}
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    

    <form action = "update.php?id=<?=htmlspecialchars($id) ?>" method="POST">

    <label>Player Name: </label>
    <input type="text" name="player_name" value="<?= htmlspecialchars($player['player_name'])?>" required><br> 

    <label>Kills: </label>
    <input type="number" name="kills" value="<?= htmlspecialchars($player['kills'])?>"required><br> 

    <label>Deaths: </label>
    <input type="number" name="deaths" value="<?= htmlspecialchars($player['deaths'])?>" required><br> 

    <label>Matches: </label>
    <input type="number" name="matches" value="<?= htmlspecialchars($player['matches'])?>" required><br> 

    <label>Wins: </label>
    <input type="number" name="wins" value="<?= htmlspecialchars($player['wins'])?>" required><br> 

    <button type="submit">Submit</button>
    </form>

</body>

<script>



</script>
</html>