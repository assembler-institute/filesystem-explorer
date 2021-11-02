targetClassName = "";
targetIdName = "";
basePath = "/xampp/htdocs/filesystem-explorer/src/UNIT";
selectFolder(basePath);

$(document).on("click", (e) => {
  targetClassName = e.target.className;
  targetIdName = e.target.id;
  path = e.target.dataset.dir;
  if (targetClassName.indexOf("file-info") !== -1) {
    $(".file-info-container").removeClass("info-container-anim");
    if (path) {
      updatePath(path);
    }
    if (targetIdName === "delete-file") {
      deleteFile(path);
    }
  } else {
    $(".file-info-container").addClass("info-container-anim");
  }
  if (targetClassName.indexOf("folder-tree-folder") !== -1) {
    selectFolder(path);
  }
  if (targetClassName.indexOf("folder-tree-file") !== -1) {
    searchFileInfo(path);
  }
  if (targetIdName === "create-folder") {
    openCreateFolderModal();
  }
  if (targetIdName === "upload-file") {
    openUploadFileModal();
  }
  if (targetIdName === "edit-folder") {
    openEditFolderModal();
  }
  if (targetIdName === "delete-folder") {
    openDeleteFolderModal();
  }
  if (targetIdName === "play-file") {
    openPlayFileModal();
  }
  if (targetClassName.indexOf("modal-background") !== -1) {
    if ($(".create-folder-modal")) {
      closeCreateFolderModal();
    }
    if ($(".edit-folder-modal")) {
      closeEditFolderModal();
    }
    if ($(".delete-folder-modal")) {
      closeDeleteFolderModal();
    }
    if ($(".upload-file-modal")) {
      closeUploadFileModal();
    }
    if ($(".play-file-modal")) {
      closePlayFileModal();
    }
  }
  if (targetIdName === "create-folder-btn") {
    createFolder(e);
  }
  if (targetIdName === "edit-folder-btn") {
    editFolder(e);
  }
  if (targetIdName === "delete-folder-btn") {
    deleteFolder(e);
  }
});

$("#search-bar").on("input", (e) => {
  let path = "/xampp/htdocs/filesystem-explorer/src/UNIT";
  let pattern = e.target.value;
  searchPatternInDir(path, pattern);
});

function test() {
  $.ajax({
    type: "POST",
    url: "fileControll/tests.php",
    success: function (response) {
      console.log(response);
    },
  });
}

function selectFolder(path) {
  updatePath(path);
  $.ajax({
    type: "POST",
    url: "fileControll/selectDir.php",
    data: { path: path, valid: "yes" },
    beforeSend: function () {
      $(".main-content-ul").html("Procesando, espere por favor...");
    },
    success: function (response) {
      $(".main-content-ul").html(response);
      updateAsideFolderTree(path);
    },
  });
}

function updatePath(path) {
  $.ajax({
    type: "POST",
    url: "fileControll/session.php",
    data: { path: path, valid: "yes" },
    success: function (response) {
      $(".subheader").html("");
      const a = "/xampp/htdocs/filesystem-explorer/src/";

      const b = response;

      const diff = (diffMe, diffBy) => diffMe.split(diffBy).join("");

      const c = diff(b, a);
      let splited = c.split("/");
      splited.forEach((i) => {
        $(".subheader").append('<div class="subheader-path">' + i + "</div>");
      });
    },
  });
}

function searchFileInfo(path) {
  $.ajax({
    type: "POST",
    url: "fileControll/searchFileInfo.php",
    data: { path: path, valid: "yes" },
    success: function (response) {
      $(".file-info-container").html(response);
    },
  });
}

function deleteFile() {
  $.ajax({
    url: "fileControll/deleteFile.php",
    success: function (response) {
      var split = response.split("/");
      response = split.slice(0, split.length - 1).join("/");
      selectFolder(response);
    },
  });
}

function searchPatternInDir(path, pattern) {
  $.ajax({
    type: "POST",
    url: "fileControll/searchPatternInDir.php",
    data: { path: path, valid: "yes", pattern: pattern },
    success: function (response) {
      $(".main-content-ul").html(response);
    },
  });
}

function openCreateFolderModal() {
  $.ajax({
    url: "fileControll/session.php",
    success: function (response) {
      const templateContent = document.querySelector(
        "#create-folder-modal"
      ).content;
      document
        .querySelector("main")
        .appendChild(document.importNode(templateContent, true));
      $("#session-path").html(response);
    },
  });
}

