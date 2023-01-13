const divFolders = document.getElementById('folder');
const btnCreateFolder = document.querySelector("#create-new-folder");
const divFiles = document.getElementById('files');

btnCreateFolder.addEventListener("click", createNewFolder);

window.addEventListener('load', getInfoFolders);

function getInfoFolders() {
    while (divFolders.firstChild) {
        divFolders.removeChild(divFolders.lastChild);
    }

    fetch('../assets/display-folders.php')
        .then(response => response.json())
        .then(data => displayFolderIndex(data));
}

function displayFolderIndex(data) {
    foldersArray = data;

    foldersArray.forEach(folder => {
        let elLi = document.createElement('li');

        let elDiv = document.createElement('div');
        let elImgFolder = document.createElement('img');

        let divBtns = document.createElement('div');

        let spanEdit = document.createElement('span');
        let iEdit = document.createElement('i');

        let spanDelete = document.createElement('span');
        let iDelete = document.createElement('i');

        elDiv.className = 'select-folder';
        elDiv.setAttribute('name-folder', folder);
        elDiv.textContent = folder;
        elImgFolder.src = '../image/folder.ico';
        elImgFolder.className = 'imageFolder';
        elImgFolder.alt = 'image Folder';

        spanEdit.className = 'modify-name-folder';
        spanEdit.setAttribute('actual-folder', folder);
        iEdit.className = 'fa-solid fa-pen';

        spanDelete.className = 'delete-folder';
        spanDelete.setAttribute('actual-folder', folder);
        iDelete.className = 'fa-solid fa-trash';
        iDelete.id = 'delete-folder';

        divFolders.prepend(elLi);

        elLi.appendChild(elDiv);
        elDiv.prepend(elImgFolder);

        elLi.appendChild(divBtns);

        divBtns.appendChild(spanEdit);
        spanEdit.appendChild(iEdit);

        divBtns.appendChild(spanDelete);
        spanDelete.appendChild(iDelete);
    })

    let h1Files = document.createElement('h1');
    h1Files.textContent = 'Welcome! Please choose a folder😁🖼️';
    h1Files.id = 'choose-folder-h1';

    divFiles.prepend(h1Files);

    const modifyNameFolder = document.querySelectorAll(".modify-name-folder");
    const selectFolder = document.querySelectorAll(".select-folder");
    const deleteFolder = document.querySelectorAll(".delete-folder");

    modifyNameFolder.forEach((item) => {
        item.addEventListener("click", modifyNameFolders)
    });


    deleteFolder.forEach((item) => {
        item.addEventListener("click", deleteFolders)
    });

    selectFolder.forEach((item) => {
        item.addEventListener("click", selectFolders)
    });
}

function createNewFolder() {
    // let folderName = document.querySelector("#folder-name").value;

    let newName = prompt(`Assign a new to the new folder.`);

    if (newName) {
        fetch("../assets/create-folder.php?nameFolder=" + newName)
            .then(response => response.json(),
                reject => alert('There was an error, we couldnt create the folder!'))
            .then(info => {
                if (info.exists) {
                    alert(info.msg);
                } else {
                    getInfoFolders();
                }
            });
    }
}

function modifyNameFolders(event) {
    let actualFolderName = event.currentTarget.getAttribute('actual-folder');
    let newName = prompt(`Put new folder name for "${actualFolderName}", please/`);

    if (newName) {
        fetch("../assets/modify-folder.php?nameFolder=" + newName + "&actualFolderName=" + actualFolderName)
            .then(response => {
                if (response.status === 200) {
                    getInfoFolders();
                } else {
                    alert('There was an error, we couldnt change the name of the folder!');
                }
            })
    }
}

function deleteFolders(event) {
    let actualFolderName = event.currentTarget.getAttribute('actual-folder');
    const popUpDeleteConfirm = confirm(`Do you want delete "${actualFolderName}" folder?`);

    if (popUpDeleteConfirm) {
        fetch("../assets/delete-folder.php?actualFolderName=" + actualFolderName)
            .then(response => {
                if (response.status === 200) {
                    getInfoFolders();
                } else {
                    alert('There was an error, we couldnt delete the folder!');
                }
            })
    }
}

