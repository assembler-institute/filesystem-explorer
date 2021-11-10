function ajaxOpenFile(fileUrl) {
  $.ajax({
    url: "../../app/php/openFile.php",
    type: "post",
    data: {
      filePath: fileUrl,
    },
    success: function (response) {
      if (response) {
        console.log(response)
        Swal.fire({
          html:`${response}`
        });
      } else {
        console.log(response)
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Something went wrong!",
        });
      }
    },
  });
}
