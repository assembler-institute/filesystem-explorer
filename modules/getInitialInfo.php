<?php
if (isset($_GET['path'])) {
    $pathToff = $_GET['path'];
} else {
    $pathToff = $_SESSION['curr_path'];
}

function getInfo($ff = './root')
{
    $path = $ff;
    $explodedSlash = explode('/', $path);

    if (is_dir($ff)) {
        $name = $explodedSlash[count($explodedSlash) - 1];
        $type = 'Folder';
        $size = getSize($ff) / 1000;

        if ($size < 1000) {
            $size = round($size, 1) . "Kb";
        } else if ($size < 1000000) {
            $size = round($size / 1000, 1) . "Mb";
        } else {
            $size = round($size / 1000000, 1) . "Gb";
        }

        $lastUpdateDate = date("d-m-y - H:i:s", filemtime($ff));
        $creationDate = date("d-m-y - H:i:s", filectime($ff));;
        echo "<div class='file-details-container'>
                <div class='file-details-container-items'>
                    <p class='file-details-item'>Name</p>
                    <p id='infoName' class='file-details-item'>$name</p>
                    <p class='file-details-item'>Extension</p>
                    <p id='infoType' class='file-details-item'>$type</p>
                    <p class='file-details-item'>Size</p>
                    <p id='infoSize' class='file-details-item'>$size</p>
                    <p class='file-details-item'>Last update</p>
                    <p id='infoUpdate' class='file-details-item'>$lastUpdateDate</p>
                    <p class='file-details-item'>Created</p>
                    <p id='infoCreation' class='file-details-item'>$creationDate</p>
                </div>
            </div>";
    }
}

getInfo($pathToff);

function getSize($path)
{
    $bytestotal = 0;
    $path = realpath($path);
    if ($path !== false && $path != '' && file_exists($path)) {
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object) {
            $bytestotal += $object->getSize();
        }
    }
    return $bytestotal;
}
