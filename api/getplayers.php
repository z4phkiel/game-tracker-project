<?php
require_once __DIR__ .'/../main/db/connection.php';

$db = new Database();
$conn = $db->connect();


try {


    $stmt = $conn->query('SELECT * FROM playerstats');
$playerlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-type: application/json');

echo json_encode($playerlist);

} catch (PDOException $e) {
echo json_encode(["error" => $e->getMessage()]);
}


?>