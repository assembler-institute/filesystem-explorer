function ajaxRename(oldName, newName, file) {
  $.ajax({
    url: "../../app/php/renameFile.php",
    type: "post",
    data: {
      oldName: oldName,
      newName: newName,
      file: file,
    },
    success: function (response) {
      if (response) {
        Swal.fire({
          icon: "success",
          title: "File renamed",
          showConfirmButton: false,
          timer: 1500,
        });
        //?recharge table
        loadTable();
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
