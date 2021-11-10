<?php
session_start();
if (isset($_FILES['file']['name'])) {
    $target = $_SESSION['folderPath'];
    echo 'SESSION=>' . $target;
    $target_dir = $_SESSION['folderPath'] . '/';
    $target_file = $target_dir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        echo  $response;
    } else {

        $response = false;
    }

    exit;
}
