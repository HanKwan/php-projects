<?php
    $todo = $_POST['deleteTodo'] ?? null;
    $json = file_get_contents('todo.json');
    $jsonArray = json_decode($json, true);
    var_dump($todo);

    if ($todo) {
        unset($jsonArray[$todo]);
    } else {
        header('Location: index.php');
    }

    file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));
    header('Location: index.php');