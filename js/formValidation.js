// Rename Validation
function renameValidation() {
  let currentName = document.forms["renameForm"]["oldName"].value;
  let newName = document.forms["renameForm"]["newName"].value;
  let allowedExtensions = [
    "doc",
    "csv",
    "jpg",
    "png",
    "txt",
    "ppt",
    "odt",
    "pdf",
    "zip",
    "rar",
    "exe",
    "svg",
    "mp3",
    "mp4",
  ];
  
  if (currentName === newName) {
    alert("The new name needs to be different to the current name");
    return false;
  } else if (currentName !== newName && currentName.indexOf(".") > -1) {
    let splitCurrentName = currentName.split(".");
    let splitNewName = newName.split(".");

    if (
      splitCurrentName[splitCurrentName.length - 1] !==
      splitNewName[splitNewName.length - 1]
    ) {
      alert("The file extension cannot be changed");
      return false;
    } else {
      return true;
    }
  } else if (currentName !== newName && currentName.indexOf(".") === -1) {
    if (newName.indexOf(".") > -1) {
      let splitNewFolderName = newName.split(".");
      let unnecessaryExtension = false;

      for (let i = 0; i < allowedExtensions.length; i++) {
        if (
          splitNewFolderName[splitNewFolderName.length - 1] ===
          allowedExtensions[i]
        ) {
          unnecessaryExtension = true;
        }
      }
      if (unnecessaryExtension === true) {
        alert("A folder does not need an extension");
        return false;
      } else {
        return true;
      }
    }
    return true;
  }
}
