<?php
if(isset( $_GET["fileName"])){
    $root = $_GET["root"];
    $fileName = $_GET["fileName"];
    $inputNewName= $_POST["inputNewName"];
    $oldName = ".".$root."/".$fileName;
    $extension = pathinfo($oldName, PATHINFO_EXTENSION);
    $newName = ".".$root."/".$inputNewName.".".$extension;
    rename($oldName,$newName);
}
else if(isset($_GET["root"])){
$root = $_GET["root"];
$positionBar= strrpos($root,"/")+1;
$stringFolderName = substr($root,0, $positionBar);
$oldNameFolder = ".".$root;
$inputNewFolderName= $_POST["inputNewName"];
$newFolderName =".".$stringFolderName."/".$inputNewFolderName;
rename($oldNameFolder,$newFolderName);
}

header("Location:../index.php?root=$root&fileName=$newName");

