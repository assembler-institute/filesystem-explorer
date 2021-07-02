<?php
session_start();

$filename = $_FILES['file']['name'];
$parent_location = $_SESSION["folders_paths"][$_POST["folder-id"]];

$location = "$parent_location/$filename";

if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
  $succes = 1;
} else {
  $succes = 0;
}

echo $succes;
