<?php
include "../../app/php/sidebarFillContent.php";
?>

<h1>Folders</h1>
<ul class="list-unstyled ps-0" id="folderSidebar">
    <li class="border-top my-3"></li>
    <!-- From here -->
    <li class="mb-1" id="folder-0" data-file="../../storage">
        <button id="folderButton" class="btn btn-toggle  align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#folder-0-collapse" aria-expanded="true">
            <h1> Root </h1>
        </button>
        <div class="collapse show" id="folder-0-collapse">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <!-- From here -->
                <?php
                sidebarFillContent()
                ?>
                <!-- To here -->
            </ul>
        </div>
    </li>
    <!-- To here -->
    <li class="border-top my-3"></li>
    <form id="addFolder">
        <input type="text" id="folderName" class="form-control" />
        <input type="submit" class="btn btn-primary m-4" value="Add folder" />

    </form>


</ul>
<script>
    $('#addFolder').submit((e) => {
        e.preventDefault();
        $folderName = $('#addFolder input').val()
        ajaxCreateFolder($folderName);

    })
</script>