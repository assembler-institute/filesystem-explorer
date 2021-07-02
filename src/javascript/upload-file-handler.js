//Upload file handler
document.getElementById("upload-file-input").addEventListener("change", function() {
  let input = document.getElementById("upload-file-input");
  let file = input.files[0];
  let folderId = input.getAttribute("data-folder");

  if(file != undefined){
    var formData = new FormData();
    formData.append("file", file);
    formData.append("folder-id", folderId);

    $.ajax({
      url: "../../php/local_files/upload_file.php",
      type: "post",
      data: formData,
      processData: false,
      contentType: false,
      success: function(succes){
        if(succes == 1){
          location.reload();
        } else {
          alert("File exceeds the limit of 42MB");
        }
      }
    });
  }
});