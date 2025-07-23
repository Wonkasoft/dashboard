<?php
// templates/partials/dashboard-widgets.php
?>
<div class="row">
    <!-- Traffic Sources Widget -->
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-long-arrow-right"></i> 
                    Traffic Sources: <?php echo date('F j, Y'); ?>
                </h3>
            </div>
            <div class="panel-body">
                <div id="morris-chart-donut"></div>
                <div class="text-right">
                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Widget -->
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-clock-o"></i> Recent Activity
                </h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <span class="badge">just now</span>
                        <i class="fa fa-calendar"></i> Calendar updated
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">4 minutes ago</span>
                        <i class="fa fa-comment"></i> Commented on a post
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">23 minutes ago</span>
                        <i class="fa fa-truck"></i> Order 392 shipped
                    </a>
                    <a href="#" class="list-group-item">
                        <span class="badge">46 minutes ago</span>
                        <i class="fa fa-money"></i> Invoice 653 has been paid
                    </a>
                </div>
                <div class="text-right">
                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Widget -->
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-money"></i> Recent Transactions
                </h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped tablesorter">
                        <thead>
                            <tr>
                                <th>Order # <i class="fa fa-sort"></i></th>
                                <th>Date <i class="fa fa-sort"></i></th>
                                <th>Amount <i class="fa fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // This would normally come from database
                            $transactions = [
                                ['id' => '3326', 'date' => '10/21/2023', 'amount' => '$321.33'],
                                ['id' => '3325', 'date' => '10/21/2023', 'amount' => '$234.34'],
                                ['id' => '3324', 'date' => '10/21/2023', 'amount' => '$724.17'],
                                ['id' => '3323', 'date' => '10/21/2023', 'amount' => '$23.71'],
                                ['id' => '3322', 'date' => '10/21/2023', 'amount' => '$8345.23']
                            ];

                            foreach ($transactions as $transaction): ?>
                                <tr>
                                    <td><?php echo $transaction['id']; ?></td>
                                    <td><?php echo $transaction['date']; ?></td>
                                    <td><?php echo $transaction['amount']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
