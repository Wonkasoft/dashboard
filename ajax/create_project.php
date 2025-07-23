<?php
// ajax/create_project.php
header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['type'])) {
    $projectName = $_POST['name'];
    $projectType = $_POST['type'];

    // Validate project name
    if (preg_match('/^[a-zA-Z0-9_-]+$/', $projectName)) {
        $projectPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectName;

        if (!is_dir($projectPath)) {
            // Create project directory
            if (mkdir($projectPath, 0755, true)) {
                // Create initial files based on project type
                switch ($projectType) {
                    case 'wordpress':
                        // You'd implement WordPress installation here
                        file_put_contents($projectPath . '/index.php', '<?php // WordPress project ?>');
                        break;
                    case 'php':
                        file_put_contents($projectPath . '/index.php', '<?php echo "New PHP Project"; ?>');
                        break;
                    case 'html':
                        file_put_contents($projectPath . '/index.html', '<!DOCTYPE html><html><head><title>New Project</title></head><body><h1>New HTML Project</h1></body></html>');
                        break;
                    default:
                        file_put_contents($projectPath . '/index.html', '<!DOCTYPE html><html><head><title>New Project</title></head><body><h1>New Project</h1></body></html>');
                }

                $response['success'] = true;
                $response['message'] = 'Project created successfully';
            } else {
                $response['message'] = 'Failed to create project directory';
            }
        } else {
            $response['message'] = 'Project already exists';
        }
    } else {
        $response['message'] = 'Invalid project name. Use only letters, numbers, hyphens, and underscores.';
    }
} else {
    $response['message'] = 'Missing required fields';
}

echo json_encode($response);
?>
