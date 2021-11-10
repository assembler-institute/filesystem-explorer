<?php
function getFileSize($file)
{
    $fileSize = filesize($file);
    if ($fileSize > 0) {
        $i = 0;
        $format = ["Kb", "Mb", "Gb"];
        while ($fileSize >= 1024) {
            $fileSize = $fileSize / 1024;
            $i++;
        }
        return round($fileSize, 2) . $format[$i - 1];
    } else {
        return "0kb";
    }
}
