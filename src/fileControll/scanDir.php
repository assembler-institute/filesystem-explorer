<?php
$directory = '/xampp/htdocs/filesystem-explorer/src/UNIT';

function iterateDirectory($i)
{
  $directory = '/xampp/htdocs/filesystem-explorer/src/UNIT';
  $prevPath = $directory;
  $allPaths = array($prevPath => $prevPath);

  echo '<ul>';
  foreach ($i as $path) {
    if ($path->getFilename() != "..") {
      if ($path->isDir()) {
        if (in_array($prevPath, $allPaths)) {
          $newPath = dirname($path);
          if (!in_array($newPath, $allPaths)) {
            $newArray = array(dirname($path) => $path);
            array_push($allPaths, $newArray);
            array_pop($newArray);
            $prevPath = dirname($path);
            echo '<li class="folder-tree-folder son hide" data-dir=' . dirname($path) . '>' . basename(dirname($path)) . '</li>';
          } else {
            echo '<li class="folder-tree-folder" data-dir=' . dirname($path) . '>' . basename(dirname($path)) . '</li>';
          }
        } else {
          echo '<li class="folder-tree-folder son hide" data-dir=' . dirname($path) . '>' . basename(dirname($path)) . '</li>';
        }
      }
    }
    // echo array_key_last($allPaths);
  }
  echo '</ul>';
  // print_r($allPaths);
}
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

iterateDirectory($iterator);


// scanDirectory($directory);

// function scanDirectory($directory)
// {
//   return $scanned_directory = array_diff(scandir($directory), array('..', '.'));

//   foreach ($scanned_directory as $dir) {
//     if (is_dir("$directory/$dir")) {
//       echo "<li class='folder-tree-folder' data-dir='$dir'>$dir</li>";
//       scanDirectory("$directory/$dir");
//     } else {
//       echo "<li class='folder-tree-file file-info' data-dir='$dir'>$dir</li>";
//     }
//   };
// };

// foreach ($scanned_directory as $dir) {
//   if (is_dir("$directory/$dir")) {
//     echo "<li class='folder-tree-folder' data-dir='$dir'>$dir</li>";
//     scanDirectory("$directory/$dir");
//   } else {
//     echo "<li class='folder-tree-file file-info' data-dir='$dir'>$dir</li>";
//   }
// };
