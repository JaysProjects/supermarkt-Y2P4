<?php

class DatabaseConnection {
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $pdo;

    public function __construct($host, $dbname, $user, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect() {
        try {
            // Establish the PDO connection
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);

            // Set PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "success";
        } catch (PDOException $e) {
            // Handle any errors that occur during the PDO connection
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}
