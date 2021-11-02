<?php
// error_reporting(E_ERROR | E_WARNING | E_PARSE);
// error_reporting(0);
session_start();
// echo $_SESSION["path"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400&family=IBM+Plex+Serif:wght@300&family=Titillium+Web&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <div class="main-header">
      <div class="header-test"></div>
      <div class="search-bar"><input id="search-bar" type="text" onblur="this.placeholder = 'Search'" placeholder="Search" onfocus="this.placeholder = ''" /> </div>
      <div class="buttons actions">
        <button class="circle-icon new"><img id="create-folder" src="img/addFolder.svg" class="context-menu-icon" /></button>
        <button class="circle-icon edit"><img id="edit-folder" src="img/editFolder.svg" class="context-menu-icon" /></button>
        <button class="circle-icon delete"><img id="delete-folder" src="img/deleteFolder.svg" class="context-menu-icon" /></button>
        <button class="circle-icon upload-file"><img id="upload-file" src="img/upload.svg" class="context-menu-icon" /></button>
      </div>
    </div>
    <div class="subheader"></div>
  </header>
  <main>
    <aside class="folder-tree-container">
      <ul>
        <pre>
        <?php
        include "fileControll/scanDir.php";
        ?>
        </pre>
      </ul>
    </aside>
    <div class=" main-content">
      <ul class=" main-content-ul">
      </ul>
    </div>
    <!-- info-container-anim -->
    <aside class="file-info-container info-container-anim file-info">
    </aside>

    <!-- CONTEXT MENU -->
    <div class="context-menu">
      <div class="container">
        <div class="rightClick showing">
          <div class="buttons">
            <button class="but new"><img id="create-folder" src="img/addFolder.svg" class="context-menu-icon" /></button>
            <button class="but edit"><img id="edit-folder" src="img/editFolder.svg" class="context-menu-icon" /></button>
            <button class="but delete"><img id="delete-folder" src="img/deleteFolder.svg" class="context-menu-icon" /></button>
          </div>
          <div class="overlap"><img src="img/close.svg" class="context-menu-icon" /></div>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
<script src="main.js"></script>
<script src="contextMenu/contextMenu.js"></script>

<?php
if (isset($_SESSION["fileUploaded"])) {
  echo "<script type='text/javascript'>
  selectFolder('" . $_SESSION['prevPath'] . "');
  </script>";
}
?>


<template id="create-folder-modal">
  <div class="modal-background"></div>
  <div class="modal create-folder-modal">
    <h2>CREATE NEW FOLDER</h2>
    <div style="display: flex;">
      <h4>Location: </h4>
      <p id="session-path"></p>
    </div>
    <form type="post" action="fileControll/createFolder.php">
      <input id="create-folder-name" type="text" placeholder="New folder name" required />
      <button type="submit" id="create-folder-btn">CREATE NEW FOLDER</button>
    </form>
  </div>
</template>

<template id="upload-file-modal">
  <div class="modal-background"></div>
  <div class="modal upload-file-modal">
    <h2>UPLOAD FILE</h2>
    <div style="display: flex;">
      <h4>Location: </h4>
      <p id="session-path-upload"></p>
    </div>
    <form type="post" method="POST" action="fileControll/uploadFile.php" enctype="multipart/form-data">
      <input id="upload-file-name" type="file" name="file" required />
      <button id="upload-file-btn" type="submit" name="submit">UPLOAD FILE</button>
    </form>
  </div>
</template>

<template id="edit-folder-modal">
  <div class="modal-background"></div>
  <div class="modal edit-folder-modal">
    <h2>EDIT FOLDER NAME</h2>
    <form type="post" action="fileControll/editFolder.php">
      <input id="edit-folder-name" type="text" placeholder="" required />
      <button type="submit" id="edit-folder-btn">EDIT FOLDER NAME</button>
    </form>
  </div>
</template>

<template id="delete-folder-modal">
  <div class="modal-background"></div>
  <div class="modal delete-folder-modal">
    <h2>DELETE</h2>
    <h3>Are you sure you want to delete the directory?</h3>
    <form type="post" action="fileControll/deleteFileFolder.php">
      <button type="submit" id="delete-folder-btn">DELETE</button>
    </form>
  </div>
</template>

<template id="play-file-modal">
  <div class="modal-background"></div>
  <div class="play-modal play-file-modal">
  </div>
</template>