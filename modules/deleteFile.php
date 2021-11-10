<?php

/* function deleteFile()
{
    if (isset($_POST['currentNameInput'])) {
        $deletePath = $_POST['deletePath'];
        //echo $deletePath;
        if (!is_dir($deletePath)) {
            unlink($deletePath);
        } else {
            rmdir($deletePath);
        }
        // echo $_POST["currentNameInput"];
        header("Location: ../index.php");
        $person = array(
            "url" => $deletePath,
            "name" => "hello"
        );
        $json = json_encode($person);
        return $json;
    }
} */

// deleteFile();

/* function fullDelete()
{
    $fileName = "trash123";
    $sliceFileName = substr($fileName, 5);
    echo $sliceFileName;
}
fullDelete();
 */