<!-- Modal -->
<?php
function deleteFileModal()
{
    echo ("<div class='modal fade' id='deleteFileModal' tabindex='-1' aria-labelledby='deleteFileModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='deleteFileModalLabel'>Delete file</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        Are you sure you want to delete the file <b id='deleteFileName'></b>?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <form class='' method='POST' action='./modules/file-actions.php'>
                            <button type='submit' class='btn btn-danger' name='delete' value='' id='deleteFileButton'>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>");
}
function deleteFolderModal()
{
    echo ("<div class='modal fade' id='deleteFolderModal' tabindex='-1' aria-labelledby='deleteFolderModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='deleteFolderModalLabel'>Delete folder</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>
                        Are you sure you want to delete the folder <b id='deleteFolderName'></b>?
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                        <form class='' method='POST' action='./modules/file-actions.php'>
                            <button type='submit' class='btn btn-danger' name='delete' value='' id='deleteFolderButton'>Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>");
}
function renameFileModal()
{
    echo ("<div class='modal fade' id='renameFileModal' tabindex='-1' aria-labelledby='renameFileModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='renameFileModalLabel'>Rename file</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <form class='' method='POST' action='./modules/file-actions.php'>
                        <div class='modal-body'>
                            <label for='newName' class='form-label'> New name for <b id='renameFileName'></b>:</label>
                            <input type='text' class='form-control' id='newName' name='newName' >
                            <div id='renameHelpBlock' class='form-text'>
                                Please don't include the extension for the file. Spaces will be replaced for underscores.
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                            <button type='submit' class='btn btn-primary' name='rename' value='' id='renameFileButton'>Rename</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>");
}
function renameFolderModal()
{
    echo ("<div class='modal fade' id='renameFolderModal' tabindex='-1' aria-labelledby='renameFolderModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='renameFolderModalLabel'>Rename file</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <form class='' method='POST' action='./modules/file-actions.php'>
                        <div class='modal-body'>
                            <label for='newName' class='form-label'> New name for <b id='renameFolderName'></b>:</label>
                            <input type='text' class='form-control' id='newName' name='newName'>
                            <div id='renameHelpBlock' class='form-text'>
                                Spaces will be replaced for underscores.
                            </div>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                            <button type='submit' class='btn btn-primary' name='rename' value='' id='renameFolderButton'>Rename</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>");
}

function newFolderModal()
{
    echo ("<div class='modal fade' id='newFolderModal' tabindex='-1' aria-labelledby='newFolderModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='newFolderModalLabel'>Create New Folder</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <form class='' method='POST' action='./modules/new-folder.php'>
                        <div class='modal-body'>
                            <label for='newFolderName' class='form-label'> Folder Name</label>
                            <input type='text' class='form-control' id='newFolderName' name='newFolderName'>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                            <button type='submit' class='btn btn-primary' name='rename' value='' id='newFolderButton'>Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>");
}
