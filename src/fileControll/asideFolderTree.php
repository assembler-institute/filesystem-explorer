<?php
session_start();

$rootDir = '/xampp/htdocs/filesystem-explorer/src/UNIT';


if (isset($_REQUEST["valid"])) {
    $currentFolderPath = $_POST["currentFolderPath"];

    if (!isset($_SESSION["DIR%" . $currentFolderPath . "%HAS_STATE"])) {
        $_SESSION["DIR%" . $currentFolderPath . "%HAS_STATE"] = 'OPEN';
    } elseif ($_SESSION["DIR%" . $currentFolderPath . "%HAS_STATE"] === 'OPEN') {
        $_SESSION["DIR%" . $currentFolderPath . "%HAS_STATE"] = 'CLOSED';
    } else {
        $_SESSION["DIR%" . $currentFolderPath . "%HAS_STATE"] = 'OPEN';
    }


    echo "<ul class='folder-tree-root'>";
    echo "<li class='folder-tree-folder' data-dir='/xampp/htdocs/filesystem-explorer/src/UNIT'>UNIT</li>";

    recBuildAsideFolderTree($rootDir);

    echo "</ul>";
}


function recBuildAsideFolderTree($dir)
{
    if (hasSubDir($dir)) {
        if (isset($_SESSION["DIR%" . $dir . "%HAS_STATE"])) {
            if ($_SESSION["DIR%" . $dir . "%HAS_STATE"] === 'OPEN') {
                echo "<ul class='folder-tree-group'>";
                foreach (scandir($dir) as $file) {
                    if (is_dir($dir . "/" . $file) && $file != "." && $file != "..") {
                        echo "<li class='folder-tree-folder' data-dir='" . $dir . "/" . $file . "'><img class='folder-icon' src='img/folder.svg' />" . $file . "</li>";
                        recBuildAsideFolderTree($dir . "/" . $file);
                    }
                }
                echo "</ul>";
            }
        }
    }
}

function hasSubDir($dir)
{
    foreach (scandir($dir) as $file) {
        if (is_dir($dir . "/" . $file) && $file != "." && $file != "..") {
            return true;
        }
    }
    return false;
}
