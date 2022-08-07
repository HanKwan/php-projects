<?php
    $connection = require_once './connection.php';
    
    $notes = $connection->getNotes();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Add Note</title>
</head>
<body>
    <div class="container mt-5">
        <div class="justify-content-center row">
            <div class="col-5">
                <div>
                    <h3>Add Notes For Better Days :)</h3>
                    <form class="flex-column d-flex mt-3" action="save.php" method="post">
                        <input class="mb-1" type="text" name="title" placeholder="Note Title">
                        <textarea name="body" name="body" cols="25" rows="5" placeholder="Note Body"></textarea>
                        <button class="btn mt-2 btn-primary">Add Note</button>
                    </form>
                </div>
                <?php foreach($notes as $note): ?>
                    <div class="mt-4 bg-warning container py-1 rounded">
                        <div class="d-flex justify-content-between">
                            <h5><?php echo $note['title'] ?></h5>                       <!-- don't just keep forgetting to echo ~.~ -->
                            <form action="delete.php" method="post">
                                <input type="hidden" value="<?php echo $note['id'] ?>" name="deleteId">
                                <button class="border-0 bg-warning cursor-pointer">x</button>
                            </form>
                        </div>
                        <p><?php echo $note['body'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>