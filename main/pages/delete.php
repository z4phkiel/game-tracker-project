<?php

require_once __DIR__ . '/../db/connection.php';


$db = new Database();
$conn = $db->connect();


$id = $_GET['id'] ?? null;

if (!$id) {
    die("Player with " . $id . " not found!");
}

try {
    $delete = "DELETE FROM playerstats WHERE player_id = :id";
    $stmt = $conn->prepare($delete);
    $stmt->execute(['id' => $id]);

    session_start();

    if ($stmt->rowCount()> 0) {
        $_SESSION ['delete_msg'] = "Player deleted successfully";
    } else {
        $_SESSION ['delete_msg'] = "No player found with id: " . htmlspecialchars($id);
    }

    header("Location: home.php");
    exit;

} catch (PDOException $e) {
    echo 'Error ' . $e->getMessage();
}



?>