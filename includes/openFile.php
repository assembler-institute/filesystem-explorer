<?php

session_start();
$ruta = $_SESSION['currentPath'];

function dblClick($ruta){
    
    // Getting file name
    $Name = $_POST['filename'];
    
    // Creating array of allowed extensions
    $allowed = array('jpg', 'png', 'svg', 'mp3', 'mp4');

    // Splitting Main path and getting start index for navBar
    $splitMainPath =  explode("/", $ruta);
    $startIndexLocalPath = array_search("root", $splitMainPath, true);

    // Constructing and setting up local dir path to render file
    $localDirPath = "";
    for($i = $startIndexLocalPath; $i < count($splitMainPath); $i++){
        $localDirPath .=$splitMainPath[$i]."/";
    }
    if (is_dir($ruta)) {
        $dh = opendir($ruta);
        while (($file = readdir($dh)) !== false) {
            if ($Name == $file){
                $fileExt = explode('.', $Name);
                $fileActualExt = strtolower(end($fileExt));

                if(is_file($ruta."/".$file)) {   
                    if(in_array($fileActualExt, $allowed)){
                        $nameData = $file;
                        $extensionData = $fileActualExt;
                        $arrayData = [
                            "name" => $nameData,
                            "extension" => $extensionData,
                            "objectDirPath" => $localDirPath.$file,
                        ];
                        echo json_encode($arrayData);
                    }  
                }
            }
        
        }
     closedir($dh);
  }else
     echo "<br>No es ruta valida";
}

dblClick($ruta);

// else{    
//     $nameData = $file;
//     $dateData = date("d/m/Y", filemtime($ruta."/".$Name));
//     $modificationData = date("d/m/Y", fileatime($ruta."/".$Name));
//     $sizeData = "null";
//     $extensionData = "null";
//     $arrayData = [
//          "name" => $nameData,
//          "dataCreation" => $dateData,
//          "modification" => $modificationData,
//          "size" => $sizeData,
//          "extension" => $extensionData,
//     ];
//     echo json_encode($arrayData);
// }
?>
