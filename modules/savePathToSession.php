<?php
session_start();

$path = $_GET['path'];

if ($path[strlen($path) - 1]  === '/') {
    $path[strlen($path) - 1] = ' ';
    $path = str_replace(' ', '', $path);
}

$_SESSION['curr_path'] = $path;

echo json_encode([
    "ok" => true,
    "path" => $path
]);
