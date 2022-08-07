<?php
    $connection = require_once './connection.php';

    if (empty($_POST['title']) && empty($_POST['body'])) {
        header('Location: index.php');
    } else {
        $connection->addNote($_POST);
    }
    header('Location: index.php');