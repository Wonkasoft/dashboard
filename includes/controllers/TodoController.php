<?php
class TodoController {
    private Task $taskModel;

    public function __construct(PDO $db) {
        $this->taskModel = new Task($db);
    }

    public function handleActions(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
            $this->taskModel->addTask(trim($_POST['task']));
            $this->redirect();
        }

        if (isset($_GET['complete'])) {
            $this->taskModel->completeTask((int) $_GET['complete']);
            $this->redirect();
        }

        if (isset($_GET['delete'])) {
            $this->taskModel->deleteTask((int) $_GET['delete']);
            $this->redirect();
        }
    }

    public function getOpenTasks(): array {
        return $this->taskModel->getTasks(false);
    }

    public function getCompletedTasks(): array {
        return $this->taskModel->getTasks(true);
    }

    private function redirect(): void {
        header('Location: todo.php');
        exit();
    }
}
