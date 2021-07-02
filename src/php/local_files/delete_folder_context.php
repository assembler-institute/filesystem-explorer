<?php
session_start();

$previous_url = $_SERVER['HTTP_REFERER'];

$folder_id = $_POST["folder-id"];
$path_folder_selected = $_SESSION["folders_paths"][$folder_id];

$father_path = substr($path_folder_selected, 0, strrpos($path_folder_selected, '/'));
$only_name = substr($path_folder_selected, strrpos($path_folder_selected, '/') + 1);

$parent_folder_id = array_search($father_path, $_SESSION["folders_paths"]);

$username = $_SESSION["username"];

rename($path_folder_selected, 'C:/xampp\htdocs/filesystem-explorer/root/' . $username . '__trash/' . $only_name);

echo $parent_folder_id;
