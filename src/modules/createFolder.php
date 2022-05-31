<?php 

$target_dir = __DIR__ . '/root/';

if (isset($_POST['submit'])) {
    $folderName = $_POST['folder'];

    if(!is_dir($target_dir.$folderName)){
        mkdir($target_dir.$folderName, "0777");
        header("Location: ../index.php");
    }
}
