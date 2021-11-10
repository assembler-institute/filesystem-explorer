<?php

function breadcrumbs()
{

    $html = '<ol class="breadcrumb primary-color">';
    $html = $html.'<li class="breadcrumb-item"><a class="text-white" href="/filesystem-explorer/index.php">Root</a></li>';
    if (isset($_GET['folder'])) {
        $folders = explode('/', $_GET['folder']);
        $adUrlFolder = "/filesystem-explorer/index.php?folder=";
        for ($i=1; $i < count($folders); $i++) {
            $adUrlFolder = $adUrlFolder."/".$folders[$i];
            $html = $html.'<li class="breadcrumb-item"><a class="text-white" href="'.$adUrlFolder.'">'.$folders[$i].'</a></li>';
        }
    }
    $html = $html.'</ol>';
    echo $html;
}
