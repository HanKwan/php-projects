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
    <title>Simple todo</title>
</head>
<body>
    <form action="addTodo.php" method="post">
        <input type="text" name="todoName">
        <button>Add todo</button>
    </form>
    <div style="margin-top: 20px;">
        <?php foreach ($todos as $todoName => $todo): ?>
            <div style="margin-bottom: 10px;">
                <form action="check.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="checking" value="<?php echo $todoName ?>">
                    <input type="checkbox" class="checkTodo" <?php echo $todo['completed'] ? 'checked' : '' ?>>
                </form>
        
                <?php echo $todoName ?>

                <form style="display: inline-block; margin-left: 30px;" action="delete.php" method="post">
                    <input type="hidden" name="deleteTodo" value="<?php echo $todoName ?>">    <!-- don't forget to echo -->
                    <button>Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
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