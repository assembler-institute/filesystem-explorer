function handleDblClickEvents() {
  document.addEventListener("dblclick", (e) => {
    if (e.target.matches(".clickMe>*")) {
      let filename = e.target.dataset.id;
      let formDbl = new FormData();
      console.log("filename--> ", filename);
      formDbl.append("filename", filename);
      $.ajax({
        type: "POST",
        url: "includes/openFile.php",
        data: formDbl,
        dataType: "json",
        //asycn:false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          if (data === null) {
            console.log("Something went wrong.");
          } else {
            console.log("data.objectDirPath --> ", data.objectDirPath);
            if (
              data.extension === "jpg" ||
              data.extension === "png" ||
              data.extension === "svg"
            ) {
              $(".renderFileSection").show();
              $("#createFolderBackground").show();
              $("#renderImg").attr("src", data.objectDirPath);
              $("#renderAudio").hide();
              $("#renderVideo").hide();
              $("#renderImg").show();
            } else if (data.extension === "mp3") {
              $(".renderFileSection").show();
              $("#createFolderBackground").show();
              $("#renderAudio").attr("src", data.objectDirPath);
              $("#renderImg").hide();
              $("#renderVideo").hide();
              $("#renderAudio").show();
            } else if (data.extension === "mp4") {
              $(".renderFileSection").show();
              $("#createFolderBackground").show();
              $("#renderVideo").attr("src", data.objectDirPath);
              $("#renderImg").hide();
              $("#renderAudio").hide();
              $("#renderVideo").show();
              console.log("data.name -->", data.name);
              console.log("data.extension -->", data.extension);
            }
          }
        },
      });
    }
  });
}

handleDblClickEvents();
