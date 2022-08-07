<?php
    $connection = require_once './connection.php';
    $connection->removeNote($_POST['deleteId']);
    header('Location: index.php');