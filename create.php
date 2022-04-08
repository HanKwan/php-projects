<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud01', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $errors = [];
    $title = '';
    $description = '';
    $prize = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];    
        $description = $_POST['description'];    
        $prize = $_POST['prize'];
        $date = date('Y-m-d H:i:s');
        if (empty($title)) {
            $errors[] = 'title is required';
        }
        if (empty($prize)) {
            $errors[] = 'prize is required';
        }
        if (!is_dir('images')) {
            mkdir('images');
        }
        if (empty($errors)) {
            $image = $_FILES['image'] ?? null;
            if ($image && $image['tmp-name']) {
                move_uploaded_file($image['tmp_name'], $imagePath);
            }
            $statement = $pdo->prepare("INSERT INTO products (image, title, description, prize, create_date)
                            VALUES (:image, :title, :description, :prize, :date)");
            $statement->bindValue(':image', '');
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':prize', $prize);
            $statement->bindValue(':date', $date);
            $statement->execute();
            header('Location: pj.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>
</head>
<body>
<form action="create.php" method="POST" enctype="multipart/form-data">
    <h2>Create new product</h2>
    <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $errors) {
                echo $errors;
            } ?>
        </div>
    <?php } ?>
    <div class="mb-3">
        <label for="image" class="form-label">image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">description</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="mb-3">
        <label for="prize" class="form-label">prize</label>
        <input type="number" class="form-control" name="prize">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>