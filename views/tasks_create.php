<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/trongate.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>css/custom.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center"><?= $headline ?></h1>
        <?php
        if (isset($errors)) {
            foreach($errors as $error_msg) {
                echo '<p style="color:  red">'.$error_msg.'</p>';
            }
        }
        ?>
        <p><a href="<?= BASE_URL ?>tasks">Go Back</a></p>
        <form action="<?= $form_location ?>" method="post">
            <label>Task Title</label>
            <input type="text" name="task_title" value="<?= $task_title ?>" placeholder="Enter task title here..." autocomplete="off">
            <button type="submit" name="submit" value="Submit">Submit</button>
            <?php
            if ($update_id>0) {
                echo '<button type="submit" name="submit" class="danger" value="Delete">Delete</button>';
            }
            ?>
        </form>
    </div>
</body>
</html>
<?php
unset($_SESSION['errors']);
?>