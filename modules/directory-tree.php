<?php

function directoryHasDirectories($directory)
{
    $returnValue = false;
    $directoryContent = array_diff(scandir($directory), array('..', '.'));
    foreach ($directoryContent as $possibleDirectory) {
        if (is_dir($directory . "/" . $possibleDirectory)) {
            $returnValue = true;
        }
    }
    return $returnValue;
}


function dirToArray($dir)
{
    $contents = array();
    foreach (array_diff(scandir($dir), array('..', '.')) as $node) {
        if (is_dir($dir . '/' . $node)) {
            $contents[$node] = dirToArray($dir . '/' . $node);
        }
    }
    return $contents;
}

function directoryTree()
{
    $folderIcon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder-fill' viewBox='0 0 16 16'>
                                    <path d='M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z' />
                                </svg>";
    $initialCwd = getcwd();
    // Change current directory to root
    $homeDir = "root";
    chdir($homeDir);

    // To echo before looping
    echo "<div class='nav nav-pills flex-column mb-0 mt-2 align-items-center align-items-sm-start text-white' id='menu'>";
    echo "<div class='nav-item'>";
    // echo "<a href='#Home' data-bs-toggle='collapse' class='nav-link align-middle px-0 text-white folder-toggle'>";
    echo $folderIcon;
    // echo "</a>";
    echo "<a href ='./modules/open-directory.php?directory='' class='px-0 text-white' >";
    echo "<span class='ms-1 d-none d-sm-inline hover-green align-middle'>Home</span></a>";
    echo "<ul class='collapse show nav flex-column ms-1' id='Home' data-bs-parent='#menu'>";

    function makeRecursiveTree($dir)
    {
        $folderIcon = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-folder-fill' viewBox='0 0 16 16'>
                                    <path d='M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z' />
                                </svg>";

        $dirToId = str_replace("/", "-", str_replace("./", "Home", $dir));

        foreach (array_diff(scandir($dir), array('..', '.')) as $node) {
            if (is_dir($dir . '/' . $node)) {
                echo "<li class='w-100 ms-2'>";
                if (directoryHasDirectories($dir . '/' . $node)) {
                    echo "<a href='#" . $dirToId . '-' . $node . "' data-bs-toggle='collapse'  role='button' aria-expanded='false' aria-controls='Home' class='nav-link px-0 text-white folder-toggle'>" . $folderIcon . "</a>";
                    echo "<a href ='./modules/open-directory.php?directory=" . $dir . '/' . $node . "' class='px-0 text-white' ><span class='ms-1 d-none d-sm-inline hover-green align-middle'>";
                    echo $node;
                    echo "</span></a>";
                    echo "<ul class='collapse nav flex-column ms-1' id='" . $dirToId  . '-' . $node . "' data-bs-parent='#" . $dirToId . "'>";
                    makeRecursiveTree($dir . '/' . $node);
                    echo "</ul>";
                } else {
                    echo "<a href='./modules/open-directory.php?directory=" . $dir . '/' . $node . "' class='nav-link px-0 text-white ms-4'>" . $folderIcon;
                    echo "<span class='ms-1 d-none d-sm-inline hover-green align-middle'>";
                    echo $node;
                    echo "</span></a>";
                }


                echo "</li>";
            }
        }
    }

    makeRecursiveTree("./");
    // To echo after looping
    echo "</ul>";
    echo "</div>";
    echo "</div>";

    chdir($initialCwd); // go back to original working directory
}
