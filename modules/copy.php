<?php


if(isset( $_GET["fileName"])){
    $root = $_GET["root"];
    $fileName = $_GET["fileName"];
    $inputNewName= "New".$fileName;
    $oldName = ".".$root."/".$fileName;
    // $newName = ".".$root."/".$inputNewName;
    $newName = ".$root/$inputNewName";
    copy($oldName,$newName);
    header("Location:../index.php?root=$root&fileName=$inputNewName");
}

elseif(isset( $_GET["root"])){

   
    $root = $_GET["root"];
    $positionBar= strrpos($root,"/")+1;
    echo "<br>";
    echo $positionBar;
    $stringPath = substr($root,0, $positionBar);
    echo "<br>";
    echo $stringPath;
    $foldername = substr($root, $positionBar);
    echo "<br>";
    echo $foldername;
    $inputNewName= ".".$stringPath."New". $foldername;
    echo "<br>";
    
    $oldName = ".".$root;
    echo $inputNewName;
    echo "<br>";
    echo $oldName;

    // copy($oldName,$inputNewName);
    recurseCopy(".".$root, $inputNewName, $childFolder = ''
    );
    header("Location:../index.php?root=$inputNewName");
   
}

function recurseCopy(
    string $sourceDirectory,
    string $destinationDirectory,
    string $childFolder = ''
): void {
    $directory = opendir($sourceDirectory);

    if (is_dir($destinationDirectory) === false) {
        mkdir($destinationDirectory);
    }

    if ($childFolder !== '') {
        if (is_dir("$destinationDirectory/$childFolder") === false) {
            mkdir("$destinationDirectory/$childFolder");
        }

        while (($file = readdir($directory)) !== false) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            if (is_dir("$sourceDirectory/$file") === true) {
                recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
            } else {
                copy("$sourceDirectory/$file", "$destinationDirectory/$childFolder/$file");
            }
        }

        closedir($directory);

        return;
    }

    while (($file = readdir($directory)) !== false) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        if (is_dir("$sourceDirectory/$file") === true) {
            recurseCopy("$sourceDirectory/$file", "$destinationDirectory/$file");
        }
        else {
            copy("$sourceDirectory/$file", "$destinationDirectory/$file");
        }
    }

    closedir($directory);
}