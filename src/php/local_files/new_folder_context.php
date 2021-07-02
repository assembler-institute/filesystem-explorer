<?php
session_start();

$folder_id = $_POST["folder-id"];
$parent_path = $_SESSION["folders_paths"][$folder_id];

$new_folder_name = $_POST["new-folder-name"];


mkdir("$parent_path/$new_folder_name", 0777);
