<?php

function openFileModal()
{
    if (isset($_SESSION["openFile"])) {
        $extension = explode(".", $_SESSION["openFile"])[1];
        switch ($extension) {
            case 'png':
            case 'PNG':
            case 'jpg':
            case 'JPG':
            case 'jpeg':
            case 'JPEG':
            case 'svg':
            case 'SVG':
            case 'gif':
            case 'GIF':
                imageModal($_SESSION["openFile"]);
                break;
            case 'mp3':
            case 'MP3':
            case 'aac':
            case 'wav':
                audioModal($_SESSION["openFile"], $extension);
                break;
            case 'mp4':
            case 'mpeg':
            case 'mov':
            case 'wmv':
            case 'avi':
                videoModal($_SESSION["openFile"], $extension);
                break;

            default:
                echo "default exit";
                break;
        }

        unset($_SESSION["openFile"]);
    }
}

function imageModal($imgRoute)
{
    $filesRoot = "root/";
    $imgName = array_slice(explode("/", $imgRoute), -1)[0];
    echo ("<div class='modal fade' id='openFileModal' tabindex='-1' aria-labelledby='openFileModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-xl  modal-dialog-centered'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='openFileModalLabel'>" . $imgName . "</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                        <div class='modal-body'>
                            <img class='img-fluid' src='" . $filesRoot . $imgRoute . "'>
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                            <button type='button' class='btn btn-secondary'>Download</button>
                            <button type='button' name='rename' data-bs-dismiss='modal' aria-label='Close' data-bs-toggle='modal' data-bs-target='#renameFileModal' value=" . $imgName . " class='btn btn-primary'> Rename</button>
                            <button type='button' name='delete' data-bs-dismiss='modal' aria-label='Close' data-bs-toggle='modal' data-bs-target='#deleteFileModal' value=" . $imgName . " class='btn btn-danger'>Delete</button>
                            
                            </div>
                            </div>
                            </div>
                            </div>");
    echo "<script type= 'text/JavaScript'>
    var openFileModal = new bootstrap.Modal(document.getElementById('openFileModal'), {});
    openFileModal.show();
    </script>'";
}

function audioModal($route, $extension)
{
    $filesRoot = "root/";
    $fileName = array_slice(explode("/", $route), -1)[0];
    echo ("<div class='modal fade' id='openFileModal' tabindex='-1' aria-labelledby='openFileModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-xl modal-dialog-centered'>
            <div class='modal-content'>
            <div class='modal-header'>
                        <h5 class='modal-title' id='openFileModalLabel'>" . $fileName . "</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                        <div class='row justify-content-md-center'>
                        <audio controls>
                        <source src='" . $filesRoot . $route . "' type='audio/" . $extension . "'>
                        Your browser does not support the audio element.
                        </audio>
                        </div>
                        </div>
                        <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='button' class='btn btn-secondary'>Download</button>
                            <button type='button' name='rename' data-bs-dismiss='modal' aria-label='Close' data-bs-toggle='modal' data-bs-target='#renameFileModal' value=" . $fileName . " class='btn btn-primary'> Rename</button>
                            <button type='button' name='delete' data-bs-dismiss='modal' aria-label='Close' data-bs-toggle='modal' data-bs-target='#deleteFileModal' value=" . $fileName . " class='btn btn-danger'>Delete</button>
                            </div>
                </div>
                </div>
        </div>");
    echo "<script type= 'text/JavaScript'>
            var openFileModal = new bootstrap.Modal(document.getElementById('openFileModal'), {});
            openFileModal.show();
            const fileModal = document.getElementById('openFileModal');
            fileModal.addEventListener('hide.bs.modal', function () {
            document.querySelector('audio').pause();
        })
        </script>'";
}
function videoModal($route, $extension)
{
    $filesRoot = "root/";
    $fileName = array_slice(explode("/", $route), -1)[0];
    echo ("<div class='modal fade' id='openFileModal' tabindex='-1' aria-labelledby='openFileModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-xl modal-dialog-centered'>
            <div class='modal-content'>
            <div class='modal-header'>
                        <h5 class='modal-title' id='openFileModalLabel'>" . $fileName . "</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <div class='modal-body'>
                        <div class='row justify-content-md-center'>
                        <video width='400' controls>
                            <source src='" . $filesRoot . $route . "' type='video/" . $extension . "'>
                            Your browser does not support HTML video.
                        </video>
                        
                        </div>
                        </div>
                        <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                        <button type='button' class='btn btn-secondary'>Download</button>
                            <button type='button' name='rename' data-bs-dismiss='modal' aria-label='Close' data-bs-toggle='modal' data-bs-target='#renameFileModal' value=" . $fileName . " class='btn btn-primary'> Rename</button>
                            <button type='button' name='delete' data-bs-dismiss='modal' aria-label='Close' data-bs-toggle='modal' data-bs-target='#deleteFileModal' value=" . $fileName . " class='btn btn-danger'>Delete</button>
                            </div>
                </div>
                </div>
        </div>");
    echo "<script type= 'text/JavaScript'>
            var openFileModal = new bootstrap.Modal(document.getElementById('openFileModal'), {});
            openFileModal.show();
            const fileModal = document.getElementById('openFileModal');
            fileModal.addEventListener('hide.bs.modal', function () {
            document.querySelector('video').pause();
        })
        </script>'";
}
