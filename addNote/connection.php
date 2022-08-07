<?php
    class Connection {
        public $pdo;

        public function __construct() {
            $this->pdo = new PDO('mysql:host=localhost;dbname=addNote', 'root', 'hankwansaing');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function getNotes() {
            $stmt = $this->pdo->prepare("SELECT * FROM notes ORDER BY created_at DESC");
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

        public function getNoteById($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE id = :id");      // dont foget to select * -_-
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function updateNote($id, $note) {
            $stmt = $this->pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':title', $note['title']);
            $stmt->bindValue(':body', $note['body']);
            return $stmt->execute();
        }
    }

    return new Connection;