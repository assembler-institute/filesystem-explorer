<?php
session_start();
$newPath = $_SESSION['path'] . "/" . $_POST["newFolderName"];

if (isset($_REQUEST["valid"])) {
  if (!mkdir($newPath, 0777, true)) {
    die('error trying to create de new folder...');
  }
}

echo $_SESSION['path'];
