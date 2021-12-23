<?php

$target_dir = "C:/xampp/tmp/";
echo '<pre>' . print_r($_POST) . '</pre>';
echo '<pre>' . print_r($_GET) . '</pre>';

//check if file is empty
if (!empty($_FILES)) {

    $file_uploaded = $_FILES['uploadedFile']["tmp_name"];
    $name = basename($_FILES['uploadedFile']["name"]);

    $uploadOk = 1;
} else {
    $uploadOk = 0;
}
// Check if file already exists
if (file_exists('./../root/' . $name)) {
    $name .= "(1)";
}
// Check file size
if ($_FILES["uploadedFile"]["size"] > 5000000000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
if ($uploadOk === 1) {

    if ($_POST["path"] != "") {
        move_uploaded_file($file_uploaded, './../' . $_POST["path"] . '/' . $name);
        header("location:./../index.php?path=" . $_POST["path"]);
    } else {
        move_uploaded_file($file_uploaded, './../root/' . $name);
        header("location:./../index.php");
    }
} else {
    echo "Sorry, there was an error uploading your file.";
}
