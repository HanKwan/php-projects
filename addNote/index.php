<?php

    // $connection = require_once './connection.php';
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
                    <form class="flex-column d-flex mt-3" action="">
                        <input class="mb-3" type="text" name="title" placeholder="Note Title">
                        <textarea name="body" id="" cols="25" rows="5" placeholder="Note Body"></textarea>
                    </form>
                </div>
                <div class="mt-4 bg-warning container py-2 rounded">
                    <h5>title</h5>
                    <p style="height: 60px;">body</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>