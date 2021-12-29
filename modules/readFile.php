<?php

function readFileFun($newRoot,$fileName){
    try {
        $fileNameWithPath = $newRoot."/".$fileName;
        if (!file_exists($fileNameWithPath)) {
            throw new Exception('File open failed');
        }
        // The function returns a pointer to the file if it is successful or zero if it is not. Files are opened for read or write operations.
        $file = fopen($fileNameWithPath, "r");
        // Reads the file
        $content = fread($file, filesize($fileNameWithPath));
        echo $content;
        // Close the file buffer
        fclose($file);
    } catch (Throwable $t) {
        echo $t->getMessage();
    }
}
