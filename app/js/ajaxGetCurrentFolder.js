function ajaxGetCurrentFolder(fileUrl) {
  $.ajax({
    url: "../../app/php/utils/getCurrentFolder.php",
    type: "post",
    data: {
      filePath: fileUrl,
    },
    success: function (response) {
      if (response) {
        console.log(response);
        //?recharge table
        loadTable();
      }
    },
  });
}
