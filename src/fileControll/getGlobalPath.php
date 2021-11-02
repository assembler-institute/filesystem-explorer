<?php
session_start();
if (isset($_REQUEST["valid"])) {
  $basePath = "/xampp/htdocs/filesystem-explorer/src/";
  $path = $_SESSION["tmpPath"];
  $tmpPath = similar_text($path, $basePath);
  $newPath = substr($path, $tmpPath);

  echo $newPath;
}
