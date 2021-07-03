/*$( "#target" ).dblclick(function() {
     alert( "Handler for .dblclick() called." );
});*/

function handleEvents() {
  /* Click event */

  document.addEventListener("click", (e) => {
    //     console.log("estoy dentro pero no hago el click");
    if (e.target.matches(".clickMe>*")) {
      var prueba = e.target.dataset.id;
      var formId = new FormData();
      formId.append("prueba", prueba);
      $.ajax({
        type: "POST",
        url: "includes/showData.php",
        data: formId,
        dataType: "json",
        //asycn:false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          // console.log(data);
          if (data === null) {
          } else {
            //$("#name").remove();
            $("#icon").hide();
            let iconClass = "";

            if (data.size == "null" && data.extension == "null") {
               $("#infoContainer").hide();
               $("#container").show();
               $("#labelCreate").show();
               $("#labelName").show();
              $("#dateCreation").show();
              $("#labelModification").show();
               $("#labelSize").hide();
              $("#labelExtension").hide();
              $("#size").hide();
              $("#extension").hide();
              $("#titleName").text(data.name);
              $("#name").text(data.name);
              $("#dateCreation").text(data.dataCreation);
              $("#modification").text(data.modification);
              iconClass = "bi bi-folder-fill";
              $("#iconTitle").attr("class", iconClass);
              $("#iconTitle").show();
            }
            if (data.size !== "null" && data.extension !== "null") {
              $("#infoContainer").hide();
               $("#container").show();
               $("#labelName").show();
               $("#labelCreate").show();
              $("#dateCreation").show();
              $("#labelModification").show();
              $("#labelSize").show();
              $("#labelExtension").show();
              $("#size").show();
              $("#extension").show();
              $("#titleName").text(data.name);
              $("#name").text(data.name);
              $("#dateCreation").text(data.dataCreation);
              $("#modification").text(data.modification);
              $("#size").text(data.size);
              $("#extension").text(data.extension);
              // Choosing file extension icon to render
              switch (data.extension) {
                case ".doc":
                  iconClass = "bi bi-file-word-fill";
                  break;
                case ".csv":
                  iconClass = "bi bi-file-excel-fill";
                  break;
                case ".jpg":
                  iconClass = "bi bi-file-image-fill";
                  break;
                case ".png":
                  iconClass = "bi bi-file-image-fill";
                  break;
                case ".txt":
                  iconClass = "bi bi-file-text-fill";
                  break;
                case ".ppt":
                  iconClass = "bi bi-file-ppt-fill";
                  break;
                case ".odt":
                  iconClass = "bi bi-file-word-fill";
                  break;
                case ".pdf":
                  iconClass = "bi bi-file-pdf-fill";
                  break;
                case ".zip":
                  iconClass = "bi bi-file-zip-fill";
                  break;
                case ".rar":
                  iconClass = "bi bi-file-zip-fill";
                  break;
                case ".exe":
                  iconClass = "bi bi-file-code-fill";
                  break;
                case ".svg":
                  iconClass = "bi bi-file-image-fill";
                  break;
                case ".mp3":
                  iconClass = "bi bi-file-music-fill";
                  break;
                default:
                  iconClass = "bi bi-file-play-fill";
                  break;
              }

              $("#iconTitle").attr("class", iconClass);
              $("#iconTitle").show();
            }
          }
        },
      });
    }
  });
}

handleEvents();
