<?php

function createFolder()
{
    $currentPath = $_GET['path'];
    $filePath = $_GET['filepath'];
    $all = glob("$currentPath/*");

    $counts = 0;
    $folderNums = [];

    for ($i = 0; $i < count($all); $i++) {
        $currentFolderNums = [];
        for ($j = 0; $j < strlen($all[$i]); $j++) {
            if ($all[$i][$j] === '(') {
                array_push($currentFolderNums, $all[$i][$j + 1]);
            }
            if ($all[$i][$j] === ')' && $all[$i][$j - 2] !== '(') {
                array_push($currentFolderNums, $all[$i][$j - 1]);
            }
            array_push($folderNums, [implode($currentFolderNums)]);
        }
    }

    if (count($folderNums)) {
        if (count(max($folderNums))) {
            $counts = intval(max($folderNums)[0]);
            if ($counts == 0) {
                $counts = 1;
            }
        } else {
            $counts = 1;
        }
    }

    $old_umask = umask(0);

    if ($counts > 0) {
        mkdir($currentPath . '/newFolder(' . $counts + 1 . ')', 0777, false);
        $dir = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($currentPath . '/newFolder(' . $counts + 1 . ')'));

        echo json_encode([
            "ok" => true,
            "dir" => $dir,
            "path" => $filePath . '/newFolder(' . $counts + 1 . ')'
        ]);
    } else {
        mkdir("$currentPath/newFolder", 0777, false);
        $dir = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename("$currentPath/newFolder"));

        echo json_encode([
            "ok" => true,
            "dir" => $dir,
            "path" => $filePath . '/newFolder'
        ]);
    }
}
createFolder();
