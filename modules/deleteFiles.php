<?php

echo print_r($_POST["url"]);
function deleteAll($dir1)
{
    if (is_dir($dir1)) {
        foreach (glob($dir1 . '/*') as $file1) {
            if (is_dir($file1))
                deleteAll($file1);
            else
                unlink($file1);
        }
        rmdir($dir1);
    } else if (is_file($dir1)) {
        unlink($dir1);
    }
}
if (isset($_POST["url"])) {
    $dir1 = './../' . $_POST["url"];
    deleteAll($dir1);
    //disolve string to arr positions
    $arrDir = explode("/", $dir1);
    //remove the last position
    array_pop($arrDir);
    //convert to string again
    $urlRedirection = implode("/", $arrDir);
    if ($urlRedirection === "./../root") {
        header('location:./../index.php');
    } else {;
        $urlRedirection = implode("/", array_diff($arrDir, array(".", "..")));
        header('location:./../index.php?path=./' . $urlRedirection);
    }
}
