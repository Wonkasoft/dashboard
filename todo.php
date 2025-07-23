<?php
require_once 'config.php';
require_once INCLUDES_PATH . '/Database.php';
require_once INCLUDES_PATH . '/models/Task.php';
require_once INCLUDES_PATH . '/controllers/TodoController.php';
require_once TEMPLATES_PATH . '/components/navigation.php';

$db = Database::getInstance()->getConnection();
$controller = new TodoController($db);
$controller->handleActions();

$openTasks = $controller->getOpenTasks();
$completedTasks = $controller->getCompletedTasks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List - <?= APP_NAME ?></title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include TEMPLATES_PATH . '/partials/header.php'; ?>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php renderNavigation('todo'); ?>
                <?php include TEMPLATES_PATH . '/partials/user-menu.php'; ?>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container mt-5">
                <h2 class="text-center mb-4">To-Do List</h2>

                <form method="POST" class="input-group mb-3">
                    <input type="text" name="task" class="form-control" placeholder="Enter new task" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </span>
                </form>

                <h3>Open Tasks</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th>#</th><th>Task</th><th>Updated</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php if (count($openTasks) > 0): ?>
                            <?php foreach ($openTasks as $task): ?>
                                <tr>
                                    <td><?= $task['id'] ?></td>
                                    <td><?= htmlspecialchars($task['task']) ?></td>
                                    <td><?= date('M d, Y H:i', strtotime($task['timestamp'])) ?></td> <!-- Format timestamp -->
                                    <td>
                                        <a href="?complete=<?= $task['id'] ?>" class="btn btn-success btn-sm">Complete</a>
                                        <a href="?delete=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center">No open tasks!</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <h3>Completed Tasks</h3>
                <table class="table table-striped">
                    <thead>
                        <tr><th>#</th><th>Task</th><th>Updated</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php if (count($completedTasks) > 0): ?>
                            <?php foreach ($completedTasks as $task): ?>
                                <tr>
                                    <td><?= $task['id'] ?></td>
                                    <td><?= htmlspecialchars($task['task']) ?></td>
                                    <td><?= date('M d, Y H:i', strtotime($task['timestamp'])) ?></td> <!-- Format timestamp -->
                                    <td>
                                        <a href="?delete=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                             <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center">No completed tasks!</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>
