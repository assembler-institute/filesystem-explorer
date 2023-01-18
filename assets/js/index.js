const createFolderBtn = document.querySelectorAll(".create-folder-btn");
const filesAndFoldersContainer = document.getElementsByTagName("main")[0];
const noFilerOrFoldersAlert = document.querySelector(
  ".empty-root-folder-alert"
);
const btnsContainer = document.querySelectorAll(".btns-container");
const menu = document.querySelector(".menu");
const deleteBtn = document.querySelector("#delete-btn");
const renameBtn = document.querySelector("#renameBtn");
const uploadFileBtn = document.querySelectorAll(".upload-file-btn");
const uploadInput = document.getElementById("upload-input");
const infoBtn = document.querySelector("#infoBtn");
const confirmationModal = document.querySelector("#confirmationModal");
const checkBtn = document.querySelector("#checkBtn");
const dismissBtn = document.querySelector("#dismissBtn");
const previewModal = document.querySelector("#previewModal");
const closePreviewModal = document.querySelector("#closePreviewModal");
const viewMoreBtn = document.querySelector("#viewMoreBtn");
const previewContainer = document.querySelector(".preview-container");

const infoName = document.querySelector("#infoName");
const infoType = document.querySelector("#infoType");
const infoSize = document.querySelector("#infoSize");
const infoUpdate = document.querySelector("#infoUpdate");
const infoCreation = document.querySelector("#infoCreation");

const searchInputBtn = document.querySelector("#searchInputBtn");
const searchInput = document.querySelector("#searchInput");

let pathToDelete;
let currentFolder;

for (let btn of createFolderBtn) {
  btn.addEventListener("click", (e) => createFolder(e));
}

for (let btn of uploadFileBtn) {
  btn.addEventListener("click", uploadFile);
}

document.body.addEventListener("click", closeMenu);
deleteBtn.addEventListener("click", toggleConfirmationVisibility);
dismissBtn.addEventListener("click", toggleConfirmationVisibility);
checkBtn.addEventListener("click", deleteDir);
renameBtn.addEventListener("click", renameDirFromMenu);
uploadInput.addEventListener("change", submitUploadForm);
closePreviewModal.addEventListener("click", togglePreviewModalVisibility);
closePreviewModal.addEventListener("click", stopMusicOrVideo);
searchInputBtn.addEventListener("click", search);

function createFolder(e) {
  currentDirectory = "." + e.target.getAttribute("path");
  filePath = e.target.getAttribute("path");
  fetch(
    `./modules/createFolder.php?path=${currentDirectory}&filepath=${filePath}`,
    {
      method: "GET",
    }
  )
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        const folder = document.createElement("div");

        folder.classList.add("folder-container");
        folder.innerHTML = `<div class='folder' path=${data.path} ondblclick="navigateToFolder(event)" onclick="printInfo(event)" oncontextmenu='openMenu(event)'"></div>
                    <p onclick='openRenameFolderInput(event)'>${data.dir}</p>`;
        filesAndFoldersContainer.insertAdjacentElement("afterbegin", folder);
        noFilerOrFoldersAlert
          ? (noFilerOrFoldersAlert.style.display = "none")
          : null;

        for (let btnContainer of btnsContainer) {
          btnContainer.style.display = "flex";
        }
      }
    })
    .catch((err) => console.log("Request: ", err));
}

function openRenameFolderInput(event) {
  let folderName = event.target;
  selectItem(folderName);

  let text = event.target.innerText;
  let folderContainer = folderName.parentElement;
  let input = document.createElement("input");

  input.classList.add("rename-input");
  input.type = "text";
  input.value = text;
  input.classList.add("rename-input");
  input.addEventListener("focusout", rename);
  folderContainer.removeChild(folderName);
  folderContainer.appendChild(input);
  input.focus();
  input.select();
}

function navigateToFolder(event) {
  let path = event.target.getAttribute("path");

  fetch(`./modules/savePathToSession.php?path=${path}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        currentDirectory = data.path;
        filesAndFoldersContainer.innerHTML = "";
        window.location.href = "./index.php";
      }
    })
    .catch((err) => console.log("Request: ", err));
}

function rename(e) {
  let newText = e.target.value;
  let folder = e.target.parentElement.children[0];
  let path = folder.getAttribute("path");

  fetch(`./modules/renameFolder.php?path=${path}&text=${newText}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        let folderContainer = folder.parentElement;
        let input = folderContainer.children[1];

        let folderName = document.createElement("p");
        folderName.innerText = input.value;
        folderName.addEventListener("click", openRenameFolderInput);

        folderContainer.removeChild(input);
        folderContainer.appendChild(folderName);

        folder.setAttribute("path", data.newPath);
      }
    })
    .catch((err) => console.log("Request: ", err));
}

