<?php
// config.php - Updated with better error handling
define('APP_NAME', 'TNR Media Server');
define('APP_VERSION', phpversion());

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'dashboard');
define('DB_USER', 'root');
define('DB_PASS', '');

// Development mode
define('DEV_MODE', true);

if (DEV_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Base paths
define('BASE_PATH', dirname(__FILE__));
define('INCLUDES_PATH', BASE_PATH . '/includes');
define('TEMPLATES_PATH', BASE_PATH . '/templates');

// Check if directories exist
if (!is_dir(TEMPLATES_PATH)) {
    mkdir(TEMPLATES_PATH, 0755, true);
    mkdir(TEMPLATES_PATH . '/partials', 0755, true);
    mkdir(TEMPLATES_PATH . '/components', 0755, true);
}

if (!is_dir(INCLUDES_PATH)) {
    mkdir(INCLUDES_PATH, 0755, true);
    mkdir(INCLUDES_PATH . '/models', 0755, true);
    mkdir(INCLUDES_PATH . '/controllers', 0755, true);
}
?>
