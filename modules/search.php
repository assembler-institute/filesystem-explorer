<?php
// session_start();
require_once("./modules/file-icon.php");
require_once("./modules/dropdowns.php");

if (isset($_POST["search"])) {
    handleSearch();
}
function handleSearch()
{
    $searchValue = $_POST["search"];
    function convert_filesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    $path = "./root";
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($path)
    );

    $searchedFiles = [];
    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isFile()) {
            $searchedFiles[] = [
                $fileInfo->getFilename(),
                dirname($fileInfo->getPathname()),
                convert_filesize(filesize($fileInfo)),
                date("m/d/Y H:i", $fileInfo->getMTime()),
                date("m/d/Y H:i", $fileInfo->getCtime()),
            ];
        }
    }

    foreach ($searchedFiles as $searchFile) {
        if (isset($searchValue) && $searchValue) {
            if (stristr($searchFile[0], $searchValue)) {
                echo "<tr><th scope='row'><form class='inline-block' method='POST' action='./modules/file-actions.php'><button type='submit' name='open' value=" . $searchFile[0] . " class='dropdown-item'>" . fileIcon($searchFile[0]) . "<span class='ms-3 fw-normal'>" . explode(".", $searchFile[0])[0] . "</span><span class='text-uppercase text-black-50 p-2' style='font-size: 0.8rem'>" .  explode(".", $searchFile[0])[1] .  "</span></button></form><span>" . dropdownMenuFile($searchFile[0]) . "</span></td>
    <td class='align-middle text-center'>" . $searchFile[2] . "</td>
    <td class='align-middle text-center'>" . $searchFile[3] . "</td>
    <td class='align-middle text-center'>" . $searchFile[4] . "</td>
    </tr> 
    ";
            }
        }
    }
}
