<?php 
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=product_crud', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $id = $_GET['id'] ?? null;

    if (!$id) {
        header('Location: pj.php');
        exit;
    }

    $statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    $ERROR = [];
    $title = $product['title'];
    $description = $product['description'];
    $prize = $product['prize'];
 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $prize = $_POST['prize'];

        if (!$title) {                              //error function should be above execution
            $ERROR[] = 'title is required';
        }
        if (!$prize) {
            $ERROR[] = 'prize is required';
        }
        if (!is_dir('images')) {
            mkdir('images');
        }

        if (empty($ERROR)) {
            $image = $_FILES['image'] ?? null;
            $imagePath = $imagePath;
            if ($image && $image['tmp_name']) {
                if ($product['image']) {
                    unlink($product['image']);
                }
                $imagePath = 'images/'.randomStr(8).'/'.$image['name'];
                mkdir(dirname($imagePath));
                move_uploaded_file($image['tmp_name'], $imagePath);
            }
            $statement = $pdo->prepare("UPDATE products SET image = :image, title = :title, description = :description, prize = :prize WHERE id = :id");
            $statement->bindValue(':image', $imagePath);
            $statement->bindValue(':title', $title);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':prize', $prize);
            $statement->bindValue(':id', $id);
            $statement->execute();
            header('Location: pj.php');
        };
    };
    function randomStr($n) {
        $charcaters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($charcaters) - 1);
            $str = $charcaters[$index];
        }
        return $str;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>product crud</title>
</head>
<body>
    <a href="pj.php">Back</a>
    <h1>Edit the item</h1>
    <?php if ($product['image']) { ?>
        <img src="<?php echo $product['image'] ?>" class="editImg">
    <?php } ?>
    <?php if (!empty($ERROR)) { ?>
        <div class="alert alert-danger">
            <?php foreach ($ERROR as $ERROR) { ?>
                <div><?php echo $ERROR ?></div>
            <?php } ?>
        </div>
    <?php } ?>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">image</label>
            <input type="file" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">title</label>
            <input type="text" name="title" value="<?php echo $product['title'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">description</label>
            <textarea class="form-control" value="<?php $product['description'] ?>" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">prize</label>
            <input type="number" class="form-control" step=".01" value="<?php $product['prize'] ?>" name="prize">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>