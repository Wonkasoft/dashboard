<?php
// templates/components/navigation.php - Updated to properly link to projects.php
function renderNavigation($currentPage = 'dashboard') {
    $navItems = [
        'dashboard' => ['icon' => 'fa-dashboard', 'label' => 'Dashboard', 'file' => 'index.php'],
        'todo' => ['icon' => 'fa-list', 'label' => 'To Do', 'file' => 'todo.php'],
        'reports' => ['icon' => 'fa-bar-chart-o', 'label' => 'Reports', 'file' => 'reports.php'],
        'projects' => ['icon' => 'fa-table', 'label' => 'Projects', 'file' => 'projects.php'],
        'style-guides' => ['icon' => 'fa-edit', 'label' => 'Style Guides', 'file' => 'style-guides.php'],
        'fonts' => ['icon' => 'fa-font', 'label' => 'Font Assets', 'file' => 'fonts.php'],
        'uptime' => ['icon' => 'fa-desktop', 'label' => 'Uptime Status', 'file' => 'uptime.php'],
        'settings' => ['icon' => 'fa-wrench', 'label' => 'Settings', 'file' => 'settings.php'],
        'scripts' => ['icon' => 'fa-file', 'label' => 'Scripts', 'file' => 'scripts.php']
    ];
    ?>
    <ul class="nav navbar-nav side-nav">
        <?php foreach ($navItems as $key => $item): ?>
            <li class="<?php echo $currentPage === $key ? 'active' : ''; ?>">
                <a href="<?php echo $item['file']; ?>">
                    <i class="fa <?php echo $item['icon']; ?>"></i> 
                    <?php echo $item['label']; ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- Dropdown menu -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-caret-square-o-down"></i> Misc Settings 
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">Server Info</a></li>
                <li><a target="_blank" href="./phpinfo.php">PHP Info</a></li>
                <li><a target="_blank" href="../phpmyadmin">Database Manager</a></li>
                <li><a href="#">Logs</a></li>
            </ul>
        </li>
    </ul>
    <?php
}
?>