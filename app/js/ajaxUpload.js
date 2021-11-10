function ajaxUpload() {
  event.preventDefault();
  var fd = new FormData();
  var files = $("#file")[0].files;

  if (files.length > 0) {
    fd.append("file", files[0]);

    $.ajax({
      url: "../../app/php/uploadFile.php",
      type: "post",
      data: fd,
      contentType: false,
      processData: false,
      success: function (response) {
        console.log(response);
        if (response) {
          Swal.fire({
            icon: "success",
            title: "File updated",
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
  } else {
    Swal.fire({
      icon: "error",
      title: "Oops...",
      text: "Something went wrong!",
    });
  }
}
