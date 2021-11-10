<?php
include "utils/fileBrowser.php";
include "utils/getFileSize.php";



function tableFillContent($path = "")
{
    $id = 0;
    foreach (fileBrowser($path) as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) !== "") {

            $fileName =  explode('.', basename($file))[0];
            $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $fileCreate =  date("Y-m-d H:m:s", filectime($file));
            $fileModify =  date("Y-m-d H:m:s", filemtime($file));
            $id++;
?>

            <tr id="<?php echo  $id ?> " data-file="<?php echo  $file ?>">
                <td>
                    <p id="name-<?php echo $id ?>"> <?php echo $fileName ?></p>
                </td>
                <td><?php echo $fileType ?></td>
                <td><?php echo $fileCreate ?></td>
                <td><?php echo $fileModify ?></td>
                <td><?php echo getFileSize($file) ?></td>
                <td>
                    <button id="showFile" class="btn btn-light  m-1">▶️ </button>
                    <button id="renameFile" class="btn btn-light  m-1">✏️ </button>
                    <button id="deleteFile" class="btn btn-light m-1">❌</button>

                </td>
            </tr>
<?php
        }
    }
}

?>
<script>
    //?eventListener Rename
    $(document).on('click', '#renameFile', function(e) {
        e.stopPropagation();
        e.preventDefault();
        $id = e.target.parentElement.parentElement.id;
        $file = e.target.parentElement.parentElement.dataset.file
        let $target = $('#name-' + $id);
        $target.attr("contentEditable", true);
        $target.focus();
        $oldName = $target.text();

        $target.keyup((e) => {
            e.stopPropagation();
            e.preventDefault();

            if (e.keyCode === 13) {
                document.execCommand('delete', false, '<br/>');
                return e.target.blur();
            }
        })
        $target.blur(() => {
            e.stopPropagation();
            e.preventDefault();
            $newName = $target.text();
            $target.removeAttr('contentEditable');
            ajaxRename($oldName, $newName, $file);
        })
    });

    //?eventListener Delete
    $(document).on('click', '#deleteFile', function(e) {
        $fileUrl = e.target.parentElement.parentElement.dataset.file;
        ajaxDelete($fileUrl);
    })

    $(document).on('click', '#showFile', function(e) {
        $fileUrl = e.target.parentElement.parentElement.dataset.file;
        ajaxOpenFile($fileUrl);
    })
</script>