function openMenu(event) {
  pathToDelete = event.target.getAttribute("path");
  currentFolder = event.target;
  selectItem(event.target);

  menu.classList.remove("hidden");
  menu.style.left = event.pageX - 10 + "px";
  menu.style.top = event.pageY - 10 + "px";

  setTimeout(() => {
    menu.style.opacity = 1;
  }, 10);
}

function closeMenu() {
  menu.style.opacity = 0;

  setTimeout(() => {
    menu.classList.add("hidden");
  }, 300);
}

function toggleConfirmationVisibility() {
  confirmationModal.classList.toggle("hidden");
}

function deleteDir() {
  fetch(`./modules/deleteDir.php?path=${pathToDelete}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.ok) {
        filesAndFoldersContainer.removeChild(currentFolder.parentElement);
      }
    })
    .catch((err) => console.log("Request: ", err));

  confirmationModal.classList.add("hidden");
}

function renameDirFromMenu() {
  let folderName = currentFolder.parentElement.children[1];
  let text = folderName.innerText;
  let folderContainer = currentFolder.parentElement;
  let input = document.createElement("input");

  input.classList.add("rename-input");
  input.type = "text";
  input.value = text;
  input.classList.add("rename-input");
  input.addEventListener("focusout", rename);

  folderContainer.removeChild(folderName);
  folderContainer.appendChild(input);

  input.focus();
  input.select();
}

function uploadFile() {
  uploadInput.click();
}

function submitUploadForm(e) {
  let file = e.target.files[0];
  const form_data = new FormData();

  form_data.append("file", file);

  fetch(`./modules/uploadFiles.php`, {
    method: "POST",
    body: form_data,
  })
    .then((response) => response.json())
    .then((data) => {
      let file = document.createElement("div");
      file.classList.add("file-container");

      let fileImg = document.createElement("div");
      fileImg.classList.add("file");
      fileImg.classList.add(data.extension.toLowerCase());
      fileImg.setAttribute("path", data.path);
      file.addEventListener("contextmenu", (e) => openMenu(e));
      file.addEventListener("click", printInfo);
      file.addEventListener("dblclick", togglePreviewModalVisibility);

      let fileName = document.createElement("p");
      fileName.classList.add("folder-name");
      fileName.addEventListener("click", openRenameFolderInput);
      fileName.innerText = data.fileName;

      file.appendChild(fileImg);
      file.appendChild(fileName);

      filesAndFoldersContainer.appendChild(file);
      noFilerOrFoldersAlert.classList.add("hidden");
      for (let btnContainer of btnsContainer) {
        btnContainer.style.display = "flex";
      }
    })
    .catch((err) => console.log("Request: ", err));
}

function printInfo(event) {
  let path = event.target.getAttribute("path");

  selectItem(event.target);

  fetch(`./modules/getInfo.php?path=${path}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      infoName.innerText = data.name;
      infoType.innerText = data.type;
      infoSize.innerText = data.size;
      infoUpdate.innerText = data.lastUpdateDate;
      infoCreation.innerText = data.creationDate;

      infoName.style.color = "#4285f4";
      infoType.style.color = "#4285f4";
      infoSize.style.color = "#4285f4";
      infoUpdate.style.color = "#4285f4";
      infoCreation.style.color = "#4285f4";

      setTimeout(() => {
        infoName.style.color = "grey";
        infoType.style.color = "grey";
        infoSize.style.color = "grey";
        infoUpdate.style.color = "grey";
        infoCreation.style.color = "grey";
      }, 200);
    })
    .catch((err) => console.log("Request: ", err));
}

