<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Handle task completion
if (isset($_GET['complete'])) {
    $id = intval($_GET['complete']);
    $conn->query("UPDATE tasks SET is_completed = 1 WHERE id = $id");
    header('Location: todo.php'); // Redirect to avoid form resubmission
    exit();
}

// Handle task deletion
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM tasks WHERE id = $id");
    header('Location: todo.php'); // Redirect to avoid form resubmission
    exit();
}

// Handle adding a new task via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = $conn->real_escape_string($_POST['task']);
    $conn->query("INSERT INTO tasks (task) VALUES ('$task')");
    header('Location: todo.php'); // Redirect to avoid form resubmission
    exit();
}

// Fetch open and completed tasks
$openTasks = $conn->query("SELECT * FROM tasks WHERE is_completed = 0");
$completedTasks = $conn->query("SELECT * FROM tasks WHERE is_completed = 1");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP To-Do List</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>

<div id="wrapper">

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">Wonkasoft Version <?php echo phpversion(); ?></a>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active"><a href="todo.php"><i class="fa fa-check"></i> Todos</a></li>
                <li><a href="charts.html"><i class="fa fa-bar-chart-o"></i> Reports</a></li>
                <li><a href="tables.html"><i class="fa fa-table"></i> Projects</a></li>
                <li><a href="forms.html"><i class="fa fa-edit"></i> Style Guides</a></li>
                <li><a href="typography.html"><i class="fa fa-font"></i> Font Assets</a></li>
                <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Uptime Status</a></li>
                <li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Settings</a></li>
                <li><a href="blank-page.html"><i class="fa fa-file"></i> Scripts</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> Devturtle <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Inbox</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="page-wrapper">
        <div class="container mt-5">
            <h2 class="text-center mb-4">To-Do List</h2>

            <!-- Form to Add Task -->
            <form method="POST" class="input-group">
                <input type="text" name="task" class="form-control" placeholder="Enter new task" required>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </span>
            </form>

            <!-- Open Tasks Table -->
            <h3>Open Tasks</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($openTasks->num_rows > 0): ?>
                        <?php while ($task = $openTasks->fetch_assoc()): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= htmlspecialchars($task['task']) ?></td>
                                <td>
                                    <a href="?complete=<?= $task['id'] ?>" class="btn btn-success btn-sm">Complete</a>
                                    <a href="?delete=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No open tasks!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Completed Tasks Table -->
            <h3>Completed Tasks</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($completedTasks->num_rows > 0): ?>
                        <?php while ($task = $completedTasks->fetch_assoc()): ?>
                            <tr>
                                <td><?= $task['id'] ?></td>
                                <td><?= htmlspecialchars($task['task']) ?></td>
                                <td>
                                    <a href="?delete=<?= $task['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No completed tasks!</td>
                        </tr>
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
