<?php
include "utils/getFilePath.php";
session_start();
if (isset($_POST['newFolderName'])) {
	$newFolderName = $_POST['newFolderName'];
	$path = $_SESSION['folderPath'];
	$path = getFilePath($path);
	$path = $path . '/' . $newFolderName;
	mkdir($path, 0777, true);
	echo $response;
} else {
	$response = false;
}
