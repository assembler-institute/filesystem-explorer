function ajaxDelete(fileUrl) {
  $.ajax({
    url: "../../app/php/deleteFile.php",
    type: "post",
    data: {
      filePath: fileUrl,
    },
    success: function (response) {
      if (response) {
        Swal.fire({
          icon: "success",
          title: "File deleted",
          showConfirmButton: false,
          timer: 1500,
        });
        //?recharge table
        loadTable();
      }
    },
  });
}
