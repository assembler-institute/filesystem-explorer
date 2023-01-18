<?php
$text = $_GET['text'];
$path = $_GET['path'];
$text = str_replace(' ', '_', $text);
$explodedPath = explode("/", $path);
$explodedPath[count($explodedPath) - 1] =  $text;
$newPath = implode("/", $explodedPath);

if (is_file(".".$path)) {
    $explodedPathWithDot = explode(".", $path);
    $extension = $explodedPathWithDot[count($explodedPathWithDot) - 1];

    rename("." . $path, "." . $newPath . "." . $extension);
    
    echo json_encode([
        "ok" => true,
        "newPath" => $newPath . "." . $extension,
        "path" => $path
    ]);
    
} else {
    rename("." . $path, "." .  $newPath);

    echo json_encode([
        "ok" => true,
        "newPath" => $newPath,
        "path" => $path
    ]);
}
