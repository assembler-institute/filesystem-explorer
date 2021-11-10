<?php

function filesTrash()
{
    if (isset($_GET['trash'])) {
        $arrayTree = [];
        $server_root = getcwd() . '/modules/trash/';

        $tree = scandir($server_root);
        for ($i = 2; $i < count($tree); $i++) {
            $infoFile = pathinfo($tree[$i]);
            $cretionDate = date("d/m/Y", filectime($server_root . "/" . $tree[$i]));
            $editDate = date("d/m/Y", filemtime($server_root . "/" . $tree[$i]));
            $name = $infoFile['basename'];
            $type = 'folder';
            $sizebytes = filesize($server_root . "/" . $tree[$i]);
            $size = formatBytes($sizebytes, 2);

            if (count($infoFile) === 4) {
                $type = $infoFile['extension'];
            }

            $json = json_encode(array('url' => $server_root . $name, 'name' => $name, 'creationDate' => $cretionDate, 'editDate' => $editDate, 'icon' => "./assets/img/icons/" . $type . ".svg", 'size' => $size));
            array_push($arrayTree, $json);
        }
        return $arrayTree;
    }


}; 

function moveToTrash()
{
    
    if (isset($_POST['currentNameInput'])) {
        $filePath = $_POST['filePath']; //uploads
        $trashPath = getcwd() . "/trash/".$_POST['currentNameInput'];
        rename($filePath, $trashPath);
        header("Location: ../index.php");
    }
};

moveToTrash();

