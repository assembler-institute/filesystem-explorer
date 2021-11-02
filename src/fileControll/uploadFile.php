<?php
session_start();

$sessionPath = $_SESSION["path"];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    if (!$fileError) {
        if ($fileSize < 1000000) {
            $fileDestination = $sessionPath . "/" . $fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
            $_SESSION["prevPath"] = $_SESSION["path"];
            $_SESSION["fileUploaded"] = true;
            header("Location: /filesystem-explorer/src/index.php");
        } else {
            echo "Your file is too big";
        }
    } else {
        echo "There was an error uploading your file";
    }
}
