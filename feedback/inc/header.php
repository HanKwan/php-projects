<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=product_feedback', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <nav class="navBar">
            <div class="container">
                <h2>Product</h2>
                <ul class="ulist">
                    <a class="aLink" href="home.php"><li class="link">Home</li></a>
                    <a class="aLink" href="review.php"><li class="link">Feedback</li></a>
                    <a class="aLink" href="#"><li class="link">About</li></a>
                </ul>
            </div>
        </nav>
    </header>