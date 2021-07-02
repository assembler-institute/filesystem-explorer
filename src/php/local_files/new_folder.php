<?php
session_start();

$previous_url = $_SERVER['HTTP_REFERER'];

parse_str(parse_url($previous_url, PHP_URL_QUERY), $folder_id_wrapper);
if (isset($folder_id_wrapper["folder-id"])) $folder_id = $folder_id_wrapper["folder-id"];
else $folder_id = 0;

$parent_path = $_SESSION["folders_paths"][$folder_id];

$new_folder_name = $_POST["new-folder-name"];

mkdir("$parent_path/$new_folder_name", 0777);

header("location:$previous_url");
