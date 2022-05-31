<?php

$target_dir = __DIR__ .'/root/';
$dirFiles = scandir($target_dir);

unset($dirFiles[array_search('.', $dirFiles)]);
unset($dirFiles[array_search('..', $dirFiles)]);


$arrayOfFiles = array();

foreach ($dirFiles as $index => $file) {
    $fileName = $file;
    $route =  $target_dir  . '/' .$file;
    $fileExt = pathinfo($file, PATHINFO_EXTENSION);
    $fileSize = filesize($route);
    $lastModified = date("F d Y H:i:s.", filectime($route));
    array_push($arrayOfFiles, array("name" => $fileName, "size" => $fileSize, "modified" => $lastModified, "ext" => $fileExt));
    
}

echo json_encode($arrayOfFiles);
