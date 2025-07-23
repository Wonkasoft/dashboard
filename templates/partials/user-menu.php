<?php
// templates/partials/user-menu.php
?>
<ul class="nav navbar-nav navbar-right navbar-user">
    <!-- Messages Dropdown -->
    <li class="dropdown messages-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope"></i> Messages 
            <span class="badge">0</span> 
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li class="dropdown-header">No New Messages</li>
            <li class="divider"></li>
            <li><a href="#">View Inbox <span class="badge">0</span></a></li>
        </ul>
    </li>

    <!-- Alerts Dropdown -->
    <li class="dropdown alerts-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell"></i> Alerts 
            <span class="badge">0</span> 
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#">No new alerts</a></li>
            <li class="divider"></li>
            <li><a href="#">View All</a></li>
        </ul>
    </li>

    <!-- User Dropdown -->
    <li class="dropdown user-dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-user"></i> Devturtle 
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">0</span></a></li>
            <li><a href="../phpmyadmin" target="_blank"><i class="fa fa-gear"></i> PHPmyAdmin</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
    </li>
</ul>
