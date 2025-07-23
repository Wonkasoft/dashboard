<?php
// includes/models/Project.php
class Project {
    private $excludedDirs = ['dashboard', 'webalizer', 'img', 'xampp'];

    public function getProjects() {
        $projects = [];
        $baseDir = $_SERVER['DOCUMENT_ROOT'];
        $directories = glob($baseDir . '/*', GLOB_ONLYDIR);

        foreach ($directories as $dir) {
            $projectName = basename($dir);

            if (!in_array($projectName, $this->excludedDirs)) {
                $projects[] = [
                    'name' => $projectName,
                    'path' => '/' . $projectName,
                    'admin_path' => '/' . $projectName . '/wp-admin/'
                ];
            }
        }

        return $projects;
    }
}
?>
