<?php
    $connection = require_once './connection.php';

    if (empty($_POST['title']) && empty($_POST['body'] && empty($_POST['id']))) {
        header('Location: index.php');
    } elseif ($_POST['id']) {
        $connection->updateNote($_POST['id'], $_POST);
    } else {
        $connection->addNote($_POST);
    }
    header('Location: index.php');