<?php
session_start();

$folder_id = $_POST["folder-id"];
$path_folder_selected = $_SESSION["folders_paths"][$folder_id];

$father_path = substr($path_folder_selected, 0, strrpos($path_folder_selected, '/'));

$new_folder_name = $_POST["new-folder-name"];

rename($path_folder_selected, "$father_path/$new_folder_name");
