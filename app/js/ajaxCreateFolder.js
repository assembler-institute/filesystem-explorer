function ajaxCreateFolder($newFolderName) {
  $.ajax({
    url: "../../app/php/createFolder.php",
    type: "post",
    data: {
      newFolderName: $newFolderName,
    },
    success: function (response) {
      if (response) {
        Swal.fire({
          icon: "success",
          title: "Folder created",
          showConfirmButton: false,
          timer: 1500,
        });
        //?recharge table
        $("#folderName").trigger("reset");
        loadSidebar();
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      }
    },
  });
}
