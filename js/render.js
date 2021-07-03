// ------------ Global vars ---------------
var relativeX;
var relativeY;

// ----------- Adding listeners -----------

// New options panel
$("#addNew").on("click", showNewOptions);
$("#newOptionsPanelBackground").on("click", hideNewOptions);

// Folder form panel
$("#createFolder").on("click", showCreateFolderForm);
$("#createFolderBackground").on("click", hideCreateFolderForm);
$("#cancelBtnForm").on("click", hideCreateFolderForm);
$("#closeCreateFolderBtn").on("click", hideCreateFolderForm);

// Render fileDir options panel
// $(".renderOptions").on("click", showFileDirOptions);
// $("#newOptionsPanelBackground").on("click", hideFileDirOptions);

// Rename form panel
$(".bi-pencil-square").on("click", showRenameForm);
$("#createFolderBackground").on("click", hideRenameForm);
$("#closeRenameFolderBtn").on("click", hideRenameForm);
$("#cancelRenameBtnForm").on("click", hideRenameForm);

// OpenFile panel
$("#createFolderBackground").on("click", hideOpenFile);

// -------- Render Functions -----------
function showNewOptions(event) {
  if (
    $("#newOptionsPanel").css("display") === "none" &&
    event.target.id === "addNew"
  ) {
    $("#newOptionsPanelBackground").show();
    $("#newOptionsPanel").show();
  }
}

function hideNewOptions() {
  $("#newOptionsPanel").hide();
  $("#newOptionsPanelBackground").hide();
}

function showCreateFolderForm() {
  $("#newOptionsPanel").hide();
  $("#newOptionsPanelBackground").hide();
  $("#createFolderForm").show();
  $("#createFolderBackground").show();
}

function hideCreateFolderForm() {
  $("#createFolderForm").hide();
  $("#createFolderBackground").hide();
}

// function showFileDirOptions(event) {
//   getCurrentName(event);
//   // getWindowXY(event);
//   $("#fileDirOptionsPanel").css("top", relativeY);
//   $("#fileDirOptionsPanel").css("left", relativeX);
//   $("#fileDirOptionsPanel").show();
//   $("#newOptionsPanelBackground").show();
//   // console.log("$('#oldName').value -->", $("#oldName").val());
// }

// function hideFileDirOptions() {
//   $("#fileDirOptionsPanel").hide();
//   $("#newOptionsPanelBackground").hide();
// }

function showRenameForm(event) {
  getCurrentName(event);
  console.log("$('#oldName').value -->", $("#oldName").val());
  $("#renamerForm").show();
  $("#createFolderBackground").show();
}

function hideRenameForm() {
  $("#renamerForm").hide();
  $("#createFolderBackground").hide();
}

function hideOpenFile() {
  $(".renderFileSection").hide();
  $("#createFolderBackground").hide();
}
// --------- Other functions --------------
// function getWindowXY(event) {
//   relativeX = event.pageX;
//   relativeY = event.pageY;
// }

function getCurrentName(event) {
  console.log("event.target -->", event.target);
  let notCroppedID = event.target.id;
  let oldName = "";
  if (notCroppedID.indexOf("Rename")) {
    oldName = notCroppedID.replace("Rename", "");
  }
  $("#oldName").attr("value", oldName);
}
