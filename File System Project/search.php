<?php
require_once("showDir.php");

if (isset($_POST['submitBuscar'])) {
    $searchbar = $_POST['buscar'];
    $path = "./root";
    $newDir = new DirectoryIterator($path);
    foreach ($newDir as $fileinfo) {
        foreach ($fileinfo as $newroute) {
            $newPatha = "./root/$newroute";
            $pathtolook = new DirectoryIterator($newPatha);
            foreach ($pathtolook as $rightPath) {
                $fileName = $rightPath->getFilename();
                if ($fileName == $searchbar) {
                    $extensiona = $rightPath->getExtension();
                    $infofilea = $rightPath->getFileInfo();
                    $fileNamea = $rightPath->getFilename();
                    $rutanueva = folderSize($infofilea);
                    $fileSizea = bytesToHuman($rutanueva);
                    $lastUpdatea = date('F d Y H:i:s', filemtime($infofilea));
                    fillTable($extensiona, $infofilea, $fileNamea, $fileSizea, $lastUpdatea);
                }
                header("location: ./index.php?julio");
            }
        }
    }
}