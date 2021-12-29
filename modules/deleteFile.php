<?php
if (isset($_GET["fileName"])){
    $root=$_GET["root"];
    $fileName=$_GET["fileName"];
    $fileUnlink= ".".$root."/".$fileName;
    unlink($fileUnlink);
    header("Location:../index.php?root=$root");
  }
  else if(isset($_GET["root"])) {
    $root=".".$_GET["root"];
        //try{

 deleteRecursive($root);






        // rmdir(".".$root);
        //     if(is_dir(".".$root)){
        //         //throw new Exception("dont delete");
        //         header("Location:../index.php?error='FolderNotDeleted'");
        //     }
        //     else {
        //         header("Location:../index.php?error='FolderDeleted'");
        //     }
        }


function deleteRecursive($root){
   if ( is_dir( $root));
   {
        $gestor = opendir($root);

        // $directorios = scandir($root);
        // print_r( $directorios);
        // print_r(count($directorios));
    // if (count($directorios)<=2)
    //     {
    //         rmdir($root); 
    //     }

        while (($element = readdir($gestor)) !== false){
            $ruta_completa= "$root/$element";
            if ($element === '.' || $element === '..') {
                continue;
            }

            if(is_dir($ruta_completa)){
                $directoriosChild = scandir($ruta_completa);
                if(count($directoriosChild) <=2){
                    rmdir($ruta_completa);
                    echo "si borro";
                    
                }
            deleteRecursive($ruta_completa);
            }

            else{
                unlink($ruta_completa);
            }

        }
        closedir($gestor);
}
}