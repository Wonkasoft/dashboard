<?php

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
            <div class="row">
<!-- Container to center the card -->
<div style="width: 100%; text-align: center; margin-bottom: 10px;">
  <div class="card" style="display: inline-block; width: 400px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
    <div class="card-header" style="background-color: #007bff; color: white; padding: 10px;">
      <strong>Real-Time Clock</strong>
    </div>
    <div class="card-body" style="padding: 20px;">
      <h3 id="realTimeClock"><?php echo date("h:i:s A"); ?></h3>
      <p class="text-muted" id="realDate"><?php echo date("l, F j, Y"); ?></p>
    </div>
  </div>
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

            <!-- Dashboard Widgets (Activity, Transactions, etc.) -->
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
    <script>
function updateClock() {
    const now = new Date();
    const time = now.toLocaleTimeString('en-US', { hour12: true });
    const date = now.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    document.getElementById('realTimeClock').textContent = time;
    document.getElementById('realDate').textContent = date;
}

setInterval(updateClock, 1000);
updateClock();
</script>
</body>
</html>