<?php
// includes/models/Task.php
class Task {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getOpenTasksCount() {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM tasks WHERE is_completed = 0");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            error_log('Error fetching open tasks: ' . $e->getMessage());
            return 0;
        }
    }
}
?>
