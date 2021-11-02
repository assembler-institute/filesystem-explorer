<?php
session_start();


if (isset($_REQUEST["valid"])) {


  // $split = explode("/", $_SESSION['tmpPath']);
  $oldPath = basename($_SESSION['tmpPath']);
  $oldFile = realpath(dirname($_SESSION["tmpPath"] . '/' . $oldPath));
  $newPath = substr($oldFile, 0, -strlen($oldPath));
  // foreach ($split as $path) {
  //   $newPath .= $path . "/";
  // }
  $newPath .= $_POST['editFolderName'];
  $newFile = $newPath;
  rename($oldFile, $newFile);
}
echo $_SESSION['path'];
