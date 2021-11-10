<?php

session_start();

function searchFiles() {
  if (isset($_POST["search-files"])) {
    $rawQuery = $_POST["search-files"];
    $cleanQuery = trim(strtolower($rawQuery));

    $path = $_POST["folder-path"]."/modules/uploads";
    $files = array();
    
    $matchingFiles = getMatchingFiles($path, $cleanQuery, $files);
    // echo "<pre>";
    // print_r($matchingFiles);
    // echo "</pre>";
    // die();
    // $similarFiles = getSimilarFiles($path, $cleanQuery);

    $_SESSION['matchingFiles'] = $matchingFiles;
    // $_SESSION['similarFiles'] = $similarFiles;

    header("Location: ../index.php");
  }
}

require_once("./Utils.php");

function getMatchingFiles($path, $cleanQuery, $files) {
  $dir = opendir($path);
  // var_dump(readdir($dir));
  // echo "<br>";

  while ($current = readdir($dir)) {
    // var_dump($current);
    // echo "<br>";
    if ( $current != "." && $current != ".." ) {
      if (is_dir($path."/".$current)) {
          // echo "Heyyy";
          // echo "<br>";
          $files = getMatchingFiles($path.'/'.$current, $cleanQuery, $files);
      } else {
        $currentFileName = explode(".", $current);
        $cleanCurrent = trim(strtolower($currentFileName[0]));
        if (str_contains($cleanCurrent, $cleanQuery) || similar_text($cleanCurrent, $cleanQuery) > 4) {
          $files[] = $path."/".$current;
        }
      }
    }
  }

  // var_dump($files);
  // echo "<br>";
  // die();
  return $files;
}

// function getSimilarFiles($path, $cleanQuery) {
//   $dir = opendir($path);
//   $files = array();
//   while ($current = readdir($dir)){
//     if ( $current != "." && $current != "..") {
//       if (is_dir($path.$current)) {
//           getSimilarFiles($path.$current.'/', $cleanQuery);
//       } else {
//         $currentFileWithExt = basename($current);
//         $currentFileName = explode(".", $currentFileWithExt);
//         $cleanCurrent = trim(strtolower($currentFileName[0]));
//         if (similar_text($cleanCurrent, $cleanQuery) > 4) {
//           $files[] = $current;
//         }
//       }
//     }
//   }

//   return $files;
// }

searchFiles();



















/* function showFoldersFile($path = '/')
{
$arrayTree = [];
$server_root = getcwd() . '/modules/uploads' . $path;

$tree = scandir($server_root);
for ($i = 2; $i < count($tree); $i++) {
$infoFile = pathinfo($tree[$i]);
$cretionDate = date("d/m/Y", filectime($server_root . "/" . $tree[$i]));
$editDate = date("d/m/Y", filemtime($server_root . "/" . $tree[$i]));
$name = $infoFile['basename'];
$type = 'folder';
$sizebytes = filesize($server_root . "/" . $tree[$i]);
$size = formatBytes($sizebytes, 2);

if (count($infoFile) === 4) {
$type = $infoFile['extension'];
}

$json = json_encode(array('url' => $server_root . $name, 'name' => $name, 'creationDate' => $cretionDate, 'editDate' => $editDate, 'icon' => "./assets/img/icons/" . $type . ".svg", 'size' => $size));
array_push($arrayTree, $json);
}

return $arrayTree;
} */


// ----


// function search($path = '/', $search = '')
// {

//     if (isset($_REQUEST['search'])) {
//         $search = $_REQUEST['search'];
//     }

//     //using the opendir function
//     $dir_handle = opendir($path) or die("Unable to open $path");

//     //Leave only the lastest folder name
//     $array = explode("/", $path);

//     while (false !== ($file = readdir($dir_handle))) {
//         if ($file != "." && $file != "..") {
//             echo $file;
//             if (is_dir($path . "/" . $file)) {
//                 //Display a list of sub folders.
//                 search($path . "/" . $file, $search);
//             } else {

//             }
//         }
//     }

//     //closing the directory
//     closedir($dir_handle);
// }

// search();
