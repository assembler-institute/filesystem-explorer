<?php

require_once("./dbh.inc.php");
$oldPath = $_GET["directory"];
$newPath = dirname($oldPath);
$newName = $_POST["title"];
$id = $_GET["id"];
$extension = $_GET["extension"];

$edittitleQuery = $db->prepare("
  UPDATE `files` SET `name`=:name,`path`=:path, `edit`=:edit WHERE `id`=:id
  ");

$edittitleQuery->execute([
  "name" => $newName,
  "id" => $id,
  "edit" => 0,
  "path" => $newPath . "/" . $newName . "." . $extension
]);

rename($oldPath, $newPath . "/" . $newName . "." . $extension);

$url = $_SERVER['HTTP_REFERER'];
header("Location: $url");
