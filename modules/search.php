<?php

$serchInputValue = $_GET['search'];

$foldersArray = array();
$filesArray = array();

function getFilesAndFolders($dir)
{
    foreach (glob($dir . "/*") as $ff) {
        global $foldersArray;
        global $filesArray;
        global $serchInputValue;

        if (is_dir($ff)) {
            $explodedff = explode('/', $ff);
            if (str_contains($explodedff[count($explodedff) - 1], $serchInputValue)) {
                array_push($foldersArray, $ff);
            };
            getFilesAndFolders($ff);
        } else {
            $explodedff = explode('/', $ff);
            if (str_contains($explodedff[count($explodedff) - 1], $serchInputValue)) {
                array_push($filesArray, $ff);
            };
        }
    }
}

getFilesAndFolders('../root');

echo json_encode([
    'ok' => true,
    'folders' => $foldersArray,
    'files' => $filesArray
]);
