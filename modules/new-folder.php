<?php
session_start();

$newFolderName = $_POST["newFolderName"];
$currentPath = "../root" . $_SESSION["currentPath"];
$invalidCharacters = array(".", " ", "/", ",");
$validFolderName = str_replace($invalidCharacters, "_", $newFolderName);
$newFolderPath = $currentPath . "/" . $validFolderName;

if (!is_dir($newFolderPath)) {
    echo $newFolderPath;
    mkdir($newFolderPath);
    $_SESSION["successMsg"] = "Folder successfully created!";
} else {
    $_SESSION["errorMsg"] = "Folder with that name already exists!";
}

header("Location: ../index.php");
