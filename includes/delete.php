<?php
session_start();
$dir  = $_SESSION['currentPath'];
$target = $dir."/".$_GET["name"];
function remove($dir){
    if (is_dir($dir)){ 
        $objects = scandir($dir);
        foreach ($objects as $object){
            if($object != "." && $object != ".."){
                if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object)){
                    remove($dir . DIRECTORY_SEPARATOR . $object);
                }else{
                    unlink($dir . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
        rmdir($dir);
    }else{
        unlink($dir);
    }
}
remove($target);
header("Location: ../index.php");


