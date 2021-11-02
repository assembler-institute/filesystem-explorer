<?php
session_start();

$directory = '/xampp/htdocs/filesystem-explorer/src/UNIT';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

if (isset($_REQUEST["valid"])) {
    $path = $_POST["path"];
    $pattern = $_POST["pattern"];

    iterateDirectorySearch($iterator, $pattern);
}


function iterateDirectorySearch($i, $pattern)
{
    $hits = array();
    foreach ($i as $path) {
        if ($path->getFilename() != "..") {
            if (is_dir($path)) {
                foreach (glob(dirname($path) . "/" . "*$pattern*") as $hit) {
                    array_push($hits, $hit);
                    if (is_dir("$hit")) {
                        echo "<li class='folder-tree-folder' data-dir='$hit'><img class='folder-icon' src='img/folder.svg' />" . substr($hit, strlen('/xampp/htdocs/filesystem-explorer/src/') - strlen($hit)) . "</li>";
                    } else {
                        echo "<li class='folder-tree-file file-info' data-dir='$hit'><img class='folder-icon' src='img/file-icon.svg' />" . substr($hit, strlen('/xampp/htdocs/filesystem-explorer/src/') - strlen($hit)) . "</li>";
                    }
                }
            }
        }
    }
}
