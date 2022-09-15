<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php
    session_start();
    $page = $_SERVER["REQUEST_URI"];
    $_SESSION['page'] = $page;
    require_once('./assets/php/get_files.php');
    require_once('./assets/php/upload_file_form.php');
    require_once('./assets/php/delete_file_form.php');
  ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/54141fca8b.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
  <link href="./assets/css/index.css" rel="stylesheet">
  <title>File System</title>

</head>

<body>
  <header>
    <div class="logo"><a href="./index.php">
      <img src="./assets/img/logo.svg" alt="Logotipo" height="45px">
    </a></div>
    <nav>
      <form class="d-flex" role="search" action="./assets/php/search_file.php" method="get">
        <input class="form-control me-2 search-bar" name="key" type="search" placeholder="Search" aria-label="Search">
        <input class="btn btn-outline-success" type="submit" value="Search">
      </form>

      <div class="btns-file-action">
        <div class="upload-file" data-bs-toggle="modal" data-bs-target="#uploadModal">
          <span>Upload</span>
          <i class="fa-solid fa-arrow-up-from-bracket"></i>
        </div>

        <div class="new-folder" data-bs-toggle="modal" data-bs-target="#newFolderModal">
          <span>New Folder</span>
          <i class="fa-solid fa-folder-plus"></i>
        </div>

        <div class="move-file" data-bs-toggle="modal" data-bs-target="#moveModal">
          <span>Move File</span>
          <i class="fa-solid fa-file-export"></i>
        </div>
        <div class="delete-file" data-bs-toggle="modal" data-bs-target="#deleteModal">
          <span>Delete</span>
          <i class="fa-solid fa-trash"></i>
        </div>
      </div>
    </nav>
  </header>

  <aside>
    <section>
      <h3 class="title-folders">Your folders</h3>
      <ul id="folderManager">
        <a href="./index.php"><li id="rootFolder">My Files <i class="fa-solid fa-caret-right"></i></li></a>
        <?php getFolders("./root"); ?>
      </ul>
    </section>
  </aside>

  <main>
    <h3 class="title-files">My files</h3>
    <?php getFiles("./root"); ?>
  </main>

  <!-- MODAL FILE -->
  <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="uploadFileForm">
          <form class ="upload-form" enctype="multipart/form-data" method="post" action="./assets/php/upload_file.php">
            <label for="userfile">Select file:</label>
            <input id ="userfile" name="userfile" type="file" required>
            <label for="filename">Name file:</label>
            <input id ="filename" name="filename" maxlength="15" pattern="^([a-zA-Z0-9\s\._-]+)$" type="text" required>
            <label for="directory">Select target folder:</label>
            <select name="directory" id="selectDirectory">
              <option value="../../root/" selected>Folder: My Files</option>
              <?php uploadOptions('./root') ?>
            </select>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Upload" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL FOLDER SECTION -->
  <div class="modal fade" id="newFolderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Folder</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="uploadFileForm">
          <form class ="upload-form" enctype="multipart/form-data" method="post" action="./assets/php/new_folder.php">
            <label for="foldername">Name folder:</label>
            <input id ="foldername" name="foldername" type="text" maxlength="15" required>
            <label for="directoryFolder">Select target folder:</label>
            <select name="directoryFolder" id="selectDirectoryFolder">
              <option value="../../root/" selected>My Files</option>
              <?php uploadOptionsFolder('./root') ?>
            </select>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Create" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <!-- MODAL MOVE -->
  <div class="modal fade" id="moveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Move File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="uploadFileForm">
          <form class ="upload-form" enctype="multipart/form-data" method="post" action="./assets/php/move_file.php">
            <label for="file">Select the file you want to move:</label>
            <select name="file" id="selectDirectory">
              <?php deleteOptions('./root') ?>
            </select>
            <label class="location-move" for="destination">Select the location where you want to move it:</label>
            <select name="destination" id="selectDirectory">
              <option value="../../root/" selected>Folder: My Files</option>
              <?php uploadOptions('./root') ?>
            </select>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Move" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL DELETE -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="uploadFileForm">
          <form class ="upload-form" enctype="multipart/form-data" method="post" action="./assets/php/delete_file.php">
            <label for="file">Select the file you want to delete:</label>
            <select name="file" id="selectDirectory">
              <?php deleteOptions('./root') ?>
            </select>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" value="Delete" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</body>

</html>