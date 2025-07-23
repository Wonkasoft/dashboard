<?php
// templates/components/navigation.php
function renderNavigation($currentPage = 'dashboard') {
    $navItems = [
        'dashboard' => ['icon' => 'fa-dashboard', 'label' => 'Dashboard'],
        'reports' => ['icon' => 'fa-bar-chart-o', 'label' => 'Reports'],
        'projects' => ['icon' => 'fa-table', 'label' => 'Projects'],
        'style-guides' => ['icon' => 'fa-edit', 'label' => 'Style Guides'],
        'fonts' => ['icon' => 'fa-font', 'label' => 'Font Assets'],
        'uptime' => ['icon' => 'fa-desktop', 'label' => 'Uptime Status'],
        'settings' => ['icon' => 'fa-wrench', 'label' => 'Settings'],
        'scripts' => ['icon' => 'fa-file', 'label' => 'Scripts']
    ];
    ?>
    <ul class="nav navbar-nav side-nav">
        <?php foreach ($navItems as $key => $item): ?>
            <li class="<?php echo $currentPage === $key ? 'active' : ''; ?>">
                <a href="<?php echo $key; ?>.php">
                    <i class="fa <?php echo $item['icon']; ?>"></i> 
                    <?php echo $item['label']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
}
?>
