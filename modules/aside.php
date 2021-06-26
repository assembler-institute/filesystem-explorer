<?php

/********************************
Simple PHP File Manager
Copyright Brahim & Einar
 */

$file = $_GET['file'] ?? '';
$path = "./scripts/manage_dir.php?file=" . $file;
$MAX_SIZE_FORMATTED = min(ini_get('post_max_size'), ini_get('upload_max_filesize'));
$MAX_UPLOAD_SIZE = min(asBytes(ini_get('post_max_size')), asBytes(ini_get('upload_max_filesize')));
?>

<div class="card">
    <div class="card-body">
        <div class="dropdown">
            <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                + Add
            </button>
            <div class="dropdown-menu" data-file="<?= $entry["path"]; ?>" aria-labelledby="dropdownMenuButton">
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#exampleModalCenter">
                    Directory
                </button>
                <button type="button" class="dropdown-item">
                    <label for="file">Upload file</label>
                    <input type="file" name="file" id="file" class="input-file" multiple />
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" id="mkdir">
                        <div class="modal-body">
                            <input type="text" id="defaultForm-name" name="directory-name" placeholder="Insert directory name" class="form-control validate">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">New folder</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->

        <h5 class="my-3">File Explorer</h5>
        <div class="fm-menu">
            <div class="list-group list-group-flush"> <a href="javascript:;" class="list-group-item py-1"><i class="bx bx-folder me-2"></i><span>All Files</span></a>
                <a href="./" class="list-group-item py-1"><i class="bx bx-devices me-2"></i><span>Root</span></a>
                <a href="javascript:;" class="list-group-item py-1"><i class="bx bx-analyse me-2"></i><span>Documents</span></a>
                <a href="javascript:;" class="list-group-item py-1"><i class="bx bx-plug me-2"></i><span>Images</span></a>
                <a href="javascript:;" class="list-group-item py-1"><i class="bx bx-plug me-2"></i><span>Audio</span></a>
                <a href="javascript:;" class="list-group-item py-1"><i class="bx bx-plug me-2"></i><span>Video</span></a>
                <a href="javascript:;" class="list-group-item py-1"><i class="bx bx-trash-alt me-2"></i><span>Deleted Files</span></a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#mkdir').submit(function(e) {
        e.preventDefault();

        $dir = $(this).find('[name="directory-name"]');
        $dir.val().length && $.post("<?= $path ?>", {
            'action': 'mkdir',
            dirname: $dir.val(),
        }, function(data) {
            if (data.status) {
                window.location.reload();
            } else {
                console.log("Error doing ", data.action);
            }
        }, 'json');
    });

    $('#exampleModalCenter').on('shown.bs.modal', function() {
        $('#defaultForm-name').trigger('focus')
    })

    $('input[type=file]').change(function(e) {
        e.preventDefault();
        $.each(this.files, function(k, file) {
            uploadFile(file);
        });
    })

    function uploadFile(file) {
        const MAX_UPLOAD_SIZE = <?= $MAX_UPLOAD_SIZE ?>;
        const MAX_SIZE_FORMATTED = "<?= $MAX_SIZE_FORMATTED ?>";
        const dir = "<?= $file ?>";

        let formData = new FormData();
        formData.append("do", "upload-file");
        formData.append("file", file);
        formData.append("dir", dir);

        if (file.size > MAX_UPLOAD_SIZE) {
            $('#danger-alert').addClass('show');
            $('#danger-alert').
            text('Size exceeds max_upload_size ' + MAX_SIZE_FORMATTED);
            window.setTimeout(function() {
                $('#danger-alert').removeClass('show');
            }, 5000);
            return;
        }

        $.ajax({
                url: "./scripts/upload_files.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
            .done(function(res) {
                $('#success-alert').addClass('show');
                $('#success-alert').
                text('File ' + file.name + ' uploaded successfully');
                window.setTimeout(function() {
                    window.location.reload();
                }, 2000);
            });
    }
</script>