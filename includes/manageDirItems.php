<?php 

    // including update mechanism
    require("updateDir.php");

    // Getting dirPath
    $dirPath = $_SESSION['currentPath'];
    // $dirPath = "./root";

    // Getting every item in dirPath
    $dirPathItemList = scandir($dirPath);

    // Renders items for current dirPath
    function renderDirItemList($dirPath, $dirPathItemList){
        for($i=2; $i<sizeof($dirPathItemList); $i++){
            $fileName = $dirPathItemList[$i];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            // Choosing file extension icon to render
            switch($fileActualExt){
                case 'doc':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-word-fill'></i></div>";
                    break;
                case 'csv':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-excel-fill'></i></div>";
                    break;
                case 'jpg':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-image-fill'></i></div>";
                    break;
                case 'png':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-image-fill'></i></div>";
                    break;
                case 'txt':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-text-fill'></i></div>";
                    break;
                case 'ppt':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-ppt-fill'></i></div>";
                    break;
                case 'odt':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-word-fill'></i></div>";
                    break;
                case 'pdf':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-pdf-fill'></i></div>";
                    break;
                case 'zip':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-zip-fill'></i></div>";
                    break;
                case 'rar':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-zip-fill'></i></div>";
                    break;
                case 'exe':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-code-fill'></i></div>";
                    break;
                case 'svg':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-image-fill'></i></div>";
                    break;
                case 'mp3':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-music-fill'></i></div>";
                    break;
                case 'mp4':
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-file-play-fill'></i></div>";
                    break;
                default:
                    $icon = "<div class='mainCenter__fileIcon'><i class='bi bi-folder-fill'></i></div>";
            }

            if(is_dir($dirPath."/".$fileName)){

                echo "
                    <div class ='fileWrapper'>
                        <a class='renderUpdateLink clickMe'  >"
                            .$icon.
                            "<div class='mainCenter__fileName' data-id='".$fileName."'>".$fileName."</div>
                        </a>
                        <i id='".$fileName."Rename' class='bi bi-pencil-square space'></i>
                        <a class='icon__delete space' href='./includes/delete.php?name=".$fileName."' ><i id='".$fileName." Delete' class='bi bi-trash-fill '></i></a>
                    </div>
                ";

            }else{

                echo "
                    <div class ='fileWrapper'>
                        <a class='renderUpdateLink clickMe' >"
                            .$icon.
                            "<div class='mainCenter__fileName' data-id='".$fileName."'>".$fileName."</div>
                        </a>
                        <i id='".$fileName."Rename' class='bi bi-pencil-square space'></i>
                        <a class='icon__delete space' href='./includes/delete.php?name=".$fileName."' ><i id='".$fileName."Delete' class='bi bi-trash-fill '></i></a>
                    </div>
                ";

            }
        }
    }

    function renderItemListLeft($dirPath, $dirPathItemList){
        for($i=2; $i<sizeof($dirPathItemList); $i++){
            $fileName = $dirPathItemList[$i];
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));   
            if(is_dir($dirPath."/".$fileName)){
                echo "
                <div class='mainLeft__container'>
                    <a class='renderUpdateLink' href='./includes/updateDir.php?updateDir=".$dirPath."/".$fileName."'>
                        <div class='mainLeft__fileIcon'><i class='bi bi-folder-fill'></i></div>
                        <div class='mainLeft__fileName'>".$fileName."</div>
                    </a>
                </div>
                ";
            }
        }
    }
?>

<!--
    libxml_disable_entity_loader./includes/manageDirItems.php?updateDir
-->