<?php

function list_folders($dir)
{
  $files = array_diff(scandir($dir), [".", ".."]);

  if (count($files) < 1 && count($_SESSION["folders_paths"]) == 0) {
    // echo 'No folders';
    return;
  }

  if (count($_SESSION["folders_paths"]) == 0) {
    array_push($_SESSION["folders_paths"], $dir);
    if (count($_SESSION["folders_unfold"]) == 0) {
      array_push($_SESSION["folders_unfold"], "false");
    }

    $username = $_SESSION["username"];

    echo "<li>";
    if ($_SESSION["folders_unfold"][0] == "false") {
      echo "<input type='checkbox' name='list' id='root_folder'>";
    } else {
      echo "<input type='checkbox' name='list' id='root_folder' checked>";
    }
    if (isset($_GET["folder-id"]) && $_GET["folder-id"] == 0) {
      echo "<label class='d-flex align-items-center folder-active item-showfiles' value='0' for='root_folder'>";
    } else {
      echo "<label class='d-flex align-items-center item-showfiles' value='0' for='root_folder'>";
    }
    echo "<i class='uil uil-folder me-2'></i>";
    echo "<div class='folder-name' title='My Cloud'>My Cloud ($username)</div>";
    echo "</label>";
  }

  echo '<ul class="interior">';
  foreach ($files as $file_item) {
    if (is_dir($dir . "/" . $file_item)) {
      array_push($_SESSION["folders_paths"], $dir . "/" . $file_item);

      $cnt = count($_SESSION["folders_paths"]) - 1;

      if (
        count($_SESSION["folders_unfold"]) < count($_SESSION["folders_paths"])
      ) {
        array_push($_SESSION["folders_unfold"], "false");
      }

      echo "<li>";
      if ($_SESSION["folders_unfold"][$cnt] == "false") {
        echo "<input type='checkbox' name='list' id='folder_$cnt'>";
      } else {
        echo "<input type='checkbox' name='list' id='folder_$cnt' checked>";
      }
      if (isset($_GET["folder-id"]) && $cnt == $_GET["folder-id"]) {
        echo "<label class='d-flex align-items-center folder-active item-contextmenu item-showfiles' value='$cnt' for='folder_$cnt'>";
      } else {
        echo "<label class='d-flex align-items-center item-contextmenu item-showfiles' value='$cnt' for='folder_$cnt'>";
      }
      echo "<i class='uil uil-folder me-2'></i>";
      echo "<div class='folder-name' title='$file_item'>$file_item</div>";
      echo "</label>";

      list_folders($dir . "/" . $file_item);

      echo "</li>";
    }
  }
  echo "</ul>";

  if (count($_SESSION["folders_paths"]) == 0) {
    echo "</li>";
  }
}

function folders_init()
{
  $_SESSION["folders_paths"] = [];
  if (!isset($_SESSION["folders_unfold"])) {
    $_SESSION["folders_unfold"] = [];
  }

  if (isset($_GET["folder-id"])) {
    if ($_SESSION["folders_unfold"][$_GET["folder-id"]] == "false") {
      $_SESSION["folders_unfold"][$_GET["folder-id"]] = "true";
    } else {
      $_SESSION["folders_unfold"][$_GET["folder-id"]] = "false";
    }
  }

  $sesion_name = $_SESSION["username"];
  $root_dir = "C:/xampp\htdocs/filesystem-explorer/root/$sesion_name";
  list_folders($root_dir);
}

function folder_size($dir)
{
  $size = 0;

  foreach (glob(rtrim($dir, "/") . "/*", GLOB_NOSORT) as $each) {
    $size += is_file($each) ? filesize($each) : folder_size($each);
  }

  return $size;
}

function get_total_size()
{
  $sesion_name = $_SESSION["username"];

  $main_folder_path = "C:/xampp\htdocs/filesystem-explorer/root/$sesion_name";
  $trash_folder_path =
    "C:/xampp\htdocs/filesystem-explorer/root/" . $sesion_name . "__trash";

  $total_size = folder_size($main_folder_path);
  $total_size += folder_size($trash_folder_path);

  if ($total_size < 1000) {
    echo "<div>Storage: " . $total_size . "B</div>";
  } elseif ($total_size < 1000000) {
    $total_size = round($total_size / 1000, 2);
    echo "<div>Storage: " . $total_size . "KB</div>";
  } elseif ($total_size < 1000000000) {
    $total_size = round($total_size / 1000000, 2);
    echo "<div>Storage: " . $total_size . "MB</div>";
  } elseif ($total_size < 1000000000000) {
    $total_size = round($total_size / 1000000000, 2);
    echo "<div>Storage: " . $total_size . "GB</div>";
  }
}

function directoryIterator($dir)
{
  $n_files = 0;
  foreach (new DirectoryIterator($dir) as $fileInfo) {
    if ($fileInfo->isDot()) {
      continue;
    }
    if (is_file($dir . "/" . $fileInfo)) {
      $n_files += 1;
      $name_file = $fileInfo;
      $extension_file = strstr($fileInfo, ".");
      $img_extension = check_extension_file($extension_file);

      create_div_template($name_file, $img_extension, -1);
    }
  }
  if ($n_files == 0) {
    echo "<div>No files</div>";
  }
}

function clean_scandir($dir)
{
  $files = scandir($dir);
  // array_diff te coge dos arrays diferentes y te devuelve un array con la diferencia de ellas.
  $new_array_sin_puntos = array_diff($files, [".", ".."]);
  // array_values lo que hace, te indexa de nuevo el array para que empiece desde el indice 0 en adelante
  $values_of_array = array_values($new_array_sin_puntos);

  return $values_of_array;
}

