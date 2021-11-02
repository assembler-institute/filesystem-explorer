<?php
session_start();
if (isset($_REQUEST["valid"])) {
  $folder = $_POST["path"];
  $directory = $folder;
  $scanned_directory = array_diff(scandir($directory), array('..', '.'));

  if ($_POST["path"] !== '/xampp/htdocs/filesystem-explorer/src/UNIT') {
    echo '<li class="folder-tree-folder back" data-dir="' . dirname($_SESSION['path'], 1) . '">BACK</li>';
  }
  foreach ($scanned_directory as $dir) {
    if (is_dir("$directory/$dir")) {
      echo "<li class='folder-tree-folder' data-dir='$folder/$dir'><img class='folder-icon' src='img/folder.svg' />$dir</li>";
    } else {
      echo "<li class='folder-tree-file file-info' data-dir='$folder/$dir'><img class='folder-icon' src='img/file-icon.svg' />$dir</li>";
    }
  };
}
