<?php

if (isset($_POST['submit'])) {
    getTypeFile();
}

function getTypeFile()
{
    $target_dir = __DIR__;
    $newR =  $target_dir . "/root/" . $_POST['folder'];

    echo realpath("/{$_POST['folder']}/") . PHP_EOL;

    echo dirname($newR);

    if (is_dir($newR)) {
        header("Location: ../index.php?{$newR}");
    } else {
        header("Location: ./openFiles.php?{$newR}");
    }
}

function openFolder($dir)
{
    $ffs = scandir($dir);
    unset($ffs[array_search('.', $ffs)]);
    unset($ffs[array_search('..', $ffs)]);
    return $ffs;
}
