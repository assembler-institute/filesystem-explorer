<?php
require_once('./modules/config.php');
require_once('./modules/breadCrumbs.php');
require_once('./modules/getFilesAndFolders.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - File System Explorer</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <script src="assets/js/index.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body oncontextmenu="return false;">
    <header>
        <nav>
            <p>FILESYSTEM <span>X</span> PLORER</p>
            <div class="search-input-group">
                <input type="text" placeholder="search" name="search" id="searchInput" />
                <img src="assets/fileIcons/search.png" id="searchInputBtn" />
            </div>
        </nav>
    </header>

    <main>
        <?php
        session_start();

        if (!isset($_SESSION[$currentPath])) {
            getFilesAndFolders($rootPath);
            $_SESSION[$currentPath] = $rootPath;
            printBreadCrumbs();
        } else {
            getFilesAndFolders($_SESSION[$currentPath]);
            printBreadCrumbs();
        }

        ?>
    </main>

    <aside class="details-container">
        <?php require_once('./modules/getInitialInfo.php'); ?>
    </aside>

    <div class="confirmation-modal hidden" id="confirmationModal">
        <p>Are you sure?</p>
        <div class="confirmation-btn-container">
            <img id="checkBtn" src="./assets/fileIcons/ModalCheckIcon.png" alt="check" />
            <img id="dismissBtn" src="./assets/fileIcons/ModalDismissIcon.png" alt="dismiss" />
        </div>
    </div>

    <aside class="menu hidden">
        <img src="./assets/fileIcons/renameIcon.png" id="renameBtn" />
        <img src="./assets/fileIcons/deleteIcon.png" id="delete-btn" />
    </aside>

    <div class="preview-modal hidden" id="previewModal">
        <img src="./assets/fileIcons/ModalDismissIcon.png" class="close-preview-modal-btn" id="closePreviewModal">
        <div class="preview-container"></div>
    </div>

    <form id="upload-form">
        <input class="hidden" type="file" id="upload-input" />
    </form>
</body>

</html>