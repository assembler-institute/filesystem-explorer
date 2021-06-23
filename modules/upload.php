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

        // pre_r($_FILES);
        $ext_error = 0;

        $extensions = array("jpg", "jpeg", "png", "gif");
        $file_ext = explode(".", $_FILES["file"]["name"]);
        $file_ext = end($file_ext);
        // pre_r($file_ext);

        // if the error of the upload is not equal to 0
        if ($_FILES["file"]["error"]) {
            $error_msg = $phpFileUploadErrors[$_FILES["file"]["error"]];
        } elseif (!in_array($file_ext, $extensions)) {
            $invalid_msg = "has invalid file extension!";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "root/" . $_FILES["file"]["name"]);
            $_FILES["file"]["name"];
            $success_msg = "has been uploaded";
        }
        // pre_r($ext_error);
    }

    ?>