<?php
function getFilePath($file)
{
    //!getPath
    $explodePath = explode('/', $file);
    $rootPath = '';
    for ($i = 1; $i <= count($explodePath) - 1; $i++) {

        if ($explodePath[$i] !== '..') {
            $rootPath = $rootPath .  '/' . $explodePath[$i];
        }
    }

    //!getUri
    $uri = $_SERVER['REQUEST_URI'];

    if (isset($uri) && $uri !== null) {
        $uri = substr($uri, 1);
        $uri = explode('/', $uri);
        $newUri = "";

        for ($i = 0; $i < count($uri) - 3; $i++) {
            $newUri = $newUri . "/" . $uri[$i];
        }

        $uri = "$_SERVER[DOCUMENT_ROOT]" .  $newUri;
    } else {
        $uri = null;
    }
    $filePath = $uri . $rootPath;
    return $filePath;
}
