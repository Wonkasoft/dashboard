<?php
// index.php - Clean and refactored dashboard
require_once 'config.php';
require_once INCLUDES_PATH . '/Database.php';
require_once INCLUDES_PATH . '/models/Task.php';
require_once INCLUDES_PATH . '/models/Project.php';
require_once INCLUDES_PATH . '/controllers/DashboardController.php';

// Initialize controller and get data
$dashboardController = new DashboardController();
$dashboardData = $dashboardController->getDashboardData();

// Include template components
require_once TEMPLATES_PATH . '/components/navigation.php';
require_once TEMPLATES_PATH . '/components/stats-card.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo APP_NAME; ?></title>

    <!-- CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="//cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include TEMPLATES_PATH . '/partials/header.php'; ?>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php renderNavigation('dashboard'); ?>
                <?php include TEMPLATES_PATH . '/partials/user-menu.php'; ?>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <!-- Page Header -->
            <div class="row">
                <div class="col-lg-12">
                    <h1>Dashboard <small>Statistics Overview</small></h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> 
                            <?php echo APP_NAME; ?> Dashboard v<?php echo APP_VERSION; ?>
                        </li>
                    </ol>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <?php
                renderStatsCard('info', 'fa-comments', $dashboardData['stats']['mentions'], 
                    'New Mentions!', '#', 'View Mentions');

                renderStatsCard('warning', 'fa-check', $dashboardData['openTasksCount'], 
                    'To-Do Items', 'todo.php', 'Complete Tasks');

                renderStatsCard('danger', 'fa-tasks', $dashboardData['stats']['crawl_errors'], 
                    'Crawl Errors', '#', 'Fix Issues');

                renderStatsCard('success', 'fa-comments', $dashboardData['stats']['new_orders'], 
                    'New Orders!', '#', 'Complete Orders');
                ?>
            </div>

            <!-- Projects Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-bar-chart-o"></i> Development Projects
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php foreach ($dashboardData['projects'] as $project): ?>
                                    <div class="col-lg-4 project-item">
                                        <h3><?php echo htmlspecialchars($project['name']); ?></h3>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo $project['path']; ?>" 
                                               class="btn btn-sm btn-primary">View Site</a>
                                            <a href="<?php echo $project['admin_path']; ?>" 
                                               class="btn btn-sm btn-info">Admin Login</a>
                                            <a href="#" class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this project?')">
                                               Delete
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Dashboard Widgets -->
            <?php include TEMPLATES_PATH . '/partials/dashboard-widgets.php'; ?>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
</body>
</html>
