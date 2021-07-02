<?php
  require("./functions/dirManege.php");
  //require("./dirManege/dirContent.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <script lenguage="javascipt" type="text/javascript"> 
    // window.history.forward();
    // window.onunload=function(){null};
    </script> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

  <body class="bod">
  <div class='sureToRemove' style="display:none;">
    <h2>Are you sure to delete?</h2>
    <a href="./dirManege/delete.php" class='btn btn-outline-danger'>Delete</a>
    <button class='btn btn-outline-secondary'>NO</button>
  </div>
   <div class="closeDiv"></div>   
    <header class="navBarContain">
      <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand">Navbar</a>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header>
    
    <main>
      <section class="aside">
        <button  class="newFolderButon">+</button>
        <div class="optionsMenu">
          <ul class="options">
            <li class="Option"><button id="showNewFolderForm">New folder</button></li>
            <li class="Option"><button>Upload Item</button></li>
          </ul>
          <div class="newFolderForm">
            <form  action="./dirManege/create.php" method="post">
              <div class="form-floating">
                <input id="floatingInput" class="form-control" type="text" name="dirname" id="submitButon">
                <label for="floatingInput">New folder name</label>
              </div>
              <button type="submit" class="btn btn-outline-success">submit</button>   
            </form>
          </div>
      
        </div>
      </section>
      <section class="folders">
    
        <?php

          
//unset($_SESSION["currentPath"]);

            if(!isset($_SESSION["currentPath"])){
              $_SESSION["currentPath"]="./directories";
            }
            scanDirsContent($_SESSION["currentPath"]);   
             
            
        ?>
      </section>

    </main>
      <script src="./script.js"></script>

  </body>
</html>
