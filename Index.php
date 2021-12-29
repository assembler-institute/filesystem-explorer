<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="./assets/js/script.js" defer></script>
    <script src="https://kit.fontawesome.com/157b40bd37.js" crossorigin="anonymous"></script>
    <title>Files System Explorer</title>
</head>
<body>
    <div class="jumbotron">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" contenteditable="true">Our Cloud</a>
                <form class="d-flex" action="./modules/searchFiles.php" method="POST">
                    <input class="form-control me-2" type="search" name="searchWords" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>





        <nav class="navbar navbar-light bg-light">
            <form class="container-fluid justify-content-start" action="./modules/createFile.php" method="POST">
                <?php 
                if (isset($_GET["root"])){
                    $root = $_GET["root"];
                ?>
                    <button type="submit" formaction="./modules/createFolder.php?root=<?=$root?>" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button">New Folder</button>
                <?php
                }else {
                  ?>
                  <button disabled="true" type="submit" formaction="./modules/createFolder.php?root=<?=$root?>" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button">New Folder</button>
              <?php
                }
                ?>
                <button type="button" formaction="./modules/createFile.php" method="POST" name="btnNewFile"class="btn btn-sm btn-outline-secondary me-2" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">New File</button>

                <button type="button" class="btn btn-sm btn-outline-secondary me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop3">Upload
                </button>

                <?php 
                if (isset($_GET["fileName"])){
                    $root = $_GET["root"];
                    $fileName = $_GET["fileName"];
                ?>
                    <button type="submit" formaction="./modules/downloadFile.php?root=<?=$root?>&fileName=<?=$fileName?>" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button">Download</button>
                <?php
                }else {
                  ?>
                  <button disabled="true" type="submit" formaction="./modules/downloadFile.php?root=<?=$root?>&fileName=<?=$fileName?>" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button" disabled="true">Download</button>
              <?php
                }
                ?>

                <!-- <button name="btnMove"class="btn btn-sm btn-outline-secondary me-2" type="button">Move to</button> -->

                <button type="button" class="btn btn-sm btn-outline-secondary me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop4">Move to</button>


                <!-- <button type="submit" formaction="./modules/copy.php?root=<?=$Root?>&fileName=<?=$fileName?>" method="GET" name="btnCopy"class="btn btn-sm btn-outline-secondary me-2" >Copy</button> -->
                
                <?php
                if (isset($_GET["fileName"]) ){
                  $root3=$_GET["root"];
                  $fileName3=$_GET["fileName"];
                  ?>
                  <button type="submit" formaction="./modules/copy.php?root=<?=$root3?>&fileName=<?=$fileName3?>" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button">Copy</button>
                  <?php
                  }
                  elseif (isset($_GET["root"]) ){
                  $root3=$_GET["root"];
                  ?>
                  <button type="submit" formaction="./modules/copy.php?root=<?=$root3?>" method="POST"name="btnNewFolder" class="btn btn-sm btn-outline-secondary me-2">Copy</button>
                  <?php
                  }
                  else {
                  ?>
                  <button disabled="true"  class="btn btn-sm btn-outline-secondary me-2">Copy</button>
                <?php
                }
                ?>

                <button type="button" class="btn btn-sm btn-outline-secondary me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Rename
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary me-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Delete</button>
            </form>
    </div>
<div class="row">

<!--  -->

<!-- Folders Container 1-->
    <div id="foldersContainer" class="col-4 primary foldersContainer" >
<!-- Accordion -->
        <div class="accordion" id="accordionPanelsStayOpenExample">

    <?php
    require_once("./modules/generateFoldersTree.php");
    $count = 0;
    generateFoldersTreeFun("./root", $count);
    ?>
        </div>
<!-- Accordion -->
    </div>


<!-- Files container 2-->
<div class="col-4 secondary">
    <?php
if(isset($_GET["search"]) && !isset($_GET["stop"]) ){
  $searchWord = $_GET["search"];
  require_once("./modules/searchFiles.php");
  searchFilesFun( "./root" , $searchWord);
}else{
  require_once("./modules/generateFiles.php");
  if (isset( $_GET["root"])){
    $newRoot = $_GET["root"];
    if(is_dir($newRoot)){
        generateFilesFun($newRoot);
    }
  }
  else {
  echo"click a folder";
  }
  }
    ?>
    </div>
<!-- Details and visualizer container 3-->
    <div class="col-4 primary">
    <?php
    if(isset($_GET["fileName"])){
        $fileName = $_GET["fileName"];
        require_once("./modules/readFile.php");
        readFileFun($newRoot,$fileName);
    }else{
        echo "click a file";
    }
    ?>
    </div>
