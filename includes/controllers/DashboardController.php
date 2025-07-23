<?php
// includes/controllers/DashboardController.php
class DashboardController {
    private $taskModel;
    private $projectModel;

    public function __construct() {
        $db = Database::getInstance()->getConnection();
        $this->taskModel = new Task($db);
        $this->projectModel = new Project();
    }

    public function getDashboardData() {
        return [
            'openTasksCount' => $this->taskModel->getOpenTasksCount(),
            'projects' => $this->projectModel->getProjects(),
            'stats' => $this->getStats()
        ];
    }

    private function getStats() {
        return [
            'mentions' => 0,
            'crawl_errors' => 0,
            'new_orders' => 0
        ];
    }
}
?>
