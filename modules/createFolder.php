<?php

try{
    if(isset($_GET["root"])){
        $dirPath = $_GET["root"];
        $dirName = ".".$dirPath."/new_folder";
        echo $dirName;
        if(is_dir($dirName) === false){
            mkdir ($dirName);
            echo "hola";
        }
    }
}catch(Throwable $t){
    echo $t->getMessage();
}
header("Location:../index.php?root=$dirPath&rename=new_folder");
?>
