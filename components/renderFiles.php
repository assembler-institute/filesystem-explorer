<?php

function readDirectory($search, $folderPath)
{
    if (is_dir($folderPath)) {
        if ($dh = opendir($folderPath)) {
            while (($found = readdir($dh)) !== false) {
                if ($found === "." || $found === "..") {
                } else {
                    if (str_contains($found, $search)) {
                        printDirectory($folderPath . '/' . $found);
                    }
                    if (filetype($folderPath) == "dir") {
                        readDirectory($search, $folderPath . '/' . $found);
                    }
                }
            }
        }
        closedir($dh);
    }
}

function printDirectory($fullPath)
{
    $directory =  explode("/", $fullPath);
    array_pop($directory);
    $directory = implode("/", $directory);

    $modificationDate = date("d/m/Y H:i", filemtime($fullPath));
    $creationDate = date("d/m/Y H:i", filectime($fullPath));
    $fileSize = round(filesize($fullPath), 2) < 1000000 ? round(filesize($fullPath) /  1000, 2) . " KB" : round(filesize($fullPath) /  1000000, 2) . " MB";
    $ext = strtoupper(pathinfo($fullPath, PATHINFO_EXTENSION));
    $fileName = explode("/", $fullPath)[count(explode("/", $fullPath)) - 1];

    if (is_dir($fullPath)) {

        if (PHP_OS == "WINNT") {
            echo "
                <div class='row align-items-center hov'>
                    <a class='col-3 d-flex align-items-center text-truncate' href=index.php?directory=$fullPath>
                    <img src=./assets/icons/folder.svg>
                    <p class='ml-2'>$fileName</p>
                    </a>
                    <p class='col-2'>$creationDate</p>
                    <p class='col-2'>$modificationDate</p>
                    <p class='col-1'>Folder</p>
                    <p class='col-2'></p>
                    <div class='col-2 d-flex justify-content-start'>
                        <a href='components/erase.php?erase=$fullPath'><button class='btn btn-danger p-0 me-2'><i class='fas fa-trash-alt'></i></button></a>
                        <a href='index.php?directory=$directory&edit=$fullPath'><button class='btn btn-edit btn-warning p-0'><i class='fas fa-edit'></i></button></a>
                    </div>
                </div>
                <hr>";
        } else {
            echo "
                <div class='row align-items-center hov'>
                <a class='col-3 d-flex align-items-center text-truncate' href=index.php?directory=$fullPath>
                    <img src=./assets/icons/folder.svg>
                    <p class='ml-2'>$fileName</p>
                    </a>
                    <p class='col'>Unknown</p>
                    <p class='col'>$modificationDate</p>
                    <p class='col-2'></p>
                    <div class='col-2 d-flex justify-content-start'>
                        <a class='mr-2' href='components/erase.php?erase=$fullPath'><button class='btn btn-danger p-0'><i class='fas fa-trash-alt'></i></button></a>
                        <a href='index.php?directory=$directory&edit=$fullPath'><button class='btn btn-edit btn-warning p-0'><i class='fas fa-edit'></i></button></a>
                    </div>    
                </div>
                <hr>";
        }
    } else {
        if (PHP_OS == "WINNT") {
            echo "
                    <div class='row align-items-center hov'>
                        <a class='col-3 d-flex align-items-center text-truncate' href=$fullPath><img src=./assets/icons/$ext-icon.svg><p>$fileName</p></a>
                        <p class='col'>$creationDate</p>
                        <p class='col'>$modificationDate</p>
                        <p class='col-1'>$ext</p>
                        <p class='col-2'>$fileSize</p>
                        <div class='col-2 d-flex justify-content-start'>
                            <a class='mr-2' href='components/erase.php?erase=$fullPath'><button class='btn btn-danger p-0'><i class='fas fa-trash-alt'></i></button></a>
                            <p></p>
                        </div>
                    </div>
                <hr>";
        } else {
            echo "
                    <div class='row align-items-center hov'>
                        <a class='col-3 d-flex align-items-center text-truncate' href=$fullPath><img src=./assets/icons/$ext-icon.svg>$fileName</a>
                        <p class='col'>Unknown</p>
                        <p class='col'>$modificationDate</p>
                        <p class='col-1'>$ext</p>
                        <p class='col-2'>$fileSize</p>
                        <div class='col-2 d-flex justify-content-start'>
                            <a class='mr-2' href='components/erase.php?erase=$fullPath'><button class='btn btn-danger p-0'><i class='fas fa-trash-alt'></i></button></a>
                            <p></p>
                        </div>
                    </div>
                <hr>";
        }
    }
}

if (!isset($_GET["search"])) {
    if (isset($_GET["directory"]) && explode("/", $_GET["directory"])[0] == "root" && !str_contains($_GET["directory"], "..")) {
        $directory =  $_GET["directory"];
    } else {
        $directory = 'root';
    }
    scandir($directory, SCANDIR_SORT_ASCENDING);
    if (is_dir($directory)) {
        if ($dh = opendir($directory)) {
            while (($file = readdir($dh)) !== false) {
                if ($file === "." || $file === "..") {
                } else {
                    $fullPath = "$directory/$file";
                    printDirectory($fullPath);
                }
            }
            closedir($dh);
        }
    }
} else {
    $search = $_GET["search"];
    $folderPath = "root";
    readDirectory($search, $folderPath);
}
