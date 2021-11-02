<?php
session_start();

$playExtensions = array("jpg", "jpeg", "png", "mp3", "mp4");

if (isset($_REQUEST["valid"])) {
  $path = $_POST["path"];

  echo "
  <div class='file-icon file-info " . extension($path) . "'></div>
  <div class='file-title-container file-info'>
    <div class='file-title file-info'>" . basename($path) . "</div>
    <div class='file-size-separator file-info'>-</div>
    <div class='file-size file-info'>" . size($path) . "</div>
  </div>
  <div class=''>Last modification: " . date("d F Y H:i:s.", filectime($path)) . "</div>
  <div class='file-url file-info'>" . $path . "</div>
  ";
  if (in_array(extension($path), $playExtensions)) {
    echo "<button id='play-file' data-dir='$path' style='margin: 1rem 0;'>OPEN</button>";
  }
  echo "<button id='delete-file' class='file-info' data-dir='$path'>DELETE FILE</button>
  ";
}

function extension($path)
{
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  switch ($ext) {
    case "doc":
      return "doc";
    case "csv":
      return "csv";
    case "jpg":
      return "jpg";
    case "jpeg":
      return "jpg";
    case "png":
      return "png";
    case "txt":
      return "txt";
    case "ppt":
      return "ppt";
    case "odt":
      return "odt";
    case "pdf":
      return "pdf";
    case "zip":
      return "zip";
    case "rar":
      return "rar";
    case "exe":
      return "exe";
    case "svg":
      return "svg";
    case "mp3":
      return "mp3";
    case "mp4":
      return "mp4";
    default:
      return "default-icon";
  }
}

function size($path)
{
  $bytes = filesize($path);
  $decimals = 0;
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}
