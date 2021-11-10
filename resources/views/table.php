<?php
include "../../app/php/tableFillContent.php";
include "../../app/php/utils/getCurrentFolder.php";


?>

<table id="table_id" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Create</th>
            <th>Modify</th>
            <th>Size</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $path = $_SESSION['folderPath'] . '/*';
        tableFillContent($path);
        ?>
    </tbody>
</table>


<script type="text/javascript">
    //! charge datatable dont move!!
    $(document).ready(function() {

        $('#table_id').DataTable({
            columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [4],
                orderData: [4, 0]
            }],
            "destroy": true
        });

    });
</script>