<?php

require_once __DIR__ . '/../db/connection.php';


//initialization
$db = new database();
$conn = $db->connect();

$sql = "SELECT * FROM playerstats";
$stmt = $conn->query($sql);

//table generation using php
echo '<table border="1" id="playerTable">

        <tr>
            <th>PLAYER ID</th>
            <th>PLAYER NAME</th>
            <th>TOTAL KILLS</th>
            <th>TOTAL DEATHS</th>
            <th>TOTAL MATCHES</th>
            <th>TOTAL WINS</th>
            <th>KDA</th>
            <th>WINRATE</th>
        </tr>';

    // fetching data
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        echo '<tr>
        <td>' . $row['player_id'] . '</td>
        <td>' . $row['player_name'] . '</td>
        <td>' . $row['kills'] . '</td>
        <td>' . $row['deaths']. '</td>
        <td>' . $row['matches'] . '</td>
        <td>' . $row['wins'] . '</td>
        </tr>';

    
    }
echo '</table>';
        
    


    
?>






