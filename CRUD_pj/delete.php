<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud01', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'] ?? null;

    if (!($id)) {
        header('Location: pj.php');
        exit;
    }
    var_dump($id);

    $statement = $pdo->prepare('DELETE FROM products WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('Location: pj.php');
?>