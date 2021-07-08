const deleteFileModal = document.getElementById("deleteFileModal");
const deleteFolderModal = document.getElementById("deleteFolderModal");
const renameFileModal = document.getElementById("renameFileModal");
const renameFolderModal = document.getElementById("renameFolderModal");
const newFolderModal = document.getElementById("newFolderModal");

deleteFileModal.addEventListener("show.bs.modal", populateDeleteFileModal);
deleteFolderModal.addEventListener("show.bs.modal", populateDeleteFolderModal);
renameFileModal.addEventListener("show.bs.modal", populateRenameFileModal);
renameFolderModal.addEventListener("show.bs.modal", populateRenameFolderModal);
newFolderModal.addEventListener("show.bs.modal", populateNewFolderModal);

function populateDeleteFileModal(event) {
  const deleteFileButton = document.getElementById("deleteFileButton");
  const deleteFileName = document.getElementById("deleteFileName");
  let value = event.relatedTarget.value;
  deleteFileName.innerHTML = value;
  deleteFileButton.value = value;
}
function populateDeleteFolderModal(event) {
  const deleteFolderButton = document.getElementById("deleteFolderButton");
  const deleteFolderName = document.getElementById("deleteFolderName");
  let value = event.relatedTarget.value;
  deleteFolderName.innerHTML = value;
  deleteFolderButton.value = value;
}
function populateRenameFileModal(event) {
  const renameFileButton = document.getElementById("renameFileButton");
  const renameFileName = document.getElementById("renameFileName");
  let value = event.relatedTarget.value.split(".").slice(0, -1).join(".");
  renameFileName.innerHTML = value;
  renameFileButton.value = event.relatedTarget.value;
}
function populateRenameFolderModal(event) {
  const renameFolderButton = document.getElementById("renameFolderButton");
  const renameFolderName = document.getElementById("renameFolderName");
  let value = event.relatedTarget.value;
  renameFolderName.innerHTML = value;
  renameFolderButton.value = value;
}
function populateNewFolderModal(event) {
  const newFolderButton = document.getElementById("newFolderButton");
  const newFolderName = document.getElementById("newFolderName");
  let value = event.relatedTarget.value;
  newFolderName.innerHTML = value;
  newFolderButton.value = value;
}
