<?php
include "./utils/getFilePath.php";

//? incoming file
$file = '/' . $_POST['file'];
$newName = $_POST['newName'];

$fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
$newName = substr($newName, 1);


//? File path
$oldFilePath = getFilePath($file);
$newFilePath = dirname($oldFilePath) . '/' .  $newName . '.' . $fileType;

//? New file path
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	$oldFilePath =  str_replace('/', '\\', $oldFilePath);
	$newFilePath = str_replace('/', '\\', $newFilePath);
} else {
	$newName = substr($newName, 1);
	$oldFilePath = getFilePath($file);
	$newFilePath = dirname($oldFilePath) . '/' .  $newName . '.' . $fileType;
}

//? Change Name
if ($_POST['oldName'] !== $_POST['newName']) {
	rename($oldFilePath,  $newFilePath);
	echo $response = true;
} else {
	$response = false;
}
