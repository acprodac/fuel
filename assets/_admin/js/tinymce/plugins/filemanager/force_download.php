<?php

$saveSess = session_save_path();

if(!file_exists($saveSess)){
	session_save_path('/home/cecreb2/tmp');
}

session_start();
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbiden');
include('config/config.php');

$path=$_POST['path'];
$name=$_POST['name'];

$path_pos=strpos($path,$current_path);
if($path_pos!=0 || strpos($path,'../',strlen($current_path)+$path_pos)!==FALSE)
    die('wrong path');

header('Pragma: private');
header('Cache-control: private, must-revalidate');
header("Content-Type: application/octet-stream");
header("Content-Length: " .(string)(filesize($path)) );
header('Content-Disposition: attachment; filename="'.($name).'"');
readfile($path);
exit;
?>