function read_local_folders()
{
  $sesion_name = $_SESSION["username"];

  if (isset($_GET["folder-id"])) {
    $local_dir = $_SESSION["folders_paths"][$_GET["folder-id"]];
  } else {
    $local_dir = "C:/xampp\htdocs/filesystem-explorer/root/$sesion_name";
  }

  if (isset($_GET["trash"])) {
    $local_dir =
      "C:/xampp\htdocs/filesystem-explorer/root/" . $sesion_name . "__trash";
  }

  $files = clean_scandir($local_dir);

  $n_folders = 0;
  foreach ($files as $dir) {
    if (is_dir($local_dir . "/" . $dir)) {
      $n_folders += 1;
      $name_folder = $dir;
      $img_folder = "./../../../doc/img/folder.png";
      $folder_id = array_search("$local_dir/$dir", $_SESSION["folders_paths"]);

      create_div_template($name_folder, $img_folder, $folder_id);
    }
  }
  if ($n_folders == 0) {
    echo "<div>There is any folder</div>";
  }
}

function read_local_files()
{
  $sesion_name = $_SESSION["username"];

  if (isset($_GET["folder-id"])) {
    $local_dir = $_SESSION["folders_paths"][$_GET["folder-id"]];
  } else {
    $local_dir = "C:/xampp\htdocs/filesystem-explorer/root/$sesion_name";
  }

  if (isset($_GET["trash"])) {
    $local_dir =
      "C:/xampp\htdocs/filesystem-explorer/root/" . $sesion_name . "__trash";
  }

  directoryIterator($local_dir);
}

function check_extension_file($extension_file)
{
  if ($extension_file == ".png") {
    $extension_file = "./../../../doc/img/icon_extensions/036-png.png";
    return $extension_file;
  } elseif ($extension_file == ".rar") {
    $extension_file = "./../../../doc/img/icon_extensions/040-rar.png";
    return $extension_file;
  } elseif ($extension_file == ".zip") {
    $extension_file = "./../../../doc/img/icon_extensions/050-zip.png";
    return $extension_file;
  } elseif ($extension_file == ".svg") {
    $extension_file = "./../../../doc/img/icon_extensions/043-svg.png";
    return $extension_file;
  } elseif ($extension_file == ".mp4") {
    $extension_file = "./../../../doc/img/icon_extensions/031-mp4.png";
    return $extension_file;
  } elseif ($extension_file == ".odt") {
    $extension_file = "./../../../doc/img/icon_extensions/034-otf.png";
    return $extension_file;
  } elseif ($extension_file == ".mp3") {
    $extension_file = "./../../../doc/img/icon_extensions/030-mp3.png";
    return $extension_file;
  } elseif ($extension_file == ".csv") {
    $extension_file = "./../../../doc/img/icon_extensions/009-csv.png";
    return $extension_file;
  } elseif ($extension_file == ".txt") {
    $extension_file = "./../../../doc/img/icon_extensions/045-txt.png";
    return $extension_file;
  } elseif ($extension_file == ".exe") {
    $extension_file = "./../../../doc/img/icon_extensions/017-exe.png";
    return $extension_file;
  } elseif ($extension_file == ".jpg") {
    $extension_file = "./../../../doc/img/icon_extensions/025-jpg.png";
    return $extension_file;
  } elseif ($extension_file == ".pdf") {
    $extension_file = "./../../../doc/img/icon_extensions/032-pdf.png";
    return $extension_file;
  } elseif ($extension_file == ".pptx") {
    $extension_file = "./../../../doc/img/icon_extensions/037-ppt.png";
    return $extension_file;
  } else {
    // aquí debería ir una imagen de archivo no reconocido
    $extension_file = "./../../../doc/img/folder.png";
    return $extension_file;
  }
}

function create_div_template($text_name, $img_type, $folder_id)
{
  $path_img_folder = "./../../../doc/img/folder.png";
  if (isset($_GET["folder-id"])) {
    $parent_path = $_SESSION["folders_paths"][$_GET["folder-id"]];
  } else {
    $parent_path = $_SESSION["folders_paths"][0];
  }
  $lastPath = $parent_path;
  $parent_path = str_replace(
    "C:/xampp\htdocs/",
    "http://localhost/",
    $parent_path
  );

  if ($img_type == $path_img_folder) {
    echo "<section " .
      'value="' .
      $folder_id .
      '" ' .
      'class="file__item--wrapper d-flex flex-column justify-content-center align-items-center p-2 m-2 border rounded item-contextmenu item-folder">';
  } else {
    echo "<section " .
      'class="file__item--wrapper d-flex flex-column justify-content-center align-items-center p-2 m-2 border rounded open_modal get_info_file" ' .
      'aria-disabled="true" ' .
      'data-source="' .
      $parent_path .
      "/" .
      $text_name .
      '"' .
      'data-relativesource="' .
      $lastPath .
      "/" .
      $text_name .
      '">';
  }

  echo "<div class='d-flex justify-content-center' data-relativesource='$lastPath/$text_name'>";
  echo "<img src='$img_type' alt='$img_type' data-relativesource='$lastPath/$text_name'>";
  echo "</div>";

  echo "<div data-relativesource='$lastPath/$text_name' class=''>";
  echo "<h6 title='$text_name' data-relativesource='$lastPath/$text_name'>$text_name</h6>";
  echo "</div>";

  echo "</section>";
}
