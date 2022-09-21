<?php

    $json = file_get_contents('todo.json');
    $todos = json_decode($json, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Simple todo</title>
</head>
<body class="container">
    <div class="mt-5 row justify-content-center">
        <div class="col-5">
            <form action="addTodo.php" method="post" class="align-items-center d-flex">
                <input type="text" name="todoName">
                <button class="ms-4 btn btn-primary btn-sm">Add todo</button>
            </form>
            <div class="mt-3">
                <?php foreach ($todos as $todoName => $todo): ?>
                    <div style="margin-bottom: 10px;">
                        <form action="check.php" method="post" style="display: inline-block;">
                            <input type="hidden" name="checking" value="<?php echo $todoName ?>">
                            <input type="checkbox" class="checkTodo" <?php echo $todo['completed'] ? 'checked' : '' ?>>
                        </form>
                
                        <div style="display: inline-block; margin-left: 5px;" class="w-75">
                            <div class="d-flex align-items-center justify-content-between">
                                <?php echo $todoName ?>

                                <form action="delete.php" method="post">
                                    <input type="hidden" name="deleteTodo" value="<?php echo $todoName ?>">    <!-- don't forget to echo -->
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<script>
    const checkBoxs = document.querySelectorAll('.checkTodo');
    checkBoxs.forEach(cb => {
        cb.onclick = function () {
            this.parentNode.submit();
        }
    })
</script>
</body>
</html>