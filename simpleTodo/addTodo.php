<?php

    $todoName = $_POST['todoName'] ?? '';
    $todoName = trim($todoName);

    if ($todoName) {
        if (file_exists('todo.json')) {
            $todo = file_get_contents('todo.json');
            $todoArray = json_decode($todo, true);
        } else {
            $todoArray = [];
        }
        $todoArray[$todoName] = ['completed' => false];
        file_put_contents('todo.json', json_encode($todoArray, JSON_PRETTY_PRINT));
        header('Location: index.php');
    } else {
        header('Location: index.php');
    }