function closeCreateFolderModal() {
  document.querySelector(".create-folder-modal")?.remove();
  document.querySelector(".modal-background")?.remove();
}

function createFolder(e) {
  e.preventDefault();
  let newFolderName = $("#create-folder-name").val();
  $.ajax({
    type: "POST",
    url: "fileControll/createFolder.php",
    data: { newFolderName: newFolderName, valid: "yes" },
    success: function (response) {
      selectFolder(response);
      closeCreateFolderModal();
    },
  });
}

function openEditFolderModal() {
  $.ajax({
    url: "fileControll/session.php",
    data: { tmpPath: "yes" },
    success: function (response) {
      const templateContent =
        document.querySelector("#edit-folder-modal").content;
      document
        .querySelector("main")
        .appendChild(document.importNode(templateContent, true));
      let split = response.split("/");
      path = split.slice(split.length - 1, split.length);
      $("#edit-folder-name").val(path);
    },
  });
}

function closeEditFolderModal() {
  document.querySelector(".edit-folder-modal")?.remove();
  document.querySelector(".modal-background")?.remove();
}

function editFolder(e) {
  e.preventDefault();
  let editFolderName = $("#edit-folder-name").val();
  $.ajax({
    type: "POST",
    url: "fileControll/editFolder.php",
    data: { editFolderName: editFolderName, valid: "yes" },
    success: function (response) {
      selectFolder(response);
      closeEditFolderModal();
    },
  });
}

function openDeleteFolderModal() {
  $.ajax({
    url: "fileControll/session.php",
    success: function (response) {
      const templateContent = document.querySelector(
        "#delete-folder-modal"
      ).content;
      document
        .querySelector("main")
        .appendChild(document.importNode(templateContent, true));
      $("#delete-folder-name").val(path);
    },
  });
}

function closeDeleteFolderModal() {
  document.querySelector(".delete-folder-modal")?.remove();
  document.querySelector(".modal-background")?.remove();
}

function deleteFolder(e) {
  e.preventDefault();
  $.ajax({
    type: "POST",
    url: "fileControll/deleteFileFolder.php",
    data: { valid: "yes" },
    success: function (response) {
      if (response !== "/xampp/htdocs/filesystem-explorer/src/UNIT") {
        var split = response.split("/");
        response = split.slice(0, split.length - 1).join("/");
        selectFolder(response);
      } else {
        selectFolder(response);
      }
      closeDeleteFolderModal();
    },
  });
}

function openUploadFileModal() {
  $.ajax({
    url: "fileControll/session.php",
    success: function (response) {
      const templateContent =
        document.querySelector("#upload-file-modal").content;
      document
        .querySelector("main")
        .appendChild(document.importNode(templateContent, true));
      $("#session-path-upload").html(response);
    },
  });
}

function closeUploadFileModal() {
  document.querySelector(".upload-file-modal")?.remove();
  document.querySelector(".modal-background")?.remove();
}

function openPlayFileModal() {
  const templateContent = document.querySelector("#play-file-modal").content;
  document
    .querySelector("main")
    .appendChild(document.importNode(templateContent, true));

  $.ajax({
    url: "fileControll/getGlobalPath.php",
    data: { valid: "yes" },
    success: function (response) {
      let split = path.split(".");
      let extension = split.slice(split.length - 1, split.length);
      if (
        extension.includes("png") ||
        extension.includes("jpg") ||
        extension.includes("jpeg") ||
        extension.includes("svg")
      ) {
        $(".play-file-modal").html('<img src="' + response + '">');
      } else if (extension.includes("mp4")) {
        $(".play-file-modal").html(
          '<video controls><source src="' +
            response +
            '" type="video/mp4">Your browser does not support the video tag.</video>'
        );
      } else if (extension.includes("mp3")) {
        $(".play-file-modal").html(
          '<audio controls><source src="' +
            response +
            '" type="video/mp4">Your browser does not support the audio tag.</video>'
        );
      }
    },
  });
}

function closePlayFileModal() {
  document.querySelector(".play-file-modal")?.remove();
  document.querySelector(".modal-background")?.remove();
}

function updateAsideFolderTree(currentFolderPath) {
  $.ajax({
    type: "POST",
    url: "fileControll/asideFolderTree.php",
    data: { currentFolderPath: currentFolderPath, valid: "yes" },
    beforeSend: function () {
      $(".folder-tree-container").html("...");
    },
    success: function (response) {
      $(".folder-tree-container").html(response);
    },
  });
}
