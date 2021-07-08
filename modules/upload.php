<?php
if (isset($_FILES["file"])) {

    $phpFileUploadErrors = array(
        0 => "There is no error, the file uploaded with success",
        1 => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
        2 => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
        3 => "The uploaded file was only partially uploaded",
        4 => "No file was uploaded",
        6 => "Missing a temporary folder",
        7 => "Failed to write file to disk",
        8 => "A PHP extension stopped the file upload",
    );

    $extensions = array("jpg", "jpeg", "png", "JPG", "JPEG", "PNG", "gif", "svg", "txt", "xsl", "xslx", "mp3", "MP3", "flac", "aac", "wav", "aiff", "pdf", "mpeg", "mp4", "mov", "wmv", "avi", "avchd", "flv", "ppt", "pptx", "doc", "docx", "zip", "rar", "php", "html", "css", "sass", "scss", "ini", "json");
    $fileExt = explode(".", $_FILES["file"]["name"]);
    $fileExt = end($fileExt);
    $validFileName = chop($_FILES["file"]["name"], "." . $fileExt);
    $invalidCharacters = array(".", " ", "/", ",");
    $validFileName = str_replace($invalidCharacters, "_", $validFileName);
    $validFileName = $validFileName . "." . $fileExt;


    if ($_FILES["file"]["error"]) {
        $_SESSION["errorMsg"] = $phpFileUploadErrors[$_FILES["file"]["error"]];
    } elseif (!in_array($fileExt, $extensions)) {
        $_SESSION["invalidMsg"] = $_FILES["file"]["name"] . " has invalid file extension!";
    } elseif (is_file("./root" . $_SESSION["currentPath"] . "/" . $validFileName)) {
        $_SESSION["errorMsg"] = "File with that name already exists!";
    } else {
        if (isset($_SESSION["currentPath"])) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "./root" . $_SESSION["currentPath"] . "/" . $validFileName);
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "./root" . "/" . $validFileName);
        }
        $_SESSION["successMsg"] =  $_FILES["file"]["name"] . " has been uploaded";
    }
}
