<?php
function fileBrowser($folder)
{
    $arrayFile = glob($folder !== "" ? $folder : '../../storage/*', GLOB_BRACE);
    return $arrayFile;
}
