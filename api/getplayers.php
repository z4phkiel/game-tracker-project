<?php

require_once __DIR__ .'/../db/connection.php';

$db = new database();
$conn = $db->connect();

$stmt = $conn->query('SELECT * FROM playerstats');
$playerlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-type: application/json');

echo json_encode($playerlist);

?>