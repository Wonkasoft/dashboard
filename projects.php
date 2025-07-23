<?php
// projects.php

require_once 'config.php';
require_once INCLUDES_PATH . '/Database.php';
require_once INCLUDES_PATH . '/models/Task.php';
require_once INCLUDES_PATH . '/models/Project.php';
require_once INCLUDES_PATH . '/controllers/DashboardController.php';

// Initialize controller and get data if needed
$dashboardController = new DashboardController();
$projects = $dashboardController->getDashboardData()['projects'];

// Include template components
require_once TEMPLATES_PATH . '/components/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - <?php echo APP_NAME; ?></title>

    <!-- CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <?php include TEMPLATES_PATH . '/partials/header.php'; ?>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php renderNavigation('projects'); ?>
                <?php include TEMPLATES_PATH . '/partials/user-menu.php'; ?>
            </div>
        </nav>

        <!-- Main Content -->
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Jumbotron Header -->
                <div class="jumbotron">
                    <h1 class="display-4">Projects</h1>
                    <p class="lead">Manage all your projects effortlessly from this dashboard.</p>

                    <!-- Search Feature -->
                    <form class="form-inline my-2 my-lg-0" id="searchForm">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search Projects" aria-label="Search" id="searchInput">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>

                <!-- Projects Grid -->
                <div class="row" id="projectsContainer">
                    <?php if (empty($projects)): ?>
                        <div class="col-lg-12">
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> No projects found. Create your first project!
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($projects as $project): ?>
                            <div class="col-lg-4 col-md-6 project-item" data-project-name="<?php echo strtolower($project['name']); ?>">
                                <div class="panel panel-primary project-card">
                                    <div class="panel-heading">
                                        <i class="fa fa-folder-open"></i> <?php echo htmlspecialchars($project['name']); ?>
                                        <?php if ($project['is_wordpress']): ?>
                                            <span class="label label-info pull-right">WordPress</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="project-stats">
                                            <small class="text-muted">
                                                <i class="fa fa-clock-o"></i> Last modified: <?php echo date('M d, Y', $project['modified']); ?>
                                                <br>
                                                <i class="fa fa-hdd-o"></i> Size: <?php echo formatBytes($project['size']); ?>
                                            </small>
                                        </div>

                                        <div class="project-actions">
                                            <div class="btn-group btn-group-justified" role="group">
                                                <a href="<?php echo $project['path']; ?>" 
                                                   class="btn btn-primary" target="_blank">
                                                    <i class="fa fa-eye"></i> View Site
                                                </a>
                                                <?php if ($project['is_wordpress']): ?>
                                                    <a href="<?php echo $project['admin_path']; ?>" 
                                                       class="btn btn-info" target="_blank">
                                                        <i class="fa fa-wordpress"></i> Admin
                                                    </a>
                                                <?php endif; ?>
                                                <a href="#" class="btn btn-danger"
                                                   onclick="deleteProject('<?php echo $project['name']; ?>')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </div>

                                            <?php if (!$project['is_wordpress']): ?>
                                                <!-- Additional actions for non-WordPress projects -->
                                                <div class="btn-group btn-group-justified" role="group" style="margin-top: 10px;">
                                                    <a href="#" class="btn btn-default btn-sm"
                                                       onclick="editProject('<?php echo $project['name']; ?>')">
                                                        <i class="fa fa-edit"></i> Edit Files
                                                    </a>
                                                    <a href="#" class="btn btn-default btn-sm"
                                                       onclick="backupProject('<?php echo $project['name']; ?>')">
                                                        <i class="fa fa-download"></i> Backup
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <!-- WordPress-specific actions -->
                                                <div class="btn-group btn-group-justified" role="group" style="margin-top: 10px;">
                                                    <a href="<?php echo $project['path']; ?>/wp-login.php" 
                                                       class="btn btn-default btn-sm" target="_blank">
                                                        <i class="fa fa-sign-in"></i> Login
                                                    </a>
                                                    <a href="#" class="btn btn-default btn-sm"
                                                       onclick="backupProject('<?php echo $project['name']; ?>')">
                                                        <i class="fa fa-download"></i> Backup
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var input = document.getElementById('searchInput').value.toLowerCase();
            var projectItems = document.querySelectorAll('.project-item');

            projectItems.forEach(function(item) {
                var projectName = item.getAttribute('data-project-name');
                item.style.display = projectName.includes(input) ? '' : 'none';
            });
        });
    </script>
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

<?php
// Helper function to format file sizes
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}
?>
