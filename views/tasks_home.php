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
        <h1 class="text-center">Tasks Home</h1>
        <?php
        if (isset($success_msg)) {
            echo '<p style="color: green">'.$success_msg.'</p>';
        }
        ?>
        <p><a href="<?= BASE_URL ?>tasks/create">Create Task</a></p>
        <table>
           <thead>
               <tr>
                   <th>Id</th>
                   <th>Task Title</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               <?php
               foreach($tasks as $task) {
                $edit_url = BASE_URL.'tasks/create/'.$task['id'];
                ?>
               <tr>
                   <td><?= $task['id'] ?></td>
                   <td><?= $task['task_title'] ?></td>
                   <td><?= anchor($edit_url, 'Edit') ?></td>
               </tr>
                <?php
               }
               ?>
           </tbody>
        </table>
    </div>
</body>
</html>