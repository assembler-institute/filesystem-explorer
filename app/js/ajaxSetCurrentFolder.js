function ajaxSetCurrentFolder(fileUrl) {
  $.ajax({
    url: "../../app/php/tableFillContent.php",
    type: "post",
    data: {
      filePath: fileUrl,
    },
    success: function (response) {
      if (response) {
        console.log(response);
        //?recharge table
      }
    },
  });
}