function selectFolders(event) {
    const containerOpenFolder = document.querySelector("#files");

    while (containerOpenFolder.firstChild) {
        containerOpenFolder.removeChild(containerOpenFolder.lastChild);
    }

    let openFolder = event.srcElement.getAttribute('name-folder');
    fetch("../assets/display-content.php?actualFolderName=" + openFolder)
        .then(response => response.json())
        .then(data => showelementosOfFolder(data))

    // let inputUploadFile = document.getElementsByName("uploadFolder")[0];
    // inputUploadFile.value = openFolder;

    //Table
    let bodyTable = document.createElement("table");
    let tableRow = document.createElement("tr");
    let rowHead = document.createElement("th");

    containerOpenFolder.appendChild(bodyTable);
    bodyTable.appendChild(tableRow);
    bodyTable.id = "tableFolder";

    for (let i = 0; i < 4; i++) {
        let nameHead = "";
        switch (i) {
            case 0:
                nameHead = "File name:";
                break
            case 1:
                nameHead = "Created date:";
                break
            case 2:
                nameHead = "Modified date:";
                break
            case 3:
                nameHead = "Size:";
                break
        }
        tableRow.appendChild(document.createElement("th")).textContent = nameHead;
    }

    createButtonsFile(openFolder);

}

function createButtonsFile(folderPath) {
    const h1Files = document.querySelector('#choose-folder-h1');
    if(h1Files !== null){
        h1Files.remove();
    }

    let divOptionsFolder = document.createElement('div');
    divOptionsFolder.className = 'buttons-files';

    let btnCreateFile = document.createElement('span');
    let iCreateFile = document.createElement('i');
    iCreateFile.className = 'fa-solid fa-file';
    btnCreateFile.textContent = 'New File';
    btnCreateFile.setAttribute('folder-path', folderPath)

    let btnCreateFolder = document.createElement('span');
    let iCreateFolder = document.createElement('i');
    iCreateFolder.className = 'fa-solid fa-plus';
    btnCreateFolder.textContent = 'New Folder';

    divFiles.prepend(divOptionsFolder);

    divOptionsFolder.appendChild(btnCreateFile);
    btnCreateFile.prepend(iCreateFile);

    divOptionsFolder.appendChild(btnCreateFolder);
    btnCreateFolder.prepend(iCreateFolder);

    btnCreateFile.addEventListener('click', uploadNewFile);
}

function showelementosOfFolder(data) {
    data.forEach(file => {
        const containerOpenFolder = document.querySelector("#tableFolder");
        let trFile = document.createElement("tr");
        let cutPath = file.lastIndexOf("/");
        let pathFile = file.slice(cutPath + 1);
        containerOpenFolder.appendChild(trFile);
        trFile.className += "elemtoOfFolder";
        trFile.setAttribute("filePath", file);

        fetch("../assets/display-metadata-file.php?filePath=" + file)
            .then(response => response.json())
            .then(data => constuctorTable(data, pathFile, trFile))

    })

    let folderElement = document.querySelectorAll(".elemtoOfFolder");
    folderElement.forEach((item) => {
        item.addEventListener("click", showInfoElement)
    });
}

function constuctorTable(data, pathFile, trFile) {
    for (let i = 0; i < 4; i++) {
        let size = "";
        if (data.size <= 1024000) {
            let sizeKb = Math.round(data.size / 1024 * 10) / 10;
            size = sizeKb + "Kb";
        } else {
            let sizeMb = Math.round(data.size / 1024000 * 10) / 10;
            size = sizeMb + "MB";
        }

        let infoTd = "";
        switch (i) {
            case 0:
                infoTd = pathFile;
                break

            case 1:
                infoTd = data.modify;
                break
            case 2:
                infoTd = data.creation;
                break
            case 3:
                infoTd = size;
                break
        }
        let tdRow = document.createElement("td");
        tdRow.textContent = infoTd;


        if (i === 0) {
            let extension = getPathExtension(pathFile);
            console.log(extension)
            let img = document.createElement("img");

            switch (extension) {
                case "mp3":
                    img.src = "../image/mp3.png";
                    break
                case "mp4":
                    img.src = "../image/mp4.png";
                    break
                case "txt":
                    img.src = "../image/txt.png";
                    break
                case "img":
                    img.src = "../image/img2.jpeg";
                    break
            }
            tdRow.prepend(img);
        }
        trFile.appendChild(tdRow);
    }
}


function getPathExtension(path) {
    let cutExtension = path.lastIndexOf(".");
    let pathExtension = path.slice(cutExtension + 1);
    let formatImg = ["jpg", "png", "webp"];

    if (formatImg.includes(pathExtension)) {
        pathExtension = "img";
    }
    return pathExtension;
}

const btnDeleteFile = document.querySelector("#delete-file");

