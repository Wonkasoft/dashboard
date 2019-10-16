<?php
/**
 * handle ajax request for deleting directory
 * @since 1.0.0
 * 
 */
echo "Processing . . .  ";
if ( isset( $_POST['del_dir'] ) ) {
	$del_dir = $_POST['del_dir'];
	$path = '/opt/lampp/htdocs/'.$del_dir;
	chdir($path);
	$output = shell_exec('php --version 2>&1');
	echo $output;
	// shell_exec('rm -r /opt/lampp/htdocs/'.$del_dir);
	echo " Deleting  ". $_POST['del_dir'];
}