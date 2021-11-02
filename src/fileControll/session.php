<?php
session_start();

if (isset($_REQUEST["tmpPath"])) {
  if (isset($_POST["path"])) {
    $_SESSION["tmpPath"] = $_POST["path"];
    $sessionPath = $_SESSION["tmpPath"];
  } else {
    $sessionPath = $_SESSION["tmpPath"];
  }
} else {
  if (isset($_SESSION["path"])) {
    if (isset($_REQUEST["valid"])) {
      $_SESSION["prevPath"] = $_SESSION["path"];
      $_SESSION["path"] = $_POST["path"];
      $sessionPath = $_SESSION["path"];
    }
  } else {
    $_SESSION["prevPath"] = "";
    $_SESSION["path"] = '/xampp/htdocs/filesystem-explorer/src/UNIT';
    $sessionPath = $_SESSION["path"];
  }

  $sessionPath = $_SESSION["path"];
}

echo $sessionPath;
