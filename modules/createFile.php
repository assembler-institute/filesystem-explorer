<?php
$root = $_GET["root"];
$fileNameS = $_POST["fileName"];
$fileExtension = $_POST["fileExtension"];
createFileFun($root, $fileNameS, $fileExtension);
function createFileFun($root, $fileNameS,$fileExtension){
    echo "-he creado un nuevo archivo";
    try{
        $newFileName = ".".$root."/".$fileNameS.$fileExtension;
        echo $newFileName;
        $fileContent = "Hola soy el contenido";
        $file= fopen($newFileName,"w");
        fwrite($file,$fileContent);
        fclose($file);
    }catch(Throwable $t){
        echo $t->getMessage();
    }
    header("Location:../index.php?root=$root");
}
