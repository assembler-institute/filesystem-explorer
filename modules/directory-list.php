<?php
require_once("./modules/file-icon.php");
// Change current directory to root
$homeDir = "./root";

if (isset($_SESSION["currentPath"])) {
    // echo ($homeDir . $_SESSION["currentPath"]);
    chdir($homeDir . $_SESSION["currentPath"]);
} else {
    chdir($homeDir);
}

// $currentDirectory = getcwd();
$scannedDirectory = array_diff(scandir("./"), array('..', '.'));

function isFile($file)
{
    return filetype($file) == "file";
}

function isDir($file)
{
    return filetype($file) == "dir";
}

function explodeFileName($fileName)
{
    return explode(".", $fileName);
}

function human_filesize($bytes, $decimals = 2)
{
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

$foldersArray = array_filter($scannedDirectory, "isDir");
$filesArray = array_filter($scannedDirectory, "isFile");

$dateFormat = "m/d/Y H:i";
$searchValue = $_POST["search"];

function displayFileList($fileToDisplay)
{
    global $dateFormat;
    echo "<tr>
    <th scope='row'>" . fileIcon($fileToDisplay) . "</th>
    <td><span>" . explode(".", $fileToDisplay)[0] . "</span><span class='text-uppercase text-black-50 p-2' style='font-size: 0.8rem'>" .  explode(".", $fileToDisplay)[1] . "</span>" . "</td>
    <td>" . human_filesize(filesize($fileToDisplay)) . "</td>
    <td>" . date($dateFormat, filemtime($fileToDisplay)) . "</td>
    <td>" . date($dateFormat, filectime($fileToDisplay)) . "</td>
    </tr> ";
}
function displayFolderList($folderToDisplay)
{
    global $dateFormat;
    echo ("<tr><th scope='row'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder' viewBox='0 0 16 16'>
        <path d='M.54 3.87.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31zM2.19 4a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4H2.19zm4.69-1.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707z'/>
        </svg></th>
        <td>" . "<form method='post' action='./modules/open-folder.php' ><input type='submit' class='btn btn-link' name='folder-name' value=" . $folderToDisplay . " /></form></td><td></td>
        <td>" . date($dateFormat, filemtime($folderToDisplay)) . "</td>
        <td>" . date($dateFormat, filectime($folderToDisplay)) . "</td></tr>");
}

foreach ($foldersArray as $folder) {
    if (isset($searchValue) && $searchValue) {
        if (stristr($folder, $searchValue)) {
            displayFolderList($folder);
        }
    } else {
        displayFolderList($folder);
    }
}
// <td>" . $folder . "</td><td></td>

if (isset($searchValue) && $searchValue) {
    if (stristr($file, $searchValue)) {
        include_once("./modules/search.php");
    }
} else {
    foreach ($filesArray as $file) {
        displayFileList($file);
    }
}
