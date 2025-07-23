<?php
class Task {
    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function getTasks(bool $completed = false): array {
        $stmt = $this->conn->prepare("SELECT * FROM todo WHERE is_completed = :completed");
        $stmt->execute(['completed' => $completed ? 1 : 0]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

        public function getOpenTasksCount(): int {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM todo WHERE is_completed = 0");
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

  public function addTask(string $task): bool {
    $stmt = $this->conn->prepare("INSERT INTO todo (task, is_completed) VALUES (:task, 0)");
    return $stmt->execute(['task' => $task]);
}


    public function completeTask(int $id): bool {
        $stmt = $this->conn->prepare("UPDATE todo SET is_completed = 1 WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function deleteTask(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM todo WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
