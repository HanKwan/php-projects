<?php
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud01', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $search = $_GET['search'] ?? '';
  if ($search) {
    $statement = $pdo->prepare("SELECT * FROM products  WHERE title LIKE :title ORDER BY create_date DESC");
    $statement->bindValue(':title', "%$search%");  
  } else {
    $statement = $pdo->prepare("SELECT * FROM products ORDER BY create_date DESC");
  }

  $statement->execute();
  $product = $statement->fetchAll(PDO::FETCH_ASSOC);
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
  <h2>Products table</h2>
  <a href="create.php" class="btn btn-success">Create new product</a>
  <form action="pj.php" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" value="<?php echo $search ?>" class="form-control" placeholder="search">
      <button type="submit" class="input-group-text">search</button>
    </div>
  </form>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">image</th>
        <th scope="col">title</th>
        <th scope="col">description</th>
        <th scope="col">prize</th>
        <th scope="col">date</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($product as $i => $product) { ?>
        <tr>
          <th scope="row"><?php echo $i + 1 ?></th>
          <td>
            <img src="<?php echo $product['image'] ?>" class="displayImg">
          </td>
          <td><?php echo $product['title'] ?></td>
          <td><?php echo $product['description'] ?></td>
          <td><?php echo $product['prize'] ?></td>
          <td><?php echo $product['create_date'] ?></td>
          <td>
            <a href="edit.php?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-success">edit</a>
            <form action="delete.php" method="post"> <!-- NEED TO WRITE METHOD WITH LOWERCASSE -->
              <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
              <button type="submit" class="btn btn-sm btn-outline-dark">delete</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>