</div>
<!-- MODAL -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="./modules/createFile.php?root=<?=$newRoot?>" method="POST">
              <label for="name">Nombre del archivo</label>
              <input type="text" name="fileName">
              <label for="name">Extension del archivo</label>
              <select type="text" name="fileExtension">
                <option value=".txt">Hoja de texto</option>
                <option value=".pptx">Power point</option>
                <option value=".pdf">PDF</option>
                <option value=".xlsx">Excel</option>
              </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
        <button type="submit" name="btnNewFile"  class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">New File</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL 2 -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
  Launch static backdrop modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel2">Warning</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  
        <?php
                if (isset($_GET["fileName"])){
                  $newRoot2=$_GET["root"];
                  $fileName2=$_GET["fileName"];
                  ?>
                  <form action="" method="post">
                  <button type="submit" formaction="./modules/deleteFile.php?root=<?=$newRoot2?>&fileName=<?=$fileName2?>" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button">Delete1</button>
                  </form>
                  <?php
                }
                else if(isset($_GET["root"])) {
                  $newRoot2=$_GET["root"];
                  ?>
                  <form  action="./modules/deleteFile.php?root=<?=$newRoot2?>" method="post">
                  <button type="submit" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button">Delete2</button>
                  </form>
                  <?php
                }

                else {
                  ?>
                  <button type="submit" action="./modules/deleteFile.php" method="POST"name="btnNewFolder"class="btn btn-sm btn-outline-secondary me-2" type="button" disabled="true">Delete3</button>
                  <?php
                }
                ?>
      </div>
    </div>
  </div>
</div>


<!-- Modal REname -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel1">El de Rename</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="./modules/createFile.php?root=<?=$newRoot?>" method="POST">
              <label for="name">Nombre del archivo</label>
              <input type="text" name="inputNewName">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
        <!-- <button type="submit" name="btnNewFile"  class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Rename</button> -->
<?php
                if(isset($_GET["fileName"])){
                  $fileName = $_GET["fileName"];
                  ?>
                  <button type="submit" formaction="./modules/renameFile.php?root=<?=$root?>&fileName=<?=$fileName?>" method="POST" name="btnRename"class="btn btn-sm btn-outline-secondary me-2" type="button">Rename</button>
                  <?php
                  }else if (isset($_GET["root"])){
                    $root = $_GET["root"];
                  ?>
                  <button type="submit" formaction="./modules/renameFile.php?root=<?=$root?>" method="POST" name="btnRename"class="btn btn-sm btn-outline-secondary me-2" type="button" >Rename</button>
                <?php
                }else {
                  ?>
                  <button disabled="true" type="submit" formaction="./modules/renameFile.php?root=<?=$root?>&fileName=<?=$fioleName?>" method="POST" name="btnRename"class="btn btn-sm btn-outline-secondary me-2" type="button">Rename</button>
                <?php
                }
?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Upload -->
<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-3" aria-labelledby="staticBackdropLabel3" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel3">Upload</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <form class="mb-0" action="./modules/uploadFile.php?root=<?=$root?>" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
        <button name="btnUnload"class="btn btn-sm btn-outline-secondary me-2" type="submit" action="./modules/uploadFile.php" method="POST" value="Upload Image" name="submit">Upload the image</button>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal MoveTO 4 -->
<div class="modal fade" id="staticBackdrop4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-4" aria-labelledby="staticBackdropLabel4" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel4">Move To:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="./modules/createFile.php?root=<?=$newRoot?>" method="POST">
          <?php
          require_once("./modules/locateFolder.php");
          locateFoldersTreeFun("./root",$count);
          ?>
              <label for="name">Nombre del archivo</label>
              <input type="text" name="inputNewName">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
        <!-- <button type="submit" name="btnNewFile"  class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Rename</button> -->
<?php
                if(isset($_GET["fileName"])){
                  $fileName = $_GET["fileName"];
                  ?>
                  <button type="submit" formaction="./modules/renameFile.php?root=<?=$root?>&fileName=<?=$fileName?>" method="POST" name="btnRename"class="btn btn-sm btn-outline-secondary me-2" type="button">Rename</button>
                  <?php
                  }else if (isset($_GET["root"])){
                    $root = $_GET["root"];
                  ?>
                  <button type="submit" formaction="./modules/renameFile.php?root=<?=$root?>" method="POST" name="btnRename"class="btn btn-sm btn-outline-secondary me-2" type="button" >Rename</button>
                <?php
                }else {
                  ?>
                  <button disabled="true" type="submit" formaction="./modules/renameFile.php?root=<?=$root?>&fileName=<?=$fioleName?>" method="POST" name="btnRename"class="btn btn-sm btn-outline-secondary me-2" type="button">Rename</button>
                <?php
                }
?>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>