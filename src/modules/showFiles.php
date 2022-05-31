<?php 

function showFiles($filePath) {

}

function renderEditBtn($file) {
    if(is_dir($file)) {
        echo '<button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
        <img src="./assets/edit (1).png" class="card-btns" alt="add-file-icon">
      </button>';
    }
}

$target_dir = __DIR__ .'/root';
$dirFiles = scandir($target_dir);

unset($dirFiles[array_search('.', $dirFiles)]);
unset($dirFiles[array_search('..', $dirFiles)]);



