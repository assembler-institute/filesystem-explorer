<?php
session_start();

$directory = $_SESSION["tmpPath"];

function rrmdir($dir)
{
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (is_dir($dir . "/" . $object) && !is_link($dir . "/" . $object))
          rrmdir($dir . "/" . $object);
        else
          unlink($dir . "/" . $object);
      }
    }
    rmdir($dir);
  } else {
    unlink($dir);
  }
}

rrmdir($directory);

echo $_SESSION["path"];
