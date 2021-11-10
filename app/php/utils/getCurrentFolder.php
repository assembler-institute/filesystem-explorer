<?php
session_start();
if (isset($_POST['filePath'])) {
	$path = $_POST['filePath'];
	echo $path;
	$_SESSION["folderPath"] = $path;
}
