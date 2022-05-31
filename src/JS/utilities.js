const getFiles = async () => {
  const response = await fetch(
    "http://192.168.64.2/Managizer-filesystem-explorer/src/modules/sendFileInfo.php",
    { mode: "no-cors" }
  );
  const files = await response.json();
  return files;
};

const fileIcons = {
  doc: "../assets/doc.png",
  csv: "../src/assets/archivo-csv.png",
  jpg: "../src/assets/jpg.png",
  png: "../src/assets/png.png",
  txt: "../src/assets/archivo-txt.png",
  ppt: "../src/assets/png.png",
  odt: "../src/assets/archivo-odt.png",
  pdf: "../src/assets/pdf-file.png",
  zip: "../src/assets/archivo-zip.png",
  rar: "../src/assets/archivo-rar.png",
  exe: "../src/assets/exe.png",
  svg: "../src/assets/archivo-csv.png",
  mp3: "../src/assets/archivo-mp3.png",
  mp4: "../src/assets/mp4.png",
  folder: "../src/assets/folder.png"
};

export const displayFileIcon = () => {
  const fileIconsEl = document.querySelectorAll('[file-icon]');
  fileIconsEl.forEach(iconEl => {
    // getting the extention of the current file from its title
    const fileTitleEl = iconEl.parentElement.querySelector('[file-title]').textContent;
    const fileTitleSplitArray = fileTitleEl.split('.');
    const fileExt = fileTitleSplitArray[fileTitleSplitArray.length - 1];
    iconEl.src = fileExt.length > 3 ? fileIcons.folder : fileIcons[fileExt];
    iconEl.alt = fileExt.length > 3 ? "folder-icon" : `${fileExt}-icon`;

    
  })
}

 export const appendInfoToFilePreview = async (fileTitle) => {
    const allFiles = await getFiles();
    // getting the right file from JSON res by comparing it tothe card title
    const fileNeeded = allFiles.filter(file => file.name == fileTitle)[0];
    const {name , size , ext, modified} = fileNeeded;
  
    const previewImageEl = document.getElementById('preview-image');
    // appending the correct file icon from the fileIcon object
    previewImageEl.src = ext == "" ? fileIcons.folder : fileIcons[ext];
  
    const previewTilteEl = document.getElementById('preview-title');
    previewTilteEl.textContent = name;
  
    const fileSizePreviewEL = document.getElementById('fileSizePreview');
    // showing the size of the file above 1MB in MB or less in KB
    fileSizePreviewEL.textContent = size > 1000000 ? `Size: ${(size/1000000).toFixed(1)} MB` : `Size: ${(size/1024).toFixed(1)} KB`
    
    const fileExtensionPreviewEl = document.getElementById('fileExtensionPreview');
    // checking file extension whether it's a file or a directory
    fileExtensionPreviewEl.textContent = ext == "" ? "File type: folder" : `File type: ${ext}`;
  
    const fileLastModifiedEl = document.getElementById('fileLastModified');
    fileLastModifiedEl.textContent = `Last Modfied: ${modified}`;
  }

  export default {appendInfoToFilePreview, displayFileIcon};