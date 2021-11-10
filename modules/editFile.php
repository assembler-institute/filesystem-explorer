<?php

function editFile()
{
    if (isset($_POST['newName'])) {
        $oldName = $_POST['oldNameInput'];
        $splitOldName = explode("/", $oldName);
        $newName = $_POST['newName'];
        array_pop($splitOldName);
        $newName = implode("/", $splitOldName) . "/" . $newName;
        rename($oldName, $newName);

        header("Location: ../index.php");
    }
}

editFile();
