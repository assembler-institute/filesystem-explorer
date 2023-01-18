<?php

function getFilesAndFolders($directory = './root')
{
    $all = glob("$directory/*");
    $currentPath = './root';

    if (isset($_SESSION['curr_path'])) {
        $currentPath = $_SESSION['curr_path'];
    }

    if (count($all) == 0) {
        echo "
            <div class='empty-root-folder-alert'>
                <p>Oops, it seems you have not created any folder or uploaded any file...</p>
                <div class='empty-root-btns-container'>
                    <img src='assets/fileIcons/noFolderIcon.png' id='createFolderBtn' path='$currentPath' class='create-folder-btn'/>
                    <img src='assets/fileIcons/uploadIcon.png' id='uploadFileBtn' class='upload-file-btn'/>
                </div>
            </div>
            <div class='btns-container' style='display:none'>
                <img src='assets/fileIcons/noFolderIcon.png' id='createFolderBtn' path='$currentPath' class='create-folder-btn'/>
                <img src='assets/fileIcons/uploadIcon.png' id='uploadFileBtn' class='upload-file-btn'/>
              
            </div>
            ";
    } else {
        echo "
            <div class='btns-container'>
                <img src='assets/fileIcons/noFolderIcon.png' id='createFolderBtn' path='$currentPath' class='create-folder-btn'>
                <img src='assets/fileIcons/uploadIcon.png' id='uploadFileBtn' class='upload-file-btn'>
            </div>";
    }

    foreach ($all as $ff) {
        if (is_file($ff)) {
            $file = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($ff));
            $extension = strtolower($ff[-3] . $ff[-2] . $ff[-1]);

            echo "<div class='file-container'>
                    <div oncontextmenu='openMenu(event)' onclick='printInfo(event)' ondblclick='togglePreviewModalVisibility(event)' path='$ff' class='file $extension'></div>
                    <p onclick='openRenameFolderInput(event)'>$file</p>
                </div>";
        }

        if (is_dir($ff)) {
            $dir = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($ff));
            $path = $directory . "/" . $dir;
            
            echo "
                <div class='folder-container'>
                    <div class='folder' path='$path' oncontextmenu='openMenu(event)' ondblclick='navigateToFolder(event)' onclick='printInfo(event)'></div>
                    <p class='folder-name' onclick='openRenameFolderInput(event)'>$dir</p>
                </div>";
        }
    }
}
