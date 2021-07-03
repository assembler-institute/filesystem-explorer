<?php 
    //====================================
    //se carga la cookie de sesion que crea el navegador
    //setcookie ("PHPSESSID", "", time() - 3600, '/');
    //====================================
    session_start();
    $_SESSION['base_url'] = getcwd();
    require("./includes/manageDirItems.php");
    require("./includes/updateDirNavBar.php");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- --------------Panels section------------------ -->

    <!-- CreateFolderPanel -->
    <div id="createFolderForm" class="createFolderPanel">
        <form action="./includes/createFolder.php" method="POST">
            <div class="createFolderHeader">
                <h4 class="createFolderFormTitle">New folder</h4>
                <i id="closeCreateFolderBtn" class="bi bi-x-lg"></i>
            </div>
            <input class="newFolderInput" type="text" name="folderName" placeholder="Input new folder name">
            <div class="buttons">
                <button type="submit" name="submitFolder" class="createFolderPanelBtn submit"> CREATE</button>
                <button type="button" id="cancelBtnForm" class="createFolderPanelBtn cancel">CANCEL</button>
            </div>
        </form>
    </div>
    <div id="createFolderBackground"></div>

    <!-- NewOptionsPanel -->
    <div id="newOptionsPanel" class="newOptions">
        <div id="newFolder" class="optionWrapper"> 
            <button id ="createFolder" class="panelBtn" type="button">
                <div class="optionIconWrapper">
                    <i class="bi bi-folder-plus"></i>
                </div>
                <span>Create Folder</span>
            </button>
        </div>
        <hr>
        <div id="uploadFile" class="optionWrapper"> 
            <form action="./includes/uploadFile.php" method="POST" enctype="multipart/form-data">
                <input id="idinput" type="file" name="file" onchange="form.submit()" style="display: none">
                    <div class="optionIconWrapper">
                        <i class="bi bi-upload"></i>
                    </div>
                    <label for="idinput" >Upload File</label>
            </form>
        </div>
    </div>
    <div id ="newOptionsPanelBackground"></div>
    
    <!-- Rename file or folder form  -->
    <div id="renamerForm" class="createFolderPanel">
        <form name="renameForm" action="./includes/updateName.php" onsubmit="return renameValidation()" method="POST">
            <div class="createFolderHeader">
                <h4 class="createFolderFormTitle">Choose new name</h4>
                <i id="closeRenameFolderBtn" class="bi bi-x-lg"></i>
            </div>
            <label for="oldName">Current Name</label>
            <input id="oldName" class="newFolderInput" type="text" name="oldName" value="" readonly>
            <label for="newName">New Name</label>
            <input id="newName" class="newFolderInput" type="text" name="newName" placeholder="Input new name" required>
            <div class="buttons">
                <button type="submit" name="submitRename" class="createFolderPanelBtn submit">SUBMIT</button>
                <button type="button" id="cancelRenameBtnForm" class="createFolderPanelBtn cancel">CANCEL</button>
            </div>
        </form>
    </div>

    <!-- Open File render div -->
    <section class="renderFileSection">
        <div class="renderFileContainer">
            <img id="renderImg"class="renderImgFile" src="">
            <audio id="renderAudio"class="renderAudioFile" src="" controls></audio>
            <video id="renderVideo"class="renderVideoFile" src="" controls autoplay></video>
        </div>
    </section>

    <!-- Header section -->
    <header>
        <div class="headerLeft">
            <img src="./assets/img/logo.png"
     alt="Logo"  />
        </div>
        <div class="headerCenter"> 
            <input class="searchBar" type="text">
        </div>
        <div class="headerRight"> 
            <div class="icon"> 
            <i class="bi bi-gear-fill"></i>
            </div>
            <div class="iconUser"> user </div>
        </div>
    </header>

    <!-- Main section -->
    <main>
        <section class="mainLeft">
            <div class="newFile"> 
                <div class ="newFile__btn"> 
                    <span id="addNew">+</span>
                </div>
            </div>
            <hr>
            <div class="fdContainer">
                
                <?php 
                    renderItemListLeft($dirPath, $dirPathItemList);
                ?>
                                
            </div>
        </section>
        <section class="mainCenter">
            <div class ='mainCenter__route'>
                <?php echo "
                    <div>".
                        renderDirBrowsingNavBar().
                    "</div>"; 
                    // <a class='renderUpdateLink' href='./index.php'>My Unity</a> 
                ?>
            </div>

            <?php 
                renderDirItemList($dirPath, $dirPathItemList);
            ?>

        </section>
        <section class="mainRight">
            <div class="mainRight__fileHeader">
                <div class="mainRight__fileIcon" id="containerTitle"><i id="iconTitle" class="bi bi-server"></i></div>
                <div class="mainRight__fileName" id="titleName">My Unity</div>
            </div>
            <hr class="mainRight__hr">
            <div class="fileInfoContainer" style="display:none" id="container">
                <div class="fileInfoWrapper">
                    <div class="label" id="labelName" style="display:none"> Name: </div>
                    <div class="labelType" id="name"></div>
                </div>
                <div class="fileInfoWrapper">
                    <div class="label" id="labelCreate" style="display:none"> Creation date: </div>
                    <div class="labelType" id="dateCreation"></div>
                </div>
                <div class="fileInfoWrapper">
                    <div class="label" id="labelModification" style="display:none"> Modification date: </div>
                    <div class="labelType" id="modification" style="display:none"></div>
                </div>
                <div class="fileInfoWrapper">
                    <div class="label" id="labelSize" style="display:none"> Size: </div>
                    <div class="labelType"  id="size"></div>
                </div>
                <div class="fileInfoWrapper">
                    <div class="label" id="labelExtension" style="display:none"> Extension: </div>
                    <div class="labelType"  id="extension"></div>
                </div>
            </div>
            <div class="fileInfoContainer2" id="infoContainer">
              
                <i class="bi bi-chat-square-text-fill"></i>
                <p>Aún no tienes ningún elemento seleccionado, para saber su información, debes seleccionarlo.</p>
             
            </div>
        </section>
    </main>
    <template>
    <div class ="fileWrapper">
                <div class="mainCenter__fileIcon"><i class="bi bi-folder-fill"></i></div>
                <div class="mainCenter__fileName">Documents</div>
            </div>
            <div class ="fileWrapper">
                <div class="mainCenter__fileIcon"><i class="bi bi-folder-fill"></i></div>
                <div class="mainCenter__fileName">Audio</div>
            </div>
            <div class ="fileWrapper">
                <div class="mainCenter__fileIcon"><i class="bi bi-folder-fill"></i></div>
                <div class="mainCenter__fileName">Video</div>
            </div>
            <div class ="fileWrapper">
                <div class="mainCenter__fileIcon"><i class="bi bi-folder-fill"></i></div>
                <div class="mainCenter__fileName">Images</div>
            </div>
    </template>
    <!-- <script type="text/javascript" src="/node_modules/jquery/dist/jquery.js"></script> -->
    <script type="text/javascript" src="./js/render.js"></script>
    <script type="text/javascript" src="./js/formValidation.js"></script>
    <script type="text/javascript" src="./js/fuctionOnClick.js"></script>
    <script type="text/javascript" src="./js/functionOnDblCick.js"></script>
    
</body>
</html>