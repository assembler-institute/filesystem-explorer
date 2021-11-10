<?php

function createFolder()
{
    if (isset($_POST["create-folder-btn"])) {
        $path = getcwd();
        $folderName = $_POST["folder-name"];

        if (isset($_REQUEST['folder'])) {
            $currentFolder = $_REQUEST["folder"];
            mkdir("$path/uploads$currentFolder/$folderName", 0777);
        } else {
            mkdir("$path/uploads/$folderName", 0777);
        }

    }

    if(isset($currentFolder)){
        $redirect = '../index.php?folder='.$currentFolder.'/'.$folderName;
    }else{
        $redirect = '../index.php?folder=/'.$folderName;
    }
    
    header("Location: $redirect");
}

createFolder();
