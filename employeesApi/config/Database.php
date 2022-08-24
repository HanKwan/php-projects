<?php 

class Database {
    private $host = 'localhost';
    private $dbname = 'employees_api';
    private $username = 'root';
    // private $port = '3306';
    private $pw = 'hankwansaing';
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->pw);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}