function togglePreviewModalVisibility(event) {
  previewContainer.innerHTML = "";
  let currentFile = event.target.getAttribute("path");
  previewModal.classList.toggle("hidden");

  if (!previewModal.classList.contains("hidden")) {
    setTimeout(() => {
      previewModal.style.opacity = 1;
    }, 10);
  } else {
    previewModal.style.opacity = 0;
  }

  let splittedPath = currentFile?.split(".");
  let extension =
    splittedPath && splittedPath[splittedPath.length - 1].toLowerCase();

  switch (extension) {
    case "png":
      previewContainer.innerHTML = `
        <img src=${currentFile} alt=""/>
        `;
      break;
    case "jpg":
      previewContainer.innerHTML = `
        <img src=${currentFile} alt=""/>
        `;
      break;
    case "svg":
      previewContainer.innerHTML = `
        <img src=${currentFile} alt=""></img>
        `;
      break;
    case "mp3":
      previewContainer.innerHTML = `
       <audio controls id="player">
        <source src=${currentFile} type="audio/ogg">
        <source src=${currentFile} type="audio/mpeg">
        Your browser does not support the audio element.
       </audio>
        `;
      break;
    case "mp4":
      previewContainer.innerHTML = `
       <video controls autoplay id="player" class="video">
        <source src=${currentFile} type="video/mp4">
        <source src=${currentFile} type="video/ogg">
        Your browser does not support the video tag.
       </video>
        `;
      break;
    case "pdf":
      previewContainer.innerHTML = `
       <iframe src=${currentFile} width='700' height='550' allowfullscreen webkitallowfullscreen></iframe>
        `;
      break;
    case "txt":
      readFile(currentFile);
      break;
    default:
      previewContainer.innerHTML = `
       <h1>Can not preview this file</h1>
        `;
      break;
  }
}

function stopMusicOrVideo() {
  const player = document.querySelector("#player");

  if (player) {
    player.pause();
    player.currentTime = 0;
  }
}

function readFile(path) {
  fetch(`./modules/readTextFile.php?path=${path}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      let previewTextContainer = document.createElement("div");
      previewTextContainer.classList.add("preview-text-container");

      for (let line of data.text) {
        previewTextContainer.innerHTML += `<p>${line}</p>`;
      }
      previewContainer.appendChild(previewTextContainer);
    })
    .catch((err) => console.log("Request: ", err));
}

function selectItem(item) {
  let folders = document.getElementsByClassName("folder");
  let files = document.getElementsByClassName("file");

  for (let folder of folders) {
    folder.parentElement.classList.remove("selected");
  }
  for (let file of files) {
    file.parentElement.classList.remove("selected");
  }

  item.parentElement.classList.add("selected");
}

function search() {
  let inputValue = searchInput.value;

  if (inputValue.length === 0) return;

  fetch(`./modules/search.php?search=${inputValue}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      let folders = data.folders;
      let files = data.files;

      let breadCrumbs = document.querySelector(".bread-crumbs-container");
      filesAndFoldersContainer.innerHTML = "";
      filesAndFoldersContainer.appendChild(breadCrumbs);

      files.forEach((file) => {
        let fileContainer = document.createElement("div");
        fileContainer.classList.add("file-container");

        let splittedFile = file.split(".");
        let extension = splittedFile[splittedFile.length - 1].toLowerCase();
        let path =
          "." +
          splittedFile[splittedFile.length - 2] +
          "." +
          splittedFile[splittedFile.length - 1];
        let splittedPath = path.split("/");
        let fileName = splittedPath[splittedPath.length - 1];
        let fileNameWithoutExtension = fileName.split(".");
        fileNameWithoutExtension =
          fileNameWithoutExtension[fileNameWithoutExtension.length - 2];

        fileContainer.innerHTML = `
            <div oncontextmenu='openMenu(event)' onclick='printInfo(event)' ondblclick='togglePreviewModalVisibility(event)' path=${path} class='file ${extension}'></div>
            <p onclick='openRenameFolderInput(event)'>${fileNameWithoutExtension}.${extension}</p>
        `;
        filesAndFoldersContainer.appendChild(fileContainer);
      });

      folders.forEach((folder) => {
        let folderContainer = document.createElement("div");
        folderContainer.classList.add("folder-container");

        let splittedfolder = folder.split(".");
        let path = "." + splittedfolder[splittedfolder.length - 1];
        let splittedPath = path.split("/");
        let folderName = splittedPath[splittedPath.length - 1];

        folderContainer.innerHTML = `
                    <div class='folder' path='${path}' oncontextmenu='openMenu(event)' ondblclick='navigateToFolder(event)' onclick='printInfo(event)'></div>
                    <p class='folder-name' onclick='openRenameFolderInput(event)'>${folderName}</p>         
            `;
        filesAndFoldersContainer.appendChild(folderContainer);
      });
    })
    .catch((err) => console.log("Request: ", err));
}
