// Show files according to the folder selected in tree.
for (let i = 0; i < document.getElementsByClassName("item-showfiles").length; i++) {
  document.getElementsByClassName("item-showfiles")[i].addEventListener("click", function () {
    let folderId = this.getAttribute("value");
    window.location = `${window.location.pathname}?folder-id=${folderId}`;
  });
}

// Show files according to the folder selected in main.
for (let i = 0; i < document.getElementsByClassName("item-folder").length; i++) {
  document.getElementsByClassName("item-folder")[i].addEventListener("dblclick", function () {
    let folderId = this.getAttribute("value");
    window.location = `${window.location.pathname}?folder-id=${folderId}`;
  });
}

// Show files in the trash.
document.getElementById("trash-id").addEventListener("click", function () {
  window.location = `${window.location.pathname}?trash=true`;
});