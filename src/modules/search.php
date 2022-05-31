<?php

echo "<form action='./search.php' method='post'>
    <input type='text' name='searchFile'></input>
    <button type='submit' name='submit'>Search</button>
</form>";


$results = array();

if (isset($_POST['searchFile'])) {
    $searchFile = $_POST['searchFile'];
    $target_dir = __DIR__;
    $newR =  $target_dir . "/root/";
    echo $newR;
    getFiles($newR, $searchFile);

    echo "<pre>";
    print_r($results);
    echo "</pre>";
}


function getFiles($dir, $search)
{

    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs)]);
    unset($ffs[array_search('..', $ffs)]);

    if (count($ffs) < 1) {
        return;
    }

    foreach ($ffs as $ff) {

        if (str_contains($ff, $search)) {

            array_push($GLOBALS['results'], $ff);
        }
        if (is_dir($dir . '/' . $ff)) {
            getFiles($dir . '/' . $ff, $search);
        }
    }
}
