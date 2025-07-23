<?php
// ajax/delete_project.php
header('Content-Type: application/json');

// This is a basic example - add proper authentication and validation
$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project'])) {
    $projectName = $_POST['project'];

    // Validate project name
    if (preg_match('/^[a-zA-Z0-9_-]+$/', $projectName)) {
        // Add your actual delete logic here
        // For safety, you might want to move to a trash folder instead
        $projectPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $projectName;

        if (is_dir($projectPath)) {
            // Create a backup before deleting
            $backupPath = $_SERVER['DOCUMENT_ROOT'] . '/backups/' . $projectName . '_' . date('Y-m-d_H-i-s');

            // This is where you'd implement the actual deletion
            // For now, just return success
            $response['success'] = true;
            $response['message'] = 'Project deleted successfully';
        } else {
            $response['message'] = 'Project not found';
        }
    } else {
        $response['message'] = 'Invalid project name';
    }
} else {
    $response['message'] = 'Invalid request';
}

echo json_encode($response);
?>
