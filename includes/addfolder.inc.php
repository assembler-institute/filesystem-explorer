<?php
session_start();
require_once('dbh.inc.php');

if (isset($_POST["addfolder"])) {
  if (isset($_GET["directory"]) && $_GET["directory"] !== "" && $_GET["directory"] !== "root") {
    $mkdirRoute = $_GET["directory"];
  } else {
    $mkdirRoute = "../root";
  }
  mkdir($mkdirRoute . "/" . $_POST["addfolder"], 0777, true);
  if (PHP_OS !== "WINNT") {
    chmod($mkdirRoute . "/" . $_POST["addfolder"], 0777);
  }
}


$modified = date("Y-m-d", filemtime($mkdirRoute . "/" . $_POST["addfolder"]));
$creation = date("Y-m-d", filectime($mkdirRoute . "/" . $_POST["addfolder"]));
$fileName = $_POST["addfolder"];


// prepare to upload to db 

$uploadQuery = $db->prepare("
INSERT INTO `files`(`name`, `size`, `modified`, `creation`, `extension`, `path`, `daddyPath`) 
  VALUES (:name, :size, :modified, :creation, :extension, :path, :daddyPath);
");

//encryptfunction 
$uploadQuery->execute([
  "name" => $_POST["addfolder"],
  "size" => 0,
  "modified" => $modified,
  "creation" => $creation,
  "extension" => "folder",
  "path" => $mkdirRoute . "/" . $_POST["addfolder"],
  "daddyPath" => $mkdirRoute
]);

$_SESSION["directory"] = $mkdirRoute;


if ($_GET["directory"] == "root") {
  header("location: ../index.php");
} else {
  header("location: ../lower.php?pathLower=$mkdirRoute");
}