function showInfoElement(event) {
    let atrituboFile = event.currentTarget.getAttribute("filePath")
    let pathExtension = getPathExtension(atrituboFile);

    switch (pathExtension) {
        case "txt":
            let cutPath = atrituboFile.indexOf("/");
            let pathFile = atrituboFile.slice(cutPath + 1);
            window.location.replace("../text-editor.php?pathFile=" + pathFile);
            break
        case "img":
            createFileContent("img", atrituboFile);
            break
        case "mp4":
            createFileContent("mp4", atrituboFile);
            break
        case "mp3":
            createFileContent("mp3", atrituboFile);
            break
        default:
            console.log("no podemos descargar este archivo")
            break
    }

    displayPopUp();
    btnDeleteFile.setAttribute("filePath", atrituboFile)
    btnDeleteFile.addEventListener("click", deleteFile);

}

function uploadNewFile() {
    console.log('upload')
    const divViewContent = document.querySelector('#view-content');
    const trashBtn = document.querySelector('#delete-file');

    trashBtn.style.display = 'none';

    let divBackgroundUpload = document.createElement('div');
    divBackgroundUpload.className = 'upload-file-pop-up';

    let inputFile = document.createElement('input');
    inputFile.type = 'file';


    divViewContent.prepend(divBackgroundUpload);
    divBackgroundUpload.appendChild(inputFile);


    displayPopUp();
}

function createFileContent(typeFile, data) {
    const containerContent = document.querySelector("#view-content");

    while (containerContent.firstChild) {
        containerContent.removeChild(containerContent.lastChild);
    }
    if (typeFile === "txt") {
        let elementTxt = document.createElement("div");
        elementTxt.textContent = data;
        containerContent.appendChild(elementTxt);


    } else if (typeFile === "img") {
        let elementImg = document.createElement("img");
        elementImg.src = data;
        containerContent.appendChild(elementImg);

    } else if (typeFile === "mp4") {
        let elementVideo = document.createElement("video");
        elementVideo.controls = true;
        let elementSource = document.createElement("source");
        elementSource.src = data;
        elementSource.setAttribute("type", "video/mp4");
        containerContent.appendChild(elementVideo);
        elementVideo.appendChild(elementSource);

    } else if (typeFile === "mp3") {
        let elementAudio = document.createElement("audio");
        elementAudio.controls = true;
        let elementAudioSource = document.createElement("source");
        elementAudioSource.src = data;
        elementAudioSource.setAttribute("type", "audio/mpeg");
        containerContent.appendChild(elementAudio);
        elementAudio.appendChild(elementAudioSource);
    }
}


// Trash container

function displayTrash() {

    fetch('../root/index.php')
        .then(response => response.json())
        .then(data => displayFolderTrash(data));
}

function displayFolderTrash() {
    let elLi = document.createElement('li');
    let elDiv = document.createElement('div');
    let elImgFolder = document.createElement('img');

    elDiv.className = 'trash-folder';
    elDiv.setAttribute('name-folder', trash);
    elDiv.textContent = folder;
    elImgFolder.src = '../image/folder.ico';
    elImgFolder.className = 'imageFolderTrash';
    elImgFolder.alt = 'image Folder Trash';

    divFolders.prepend(elLi);
    elLi.appendChild(elDiv);
    elDiv.prepend(elImgFolder);

}



const trashContainer = document.querySelector("#trash-container");
trashContainer.addEventListener("click", addTrash);

function addTrash(event) {
    let fileTrash = event.srcElement.getAttribute("filePath");
    console.log(fileTrash)
    fetch("../assets/add-trash.php?filePath=" + fileTrash)
        .then(response => response.json())
        .then(data => console.log(data))
}


function deleteFile(filePath) {
    const popUpDeleteConfirm = confirm("Do you want delete this file?");

    if (popUpDeleteConfirm) {
        fetch("../assets/delete-file.php?filePath=" + filePath);
        location.reload();
        addTrash();
    }
}


const btnClosePopUp = document.getElementById("close-popup");

function displayPopUp() {
    const viewContent = document.querySelector('.pop-up-file');
    viewContent.classList.toggle('hidden');

}

function closePopUp() {
    const viewContent = document.querySelector('.pop-up-file');
    viewContent.classList.toggle('hidden');
    const containerContent = document.querySelector("#view-content");
    while (containerContent.firstChild) {
        containerContent.removeChild(containerContent.lastChild);
    }
}

btnClosePopUp.addEventListener('click', closePopUp);