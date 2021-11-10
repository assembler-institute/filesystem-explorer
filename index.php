<?php

session_start();

require_once './modules/Utils.php';
require_once './modules/showFoldersFile.php';
require_once './modules/breadcrumbs.php';
require_once './modules/moveToTrash.php';

if (!isset($_GET['folder'])) {
    $tree = showFoldersFile();
} else {
    $tree = showFoldersFile($_GET['folder']);
}

if (isset($_GET['trash'])) {
    $tree = filesTrash();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>File System PHP</title>
  <link rel="stylesheet" href="./assets/css/style.css" />
  <link rel="stylesheet" href="./node_modules/jstree/dist/themes/default/style.min.css" />
  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
  <script src="./node_modules/jstree/dist/jstree.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" defer></script>
  <script src="./assets/js/functions.js" defer></script>
  <script src="./assets/js/deleteFile.js" defer></script>
  <script src="./assets/js/editFile.js" defer></script>
  <script src="./assets/js/moveFile.js" defer></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/rr-1.2.8/datatables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/rr-1.2.8/datatables.min.js"></script>
  <script src="./assets/js/datatable.js" defer></script>
</head>

<body>
  <header class="d-flex py-4">
    <div class="w-25">
      <a href="<?=getcwd()?>"><img src="./assets/img/icons/logo.svg" alt="" class="w-25"> <span class="text-logo">File System</span></a>
    </div>
    <div>
      <form method="POST" action="./modules/search.php">
        <label>Search</label>
        <input type="text" name="search-files" />
        <input type="hidden" value="<?=getcwd()?>" name="folder-path" /> <!-- TODO: REVIEW ABSOLUTE PATH PENDING -->
        <input type="submit" value="search">
      </form>
      <a href='./index.php?trash' class='d-block margin-35'><button class='btn btn-danger button-trash'><img src='./assets/img/icons/trash.svg' /><span class="button-trash__message">Trash</span></button></a>
    </div>
  </header>
  <main class="d-flex">
    <aside class="w-25" id="tree">

      <?php ListFolder(getcwd() . "/modules/uploads/");?>
    </aside>
    <article class="w-75">
      <div class="d-flex justify-content-between align-items-center">
      <div class="verticals ten offset-by-one">

          <?php breadcrumbs();?>
      </div>
        <div class="me-3 d-flex justify-content-around general-button-container">
          <button class="d-block btn btn-primary button-options" data-bs-toggle="modal" data-bs-target="#myModal"><img src="./assets/img/icons/folder-alert.svg" alt="" srcset="" /></button>
          <button class="d-block btn btn-primary button-options">
            <form method="post" action="modules/uploadFile.php?folder=<?=isset($_GET['folder']) ? $_GET['folder'] : ""?>" enctype="multipart/form-data">
            <label for="fileUpload">
              <img class="general-button-img" src="./assets/img/icons/upload-white.svg" />
            </label>
            <input id="fileUpload" type="file" name="file" class="d-none" onchange="form.submit()"></input>
            <input type="submit" value="Upload" class="d-none"></input>
          </form>
        </button>

        </div>
      </div>
      <table class="w-100 text-center stripe hover row-border" id="table">
        <thead>
          <tr>
            <th class="th-width">File name</th>
            <th>Creation Date</th>
            <th>Last modification</th>
            <th>Extension</th>
            <th>Size</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (isset($_SESSION['matchingFiles'])) {
              $queryArray = $_SESSION['matchingFiles'];
              // var_dump($queryArray);
              // die();
              $queryTree = showQueryFiles($queryArray);
              echo printFolders($queryTree);
              unset($_SESSION['matchingFiles']);
              unset($_SESSION['similarFiles']);
            } else {
              echo printFolders($tree);
            }
          ?>
        </tbody>
      </table>
      <?php

      ?>
    </article>
  </main>
  <footer>
    &copy; 2021 Sergi, Alberto and Carlos.
  </footer>

</body>

</html>

<!-- CREATE NEW FOLDER -->
<div class="modal" tabindex="-1" id="myModal">
  <div class="modal-dialog modal-dialog-centered text-white">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title"><img src="./assets/img/icons/folder-alert.svg" alt="" srcset=""> Create a new folder</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body bg-primary">
        <form method="post" action="modules/createFolder.php?<?=isset($_GET['folder']) ? 'folder=' . $_GET['folder'] : ""?>">
          <div class="mb-3">
            <label for="folder-name" class="col-form-label">Name for your new folder:</label>
            <input type="text" class="form-control" name="folder-name" id="folder-name" required>
          </div>
          <div class="modal-footer bg-primary">
          <input type="submit" value="Create folder" name="create-folder-btn" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- FIN CREATE NEW FOLDER -->

<!-- RENAME FOLDER OR FILE -->
<div class="modal" id="renameModal" tabindex="-1">
  <div class="modal-dialog text-white">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title"><img src="./assets/img/icons/edit-modal.svg" alt="" srcset=""> Rename</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="modules/editFile.php">
        <div class="modal-body bg-success">
          <input id="oldNameInput" name="oldNameInput" hidden></input>
          <label for="newName" class="col-form-label">New Name:</label>
          <input id="newName" class="form-control" name="newName" placeholder="input your desired name here" required></input>
        </div>
        <div class="modal-footer bg-success">
          <button id="save-btn" type="submit" class="btn btn-success">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<!-- FIN RENAME FOLDER OR FILE -->

<!-- MOVE FOLDER OR FILE TO TRASH -->
<div class="modal" id="deleteModal" tabindex="-1">
  <div class="modal-dialog text-white bg-danger">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title"><img src="./assets/img/icons/alert.svg" alt=""> Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?php isset($_GET['trash']) ? $url = 'modules/fullDelete.php' : $url = 'modules/moveToTrash.php'?>
      <form method="post" action="<?=$url?>">
        <div class="modal-body bg-danger">
        <?php if (isset($_GET['trash'])) {
    echo "<span>Are you sure you want to delete it permanently?</span>";
} else {
    echo "<span>Are you sure you want to trash it?</span>";
}
?>
        <div id="nameFile"></div>
          <input id="currentNameInput" name="currentNameInput" placeholder="Input your desired name here" hidden></input>
          <input id="filePath" name="filePath" placeholder="input your desired name here" hidden></input>
        </div>
        <div class="modal-footer bg-danger">
          <button id="save-btn" type="submit" class="btn btn-danger">Confirm</button>
      </form>
    </div>
  </div>
</div>
</div>
<!-- FIN DELETE FOLDER OR FILE -->
