<?php
session_start();

// Initial variables
$target_dir = "../" . $_SESSION["currentPath"];
// echo $target_dir;
$target_file =  $target_dir . "/" . basename($_FILES["uploadedFile"]["name"]);
$uploadedFile = $_FILES["uploadedFile"];
echo $target_file;
// Only uploading if file doesn't exist
if (!file_exists($target_file)) {
    move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file);
    echo "Uploaded file to " . $target_file;

    // Getting file's characteristics
    $fileName = $_FILES["uploadedFile"]["name"];

    $rawType = $_FILES["uploadedFile"]["type"];
    $midType = explode("/", $rawType);
    $fileType = end($midType);


    $fileCreation = filectime($target_file);
    $fileModification = filemtime($target_file);
    if ($_FILES["uploadedFile"]["size"] < 1000) {
        $fileSize = $_FILES["uploadedFile"]["size"] . "KB";
    } else {
        $mbSize = $_FILES["uploadedFile"]["size"] / 1000;
        // echo $mbSize;
        $fileSize = number_format($mbSize, 2) . "MB";
    }

    // Appending to database
    $cookedFile = createFileArray($fileName, $fileType, $target_file, $fileSize, $fileCreation, $fileModification);

    header("Location:../index.php");
}
// File exists
else {
    echo "Error uploading";
    header("Location:../index.php");
}

/* -------------------------------------------------------------------------- */
/*                                  FUNCTIONS                                 */
/* -------------------------------------------------------------------------- */
// Cooking the file array
function createFileArray($fName, $fType, $fPath, $Size, $fCreation, $fModification = "")
{
    $fileArray = array("name" => $fName, "type" => $fType, "path" => $fPath, "size" => $Size, "creation" => $fCreation, "modification" => $fModification);
    return $fileArray;
}


/* -------------------------------------------------------------------------- */
/*                                    TEST                                    */
/* -------------------------------------------------------------------------- */
// echo "This is the database: <pre>" . print_r($_SESSION["allFiles"], true) . "</pre>";
// echo "<a href='../index.php'>Back home</a>";