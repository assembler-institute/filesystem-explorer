 <?php
    session_start();
    function getAllFiles($dir, &$results = array())
    {
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = ['path' => realpath($path), 'name' => $value];
            } else if ($value != "." && $value != "..") {
                getAllFiles($path, $results);
                $results[] = ['path' => $path, 'name' => $value];
            }
        }
        return $results;
    }



    function removeDirectory($path)
    {
        $files = glob($path . '/*');
        foreach ($files as $file) {
            is_dir($file) ? removeDirectory($file) : unlink($file);
        }
        rmdir($path);
        return;
    }

    if (isset($_POST["delete"])) {
        $fileToDelete = $_POST["delete"];
        $currentPath = isset($_SESSION["currentPath"]) ? substr($_SESSION["currentPath"], 1)  : "./";
        $fullPath = "../root/" . $currentPath . "/" . $fileToDelete;
        if (is_file($fullPath)) {
            unlink($fullPath);
        } else {
            removeDirectory($fullPath);
        }
        $_SESSION["successMsg"] = "Successfully deleted!";
        header("Location: ../index.php");
    } elseif (isset($_POST["rename"]) && isset($_POST["newName"])) {
        $newName = $_POST["newName"];
        $invalidCharacters = array(".", " ", "/", ",");
        $newName = str_replace($invalidCharacters, "_", $_POST["newName"]);
        $fileToRename = $_POST["rename"];
        $currentPath = isset($_SESSION["currentPath"]) ? substr($_SESSION["currentPath"], 1)  : "./";
        $fullPath = "../root/" . $currentPath . "/" . $fileToRename;
        echo $newName;
        if (is_file($fullPath)) {
            $fileExtension = explode('.', $fileToRename)[1];
            $newFileName = "../root/" . $currentPath . "/" . $newName . "." . $fileExtension;
            if (!file_exists($newFileName)) {
                rename($fullPath, $newFileName);
                $_SESSION["successMsg"] = "Successfully renamed!";
            } else {
                $_SESSION["errorMsg"] = "Filename already exists!";
            }
        } else {
            $newFileName = "../root/" . $currentPath . "/" . $newName;
            if (!file_exists($newFileName)) {
                rename($fullPath, $newFileName);
                $_SESSION["successMsg"] = "Successfully renamed!";
            } else {
                $_SESSION["errorMsg"] = "Filename already exists!";
            }
        }
        header("Location: ../index.php");
    } elseif (isset($_POST["download"])) {
        $fileToDownload = $_POST["download"];
        $filesList = getAllFiles("../root");
        foreach ($filesList as $file) {
            if ($file["name"] === $fileToDownload && file_exists($file["path"])) {
                header('Content-Description: File Transfer');
                header("Content-Type: application/octet-stream");
                header("Content-Length: " . filesize($file["path"]));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header("Content-Disposition: attachment; filename=" . $file["name"]);
                ob_clean();
                flush();
                readfile($file["path"]);
                exit;
            } else {
                echo "File path does not exist.";
            }
        }
    } elseif (isset($_POST["open"])) {
        $currentPath = isset($_SESSION["currentPath"]) ? substr($_SESSION["currentPath"], 1)  : "./";
        $_SESSION["openFile"] = $currentPath . "/" . $_POST["open"];
        header("Location: ../index.php");
    }
