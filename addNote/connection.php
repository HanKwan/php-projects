<?php
    class Connection {
        public $pdo;

        public function __construct() {
            $this->pdo = new PDO('mysql:host=localhost;dbname=addNote', 'root', 'hankwansaing');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    return new Connection;