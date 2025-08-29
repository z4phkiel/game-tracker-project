<?php 


class Database {
    private $dbhost = 'localhost';
    private $dbname = 'gamestats_db';
    private $user = 'root';
    private $dbpassword = "";
    private $charset = 'utf8mb4';
    private $conn;

    public function connect () {
    $this->conn = null;

    try {
        $dsn = "mysql:host=" . $this->dbhost . ";dbname="  . $this->dbname . ";charset=" . $this->charset;
        
    

        $this->conn = new PDO($dsn, $this->user, $this->dbpassword);

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
       return $this->conn;
}




}

?>