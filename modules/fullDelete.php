<?php
function fullDelete()
{
    if (isset($_POST['currentNameInput'])) {
        $trashPath = getcwd();
        $filename = $trashPath . '/trash/' . $_POST['currentNameInput'];
        if (is_dir($filename)) {
            recursiveDeleteFolder($filename);
        } else {
            unlink($filename);
        }

    }
    
    header("Location: ../index.php?trash");
}

fullDelete();

function recursiveDeleteFolder($path)
{

    //using the opendir function
    $dir_handle = opendir($path) or die("Unable to open $path");

    while (false !== ($file = readdir($dir_handle))) {
        if ($file != "." && $file != "..") {
            //echo $file;
            if (is_dir($path . "/" . $file)) {
                //Display a list of sub folders.
                recursiveDeleteFolder($path . "/" . $file);
                rmdir($path . "/" . $file);
            } else {
                unlink($path . "/" . $file);
            }
        }
        
    }
    rmdir($path);
    //closing the directory
    closedir($dir_handle);

    header("Location: ../index.php?trash");
}
