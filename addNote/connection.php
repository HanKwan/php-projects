<?php
    class Connection {
        public $pdo;

        public function __construct() {
            $this->pdo = new PDO('mysql:host=localhost;dbname=addNote', 'root', 'hankwansaing');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function getNotes() {
            $stmt = $this->pdo->prepare("SELECT * FROM notes ORDER BY created_at");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function addNote($note) {
            $stmt = $this->pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
            $stmt->bindValue(':title', $note['title']);
            $stmt->bindValue(':body', $note['body']);
            return $stmt->execute();
        }

        public function removeNote($id) {
            $stmt = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        }
    }

    return new Connection;