<?php
require_once("./dbh.inc.php");


if (isset($_GET["directory"]) && $_GET["directory"] !== "" && $_GET["directory"] !== "root") {
  $pathName = $_GET["directory"];
} else {
  $pathName = "../root";
}
$fileName = $_FILES["addfile"]["name"];
$fileType = $_FILES["addfile"]["type"];
$fileTmp = $_FILES["addfile"]["tmp_name"];
$fileSize = $_FILES["addfile"]["size"];

if (!file_exists("../root")) {
  echo "hola";
  mkdir($pathName, 0777, true);
  if (PHP_OS !== "WINNT") {
    echo "otra cosa";
    chmod("../root/", 0777);
  }
}

if (file_exists("../root") && move_uploaded_file($fileTmp, $pathName . "/" . $fileName)) {
  echo "Uploaded file";
} else {
  echo "File upload failed";
}



$file = $_FILES["addfile"];
$name = $file["name"];
$extension = pathinfo($name, PATHINFO_EXTENSION);
$size = $file["size"];
$modified = date("Y-m-d", filemtime($pathName . $fileName));
$creation = date("Y-m-d", filectime($pathName . $fileName));

// prepare to upload to db 

$uploadQuery = $db->prepare("
INSERT INTO `files`(`name`, `size`, `modified`, `creation`, `extension`, `path`, `daddyPath`) 
VALUES (:name, :size, :modified, :creation, :extension, :path, :daddyPath)
");


//encrypt

$uploadQuery->execute([
  "name" => $name,
  "size" => $size,
  "modified" => $modified,
  "creation" => $creation,
  "extension" => $extension,
  "path" => $pathName . "/" . $fileName,
  "daddyPath" => $pathName
]);


if ($_GET["directory"] == "root") {
  header("location: ../index.php");
} else {
  header("location: ../lower.php?pathLower=$pathName");
}
