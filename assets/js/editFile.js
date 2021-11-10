$(document).ready(function () {
    $(".editFile").click(function (e) {
        let fileUrl = e.target.dataset.file;
        console.log(fileUrl);
        document.querySelector("#oldNameInput").value = fileUrl;

        let splitUrl = fileUrl.split("/");
        document.querySelector("#newName").value = splitUrl[splitUrl.length - 1];

        // $.ajax({

        //     url: "../../filesystem-explorer/modules/editFile.php",
        //     type: "post",
        //     data: {
        //         filePath: fileUrl
        //     },
        //     success: function (response) {
        //         window.location.reload();
        //     },
        //     error: function () {
        //         alert('There was some error performing the AJAX call!');
        //     }
        // });
    })
})