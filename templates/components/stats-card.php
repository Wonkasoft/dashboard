<?php
// templates/components/stats-card.php
function renderStatsCard($type, $icon, $count, $label, $link = '#', $linkText = 'View Details') {
    $typeClasses = [
        'info' => 'panel-info',
        'warning' => 'panel-warning',
        'danger' => 'panel-danger',
        'success' => 'panel-success'
    ];

    $panelClass = isset($typeClasses[$type]) ? $typeClasses[$type] : 'panel-default';
    ?>
    <div class="col-lg-3">
        <div class="panel <?php echo $panelClass; ?>">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        <i class="fa <?php echo $icon; ?> fa-5x"></i>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="announcement-heading"><?php echo $count; ?></p>
                        <p class="announcement-text"><?php echo $label; ?></p>
                    </div>
                </div>
            </div>
            <a href="<?php echo $link; ?>">
                <div class="panel-footer announcement-bottom">
                    <div class="row">
                        <div class="col-xs-6"><?php echo $linkText; ?></div>
                        <div class="col-xs-6 text-right">
                            <i class="fa fa-arrow-circle-right"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
}
?>
