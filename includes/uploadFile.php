<?php 

    require("./updateDir.php");

    if ((isset($_FILES["file"]))){

        // $file = $_FILES['file'];
        // print_r($file);

        // Establish fileUploadDir directory
        $fileUploadDir = $_SESSION['currentPath'];

        // File info
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        // File extension and then File extension in lowercase
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // Getting dirItems
        $dirItemList = scandir($fileUploadDir);

        // Allowed file extensions
        $allowed = array('doc', 'csv', 'jpg', 'png', 'txt', 'ppt', 'odt', 'pdf', 'zip', 'rar', 'exe', 'svg', 'mp3', 'mp4');

        // Checking if file to upload extension is contained in the allowed extensions array
        if(in_array($fileActualExt, $allowed)){
            // Checking if there was an error ($fileError === 0 means no error)
            if($fileError === 0){
                // Checking file size (for now file size limit set at 1000000)
                if($fileSize < 10000000){
                    // Checking if fileName already exists and giving it a new value if so
                    // and also creating the file upload destination and redirecting to
                    // index.php once the process has finished
                    foreach ($dirItemList as $dirItem){
                        if($fileName === $dirItem){

                            if(strrpos($dirItem, ".", 0)){
                                if(strrpos($dirItem, "Copy", 0)){
                                    $copyIndexString = end(explode("Copy", $dirItem));
                                    $actualCopyIndexString = (explode(".", $copyIndexString))[0];
            
                                    if(empty($actualCopyIndexString)){
                                        $fileName = str_replace("Copy.".$fileActualExt, "Copy1.".$fileActualExt, $fileName);
            
                                    }else{
                                        $newCopyIndex = (int)$actualCopyIndexString;
                                        $newCopyIndex +=1;
                                        $newCopyIndex = (string)($newCopyIndex);
                                        $fileName = str_replace("Copy".$actualCopyIndexString.".".$fileActualExt, "Copy".$newCopyIndex.".".$fileActualExt, $fileName);
            
                                    }
                                }else{
                                    $fileName = str_replace(".".$fileActualExt, "Copy".".".$fileActualExt, $fileName);
            
                                }
                            }
                        }
                    }
                    
                    $fileDestination = $fileUploadDir.'/'.$fileName;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: ../index.php?uploadsuccess");
                }else{
                    echo "Your file is too big!";
                }
            }else{
                echo "There was an error uploading your file!";
            }
        }else{
            echo "You cannot upload files of this type!";
        }
    }

?>