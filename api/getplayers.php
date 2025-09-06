<?php



// for fetching values using javascript, use this api


require_once __DIR__ .'/../main/db/connection.php';

$db = new Database();
$conn = $db->connect();

header('Content-type: application/json');
try {

    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("SELECT * FROM playerstats WHERE player_id = :id");
        $stmt->execute(["id" => $id]);
        $player = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($player) {
            echo json_encode($player);
        } else {
            echo json_encode(['error' => 'No player found!']);
        }
        

    } else {

        $stmt = $conn->prepare("SELECT * FROM playerstats");
        $stmt->execute();
        $players = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($players);
    }



} catch (PDOException $e) {
echo json_encode(["error" => $e->getMessage()]);
}


?>