<?php

require_once __DIR__ . '/../db/connection.php';


//initialization
$db = new Database();
$conn = $db->connect();

$sql = "SELECT * FROM playerstats";
$stmt = $conn->prepare($sql);
$stmt->execute();

// fetching data
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// //table generation using php
// echo '<table border="1" id="playerTable">

//         <tr>
//             <th>PLAYER ID</th>
//             <th>PLAYER NAME</th>
//             <th>TOTAL KILLS</th>
//             <th>TOTAL DEATHS</th>
//             <th>TOTAL MATCHES</th>
//             <th>TOTAL WINS</th>
//             <th>ACTION</th>
//         </tr>';

    

//     foreach ($rows as $row) {
//         echo '<tr>
//         <td>' . $row['player_id'] . '</td>
//         <td>' . $row['player_name'] . '</td>
//         <td>' . $row['kills'] . '</td>
//         <td>' . $row['deaths']. '</td>
//         <td>' . $row['matches'] . '</td>
//         <td>' . $row['wins'] . '</td>
//         <td>
//             <a href="update.php?id=' . $row['player_id']. '">EDIT</a>
//             <a href="delete.php?id=' . $row['player_id'] . '" onclick="return confirm("Are you sure you want to delete user")">DELETE</a>
//         </td>
//         </tr>';

    
//     }
// echo '</table>';
        
    
session_start();

if (isset($_SESSION['insert_msg'])) {
    echo "<script> alert('" . json_encode($_SESSION['insert_msg']) . "') </script>";
    unset($_SESSION['insert_msg']);
}

if (isset($_SESSION['delete_msg'])) {
    echo "<script> alert('" . json_encode($_SESSION['delete_msg']) . "') </script>";
    unset($_SESSION['delete_msg']);
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>



<table border="1" id="playerTable">
<a href="insert.php">Add a player</a>
        <tr>
            <th>PLAYER ID</th>
            <th>PLAYER NAME</th>
            <th>TOTAL KILLS</th>
            <th>TOTAL DEATHS</th>
            <th>TOTAL MATCHES</th>
            <th>TOTAL WINS</th>
            <th>ACTION</th>
        </tr>

        <?php foreach($rows as $row): ?>

        <tr>
            <td> <?= htmlspecialchars($row['player_id']) ?></td>
            <td> <?= htmlspecialchars($row['player_name']) ?></td>
            <td> <?= htmlspecialchars($row['kills']) ?></td>
            <td> <?= htmlspecialchars($row['deaths']) ?></td>
            <td> <?= htmlspecialchars($row['matches']) ?></td>
            <td> <?= htmlspecialchars($row['wins']) ?></td>

            <td>
                <a href="update.php?id=<?= $row['player_id'] ?>">EDIT</a>
                <a href="delete.php?id=<?= $row['player_id'] ?>" 
                onclick="return confirm('Are you sure you want to delete user <?= $row['player_name'] ?> ?' )">DELETE</a>
            </td>

        </tr>

        <?php endforeach; ?>
</table>
    
</body>
</html>






