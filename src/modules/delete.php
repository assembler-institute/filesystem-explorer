<?php 

function deleteFile() {
    if (isset($_POST['submit'])) {
        $target_dir = __DIR__;
        $fileName =  $_POST['file'];
        $filePath = $target_dir .'/root/'.$fileName;

        if (is_dir($filePath)) {
            echo 'is a folder';
            rmdir($filePath);
            header("Location: ../index.php ");
        } else {
            unlink($filePath);
            header("Location: ../index.php ");
        }
    }
}

deleteFile();