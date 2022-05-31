<?php

if (isset($_GET)) {
    $data = $_GET;
    $dir =  key($data);

    $path = str_replace("_", ".", $dir);


    $fileExten = explode('.', $path);
    $fileActExt = strtolower(end($fileExten));

    if ($fileActExt === 'png' || $fileActExt === 'jpg' || $fileActExt === 'svg') {
        openImage($path);
    } elseif ($fileActExt === 'mp4') {
        $filename = basename($path, "mp4");
        echo "<video id='audio' autoplay controls>
        <source src='./root/{$filename}{$fileActExt}' type='audio/mp3'>
    </video>";
    } elseif ($fileActExt === 'mp3') {
        $filename = basename($path, "mp3");
        echo "<audio id='audio' autoplay controls>
        <source src='./root/{$filename}{$fileActExt}' type='audio/mp3'>
    </audio>";
    }
}


function openImage($dir)
{
    $file = $dir;
    header('Content-Type: image/jpeg');
    header('Content-Length: ' . filesize($file));
    echo file_get_contents($file);
}
function playSong($dir)
{
    $file = $dir;
    header('Content-Type: mp3');
    header('Content-Length: ' . filesize($file));
    echo file_get_contents($file);
}
