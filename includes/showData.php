<?php
session_start();
$ruta = $_SESSION['currentPath'];
function listar_directorios_ruta($ruta){
     $Name = $_POST['prueba'];
  if (is_dir($ruta)) {
     $dh = opendir($ruta);
        while (($file = readdir($dh)) !== false) {
          if ($Name == $file){
               if(is_file($ruta."/".$file)) {     
                    function human_filesize($bytes, $decimals = 2){
                         $sz = "BKMGTP";
                         $factor = floor((strlen($bytes) - 1) / 3);
                         return sprintf("%.{$decimals}f", $bytes / pow   (1024, $factor)) . @$sz[$factor];
                    }
                    $fileExtension = strstr($file, '.');
                    $fileName = strstr($file, '.', true);
                    $nameData = $fileName;
                    $dateData = date("d/m/Y", filemtime($ruta."/".$Name));
                    $modificationData = date("d/m/Y", fileatime($ruta."/".$Name));
                    $sizeData = human_filesize(filesize($ruta."/".$file));
                    $extensionData = $fileExtension;
                    $arrayData = [
                         "name" => $nameData,
                         "dataCreation" => $dateData,
                         "modification" => $modificationData,
                         "size" => $sizeData,
                         "extension" => $extensionData,
                    ];
                    echo json_encode($arrayData);
               }else{    
                    $nameData = $file;
                    $dateData = date("d/m/Y", filemtime($ruta."/".$Name));
                    $modificationData = date("d/m/Y", fileatime($ruta."/".$Name));
                    $sizeData = "null";
                    $extensionData = "null";
                    $arrayData = [
                         "name" => $nameData,
                         "dataCreation" => $dateData,
                         "modification" => $modificationData,
                         "size" => $sizeData,
                         "extension" => $extensionData,
                    ];
                    echo json_encode($arrayData);
               }
          }
           
        }
     closedir($dh);

  }else
     echo "<br>No es ruta valida";
}
listar_directorios_ruta($ruta);