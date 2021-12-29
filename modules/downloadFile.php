<?php

$fileRoot = $_GET["root"];
$fileName = $_GET["fileName"];
$file = ".".$fileRoot."/".$fileName;
echo "$file";
$fichero = $file;

if (file_exists($fichero)) {
    echo "hola";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fichero));
    readfile($fichero);
    exit;
}
?>