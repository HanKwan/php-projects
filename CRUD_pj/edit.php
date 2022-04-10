<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud01', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $id = $_GET['id'];
    if (!$id) {
        header('Location: pj.php');
    }

    $statement = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    $errors = [];
    $title = $product['title'];
    $description = $product['description'];
    $prize = $product['prize'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];    
        $prize = $_POST['prize'];
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
            $imagePath = '';
            if ($image) {
                unlink($product['image']);
            }
            if ($image && $image['tmp_name']) {
                $imagePath = 'images/'.randomStr().'/'.$image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);
            }
            $statement = $pdo->prepare("UPDATE products SET title = :title, image = :image, description = :description, prize = :prize");
            $statement->bindValue(':image', $imagePath);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':prize', $prize);
            $statement->execute();
            header('Location: pj.php');
        }
    }
    function randomStr() {
        $keylength = 5;
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = substr(str_shuffle($str), 0, $keylength);
        return $randString;
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
    <?php if ($product['image']) { ?>
        <img src="<?php echo $product['image'] ?>" class="editImg">
    <?php } ?>
    <h2>Edit product</h2>
    <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $errors) {
                echo $errors.'<br>';
            } ?>
        </div>
    <?php } ?>
    <div class="mb-3">
        <label for="image" class="form-label">image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">title</label>
        <input type="text" class="form-control" value="<?php echo $title ?>" name="title">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">description</label>
        <textarea class="form-control" name="description" value="<?php echo $description ?>"></textarea>
    </div>
    <div class="mb-3">
        <label for="prize" class="form-label">prize</label>
        <input type="number" class="form-control" name="prize" value="<?php echo $prize ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>