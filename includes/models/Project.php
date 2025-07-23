<?php
// includes/models/Project.php - Updated with WordPress detection
class Project {
    private $excludedDirs = ['dashboard', 'webalizer', 'img', 'xampp', 'phpmyadmin', 'backups'];

    public function getProjects() {
        $projects = [];
        $baseDir = $_SERVER['DOCUMENT_ROOT'];
        $directories = glob($baseDir . '/*', GLOB_ONLYDIR);

        foreach ($directories as $dir) {
            $projectName = basename($dir);

            if (!in_array($projectName, $this->excludedDirs)) {
                $isWordPress = $this->isWordPressProject($dir);

                $projects[] = [
                    'name' => $projectName,
                    'path' => '/' . $projectName,
                    'admin_path' => '/' . $projectName . '/wp-admin/',
                    'is_wordpress' => $isWordPress,
                    'type' => $this->detectProjectType($dir),
                    'size' => $this->getDirectorySize($dir),
                    'modified' => filemtime($dir)
                ];
            }
        }

        return $projects;
    }

    private function isWordPressProject($dir) {
        // Check for wp-content folder
        return is_dir($dir . '/wp-content');
    }

    private function detectProjectType($dir) {
        if ($this->isWordPressProject($dir)) {
            return 'wordpress';
        } elseif (file_exists($dir . '/index.php')) {
            return 'php';
        } elseif (file_exists($dir . '/index.html')) {
            return 'html';
        }
        return 'unknown';
    }

    private function getDirectorySize($dir) {
        $size = 0;
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($dir),
            RecursiveIteratorIterator::LEAVES_ONLY,
            RecursiveIteratorIterator::CATCH_GET_CHILD
        );

        foreach ($files as $file) {
            try {
                if ($file->isFile()) {
                    $size += $file->getSize();
                }
            } catch (Exception $e) {
                // Skip files that can't be accessed
                continue;
            }
        }

        return $size;
    }
}
?>
