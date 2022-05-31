<?php
require "../src/modules/showFiles.php";
require "../src/modules/browseFile.php";
$target_dir = __DIR__ . "/modules/root/";

$results = array();

if (isset($_GET)) {
  $data = $_GET;
  if (count($data, COUNT_RECURSIVE) > 0) {
    $dir =  key($data);
    $listOfElement = openFolder($dir);
  }
}
if (isset($_POST['search'])) {
  $target_dir = __DIR__;
  $newR =  $target_dir . "/modules/root/";
  $searchValue = $_POST['search'];


  getFiles($newR, $searchValue);
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Managizer - Manage your Files</title>
  <link rel="stylesheet" href="style.css">
  <script src="main.js" type="module" defer></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
  <main class="p-5">
    <div class="container rounded">
      <div class="manager-wrapper row">
        <!-- sidebar manu stars here -->
        <div class="manager-sidebar d-flex flex-column border-end  col-1">
          <div class="row">
            <img src="./assets/php.png" class="logo mt-2 mb-4" alt="logo">
          </div>
          <!-- sidebar options -->
          <div class="sidebar-options d-grid gap-5">
            <div class="sidebar-option">
              <a href="?=home" class="d-flex justify-content-center">
                <img src="./assets/home (1).png" class="action-icon" alt="">
              </a>
              <p class="fw-bold text-center">Home</p>
            </div>
            <div class="sidebar-option">
              <a href="#" class="d-flex justify-content-center">
                <img src="./assets/music-note.png" class="action-icon" alt="">
              </a>
              <p class="fw-bold text-center">Audio</p>
            </div>
            <div class="sidebar-option">
              <a href="#" class="d-flex justify-content-center">
                <img src="./assets/video-camera (1).png" class="action-icon" alt="">
              </a>
              <p class="fw-bold text-center">Video</p>
            </div>
            <div class="sidebar-option">
              <a href="#" class="d-flex justify-content-center">
                <img src="./assets/camera.png" class="action-icon" alt="">
              </a>
              <p class="fw-bold text-center">Photos</p>
            </div>
            <div class="sidebar-option">
              <a href="#" class="d-flex justify-content-center">
                <img src="./assets/dustbin.png" class="action-icon" alt="">
              </a>
              <p class="fw-bold text-center">Bin</p>
            </div>
          </div>
        </div>
        <!-- End of sidebar -->

        <!-- Main view of file manager -->
        <div class="manager-main col-8">
          <div class="row ">
            <!-- search bar -->
            <div class="manager-search col">
              <div class="manager-search-content col d-flex">
                <div class="search-icon align-items-center justify-content-center d-flex col-1">
                  <a href="#" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img src="./assets/add.png" class="add-file-icon" alt="add-file-icon">
                  </a>
                </div>
                <!-- Modal for uploading files -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Upload/Create File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form action="./modules/uploadFile.php"  method="post" enctype="multipart/form-data">
                          <input type="file" name="file" id="file">
                          <button type="submit"  class="btn btn-primary" name="submit">Upload</button>
                        </form>
                        
                        <form action="./modules/createFolder.php" class="mt-2" method="post" enctype="multipart/form-data">
                          <label for="folder">Create a folder</label>
                          <input type="text" name="folder" id="folder">
                          <button type="submit" class="btn btn-primary"y name="submit">Create</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <form class="d-flex mt-2 col-11" role="search" action="./index.php" method="post">
                  <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
            <!-- All files preview -->
            <div class="manager-preview border-top mt-4">
              <div class="row row-cols-1 row-cols-md-6 g-4 p-4" id="files-wrapper">

                <?php
                if (count($data, COUNT_RECURSIVE) > 0) {
                  foreach ($listOfElement as $key => $value) {
                    echo " <div class='col' file-cards>
                  <div class='card'>
                    <img src='assets/pdf-file.png' file-icon id='file-image' class='card-img-top' alt='pdf-file'>
                    <div class='card-body'>
                      <h5 class='card-title' file-title>{$value}</h5>
                      <div class='card-btns d-flex justify-content-around'>
                        <form action='./modules/delete.php' method='post' enctype='multipart/form-data'>
                          <input type='text' value={$value} name='file' hidden>
                          <button type='submit' name='submit' id='delete'>
                            <img src='./assets//delete.png' class='card-btns' alt='delete file'></button>
                        </form>

                        <form action='./modules/browseFile.php' method='post' enctype='multipart/form-data'>
                          <input type='text' value={$value} name='folder' hidden>
                          <button type='submit' name='submit' id='open'>
                            <img src='./assets/play-button (1).png' class='card-btns' alt='delete file'></button>
                        </form>

                         <?php renderEditBtn($target_dir . $value) ?>
                      </div>
                    </div>
                  </div>
                </div>";
                  }
                } elseif (count($results) > 0) {
                  foreach ($results as $key => $value) {
                    echo " <div class='col' file-cards>
                  <div class='card'>
                    <img src='assets/pdf-file.png' file-icon id='file-image' class='card-img-top' alt='pdf-file'>
                    <div class='card-body'>
                      <h5 class='card-title' file-title>{$value}</h5>
                      <div class='card-btns d-flex justify-content-around'>
                        <form action='./modules/delete.php' method='post' enctype='multipart/form-data'>
                          <input type='text' value={$value} name='file' hidden>
                          <button type='submit' name='submit' id='delete'>
                            <img src='./assets//delete.png' class='card-btns' alt='delete file'></button>
                        </form>

                        <form action='./modules/browseFile.php' method='post' enctype='multipart/form-data'>
                          <input type='text' value={$value} name='folder' hidden>
                          <button type='submit' name='submit' id='open'>
                            <img src='./assets/play-button (1).png' class='card-btns' alt='delete file'></button>
                        </form>


                         <?php renderEditBtn($target_dir . $value) ?>
                      </div>
                    </div>
                  </div>
                </div>";
                  }
                } else {
                  foreach ($dirFiles as $key => $value) {
                    echo "<div class='col' file-cards>
                    <div class='card'>
                      <img src='assets/pdf-file.png' file-icon id='file-image' class='card-img-top' alt='pdf-file'>
                      <div class='card-body'>
                        <h5 class='card-title' file-title>{$value}</h5>
                        <div class='card-btns d-flex justify-content-around'>
                          <form action='./modules/delete.php' method='post' enctype='multipart/form-data'>
                            <input type='text' value={$value} name='file' hidden>
                            <button type='submit' name='submit' id='delete'>
                              <img src='./assets//delete.png' class='card-btns' alt='delete file'></button>
                          </form>

                          <form action='./modules/browseFile.php' method='post' enctype='multipart/form-data'>
                            <input type='text' value={$value} name='folder' hidden>
                            <button type='submit' name='submit' id='open'>
                              <img src='./assets/play-button (1).png' class='card-btns' alt='delete file'></button>
                          </form>


                          <!-- <?php renderEditBtn($target_dir . $value) ?> -->
                        </div>
                      </div>
                    </div>
                  </div>";
                  }
                }
                ?>

              </div>
            </div>
          </div>
        </div>
        <!-- Modal for Editing folders -->
        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit folder name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="./modules/edit.php">

                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End of main view  -->

        <!-- Individual file preview -->
        <div class="col-3 border-left border-start">
          <div class="file-preview-header  p-3 text-center d-flex justify-content-center align-items-center ">
            <img src="./assets/file.png" class="file-preview-img" alt="">
            <h3 class="p-2">File Preview</h3>
          </div>
          <div class="file-preview-content d-grid gap-4 p-2">
            <div class="card">
              <img id="preview-image" src="./assets/pdf-file.png" class="card-img-top" alt="...">
              <div class="card-body">
                <p id='preview-title' class="card-text fw-bold">contrato_calle_toledo_madrid.pdf</p>
              </div>
            </div>
            <!-- File description -->
            <div class="file-description mt-3 border-top border-bottom">
              <h6 class="mb-3">File Description:</h6>
              <p id="fileSizePreview">Size: 246KB</p>
              <p id="fileExtensionPreview">Exstention: pdf</p>
              <p id="fileLastModified">Last Modfied: Tue 24 May 14:42</p>
            </div>
            <!-- Action menu -->
            <div class="file-preview-actions p-2 d-flex justify-content-between">
              <div class="file-preview-actio justify-content-center">
                <a href="#" class="d-flex justify-content-center">
                  <img src="./assets/delete.png" class="action-icon " alt="">
                </a>
                <p class="fw-bold">Move to bin</p>
              </div>
              <div class="file-preview-action">
                <a href="#" class="d-flex justify-content-center">
                  <img src="./assets/play-button (1).png" class="action-icon" alt="">
                </a>
                <p class="fw-bold">Open file</p>
              </div>
              <div class="file-preview-action">
                <a href="#" class="d-flex justify-content-center">
                  <img src="./assets/edit (1).png" class="action-icon" alt="">
                </a>
                <p class="fw-bold">Edit file</p>
              </div>
            </div>
          </div>
        </div>
        <!-- End of Indivdual file preview -->
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>