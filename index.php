<?php
session_start();
require_once("./modules/upload.php");
require_once("./templates/modals.php");
require_once("./modules/directory-tree.php");
require_once("./modules/open-file.php");
require_once("./modules/return.php");
require_once("./modules/breadcrumb.php");

if (isset($_SESSION["successMsg"])) {
    $successMsg = $_SESSION["successMsg"];
    unset($_SESSION["successMsg"]);
}
if (isset($_SESSION["errorMsg"])) {
    $errorMsg = $_SESSION["errorMsg"];
    unset($_SESSION["errorMsg"]);
}
if (isset($_SESSION["invalidMsg"])) {
    $invalidMsg = $_SESSION["invalidMsg"];
    unset($_SESSION["invalidMsg"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filesystem Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css?v=<?php echo time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon.svg">
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
</head>

<body>
    <nav class="navbar navbar-dark background-light-gray shadow-sm">
        <div class="container-fluid ps-0">
            <a class="col-md-3 col-xl-2 ps-sm-2 px-0 pt-2 pe-0">
                <div class="logoContainer row justify-content-center"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="70px" height="70px" viewBox="0 0 99.34 99.339" style="enable-background:new 0 0 99.34 99.339;" xml:space="preserve" fill="#048A81">
                        <g>
                            <g>
                                <path d="M79.447,30.25c-0.701-0.058-1.346-0.416-1.764-0.982C73.637,23.784,67.135,20.4,60.213,20.4
			c-0.441,0-0.884,0.014-1.326,0.041c-0.582,0.035-1.153-0.138-1.619-0.489c-4.211-3.184-9.314-4.908-14.66-4.908
			c-9.572,0-18.068,5.554-22.026,13.96c-0.352,0.746-1.057,1.264-1.874,1.377C8.153,31.844,0,40.927,0,51.877
			c0,11.966,9.735,21.7,21.701,21.7h4.658v10.718h0.045H67.19l12.575-28.854c0.324-0.742,0.252-1.597-0.192-2.273
			c-0.442-0.678-1.199-1.086-2.009-1.086H64.335c-0.786,0-1.524,0.386-1.973,1.031l-3.112,4.484H42.311
			c-2.493,0-4.75,1.471-5.757,3.749l-4.851,10.968v-7.285H21.701c-7.252,0-13.151-5.899-13.151-13.15
			c0-7.252,5.899-13.152,13.151-13.152c0.366,0,0.726,0.029,1.085,0.059c2.089,0.163,3.982-1.193,4.49-3.221
			c1.769-7.047,8.073-11.97,15.331-11.97c4.146,0,8.071,1.603,11.05,4.51c1.019,0.993,2.464,1.417,3.858,1.127
			c0.887-0.187,1.793-0.28,2.697-0.28c5.077,0,9.611,2.855,11.832,7.45c0.781,1.616,2.488,2.576,4.274,2.393
			c0.444-0.044,0.888-0.067,1.319-0.067c7.252,0,13.151,5.9,13.151,13.152c0,6.312-4.472,11.596-10.414,12.858l-3.853,8.842h1.115
			c11.965,0,21.701-9.734,21.701-21.7C99.342,40.52,90.571,31.172,79.447,30.25z" fill="white" />
                                <path d="M57.969,42.055c1.771,0,3.207-1.436,3.207-3.206c0-1.771-1.437-3.207-3.207-3.207H41.372c-1.77,0-3.207,1.436-3.207,3.207
			s1.437,3.206,3.207,3.206H57.969z" />
                                <path d="M33.89,47.518c0,1.771,1.436,3.206,3.207,3.206h25.146c1.771,0,3.207-1.436,3.207-3.206c0-1.771-1.435-3.207-3.207-3.207
			H37.097C35.326,44.311,33.89,45.746,33.89,47.518z" />
                            </g>
                        </g>
                    </svg>
                </div>
            </a>
            <div class="d-flex align-items-center ms-4 me-auto">
                <?php renderBreadcrumb(); ?>
            </div>
            <div class="d-flex align-items-center me-4">
                <?php
                if (isset($_POST["search"])) {
                    echo "<form method='POST' id='returnForm'>
                    <label role='button'>
                        <input type='submit' name='returnBtn' class='returnBtn' />
                        <svg style='width:30px;height:30px' viewBox='0 0 24 24'>
                            <path fill='#ffffff' d='M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z' />
                        </svg><span class='closeText'>Close Search</span>
                        <!-- <svg style=' width:40px;height:40px; padding:2px' viewBox='0 0 24 24'>
                            <path class='returnIcon' fill='#ffffff' d='M19.07,4.93C17.22,3 14.66,1.96 12,2C9.34,1.96 6.79,3 4.94,4.93C3,6.78 1.96,9.34 2,12C1.96,14.66 3,17.21 4.93,19.06C6.78,21 9.34,22.04 12,22C14.66,22.04 17.21,21 19.06,19.07C21,17.22 22.04,14.66 22,12C22.04,9.34 21,6.78 19.07,4.93M17,12V18H13.5V13H10.5V18H7V12H5L12,5L19.5,12H17Z' />
                        </svg> -->
                    </label>
                </form>";
                }
                ?>


                <form class="d-flex" method="POST">
                    <input class="form-control me-2 searchBox" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn searchButton" type="submit" name="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <nav class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 pt-2 bg-dark sidebar">

                <div class="d-flex flex-column px-3 pt-2 text-white min-mh-100">
                    <form action="" method="POST" enctype="multipart/form-data" class="d-flex">

                        <label class="custom-file-upload d-flex align-items-center me-md-auto text-white text-decoration-none p-2 rounded-3 mb-2 sideButtons" role="button">
                            <input type="file" class="form-control file-select bg-dark text-light" name="file" onchange="form.submit()" style="display:none" />
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#048A81" class="bi bi-cloud-arrow-up-fill" viewBox="0 0 16 16">
                                <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 5.146a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2z" />
                            </svg><span class="fs-5 d-none d-sm-inline m-1 side-span pe-auto text-color-green">UPLOAD</span>
                        </label>
                    </form>
                    <button class="d-flex align-items-center me-md-auto text-white text-decoration-none p-2 rounded-3 sideButtons mb-2" data-bs-toggle="modal" data-bs-target="#newFolderModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="30" fill="#048A81" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                        </svg> <span class="fs-5 d-none d-sm-inline m-1 side-span ml-2 text-color-green">NEW</span>
                    </button>
                    <hr>
                    <?php directoryTree() ?>
                    <hr>
                </div>
            </nav>
            <div class="p-0 col">
                <?php
                if (isset($successMsg) && $successMsg) {
                    echo "<div class='alert alert-success' role='alert'>";
                    echo $successMsg;
                    echo "</div>";
                    $successMsg = false;
                } elseif (isset($invalidMsg) && $invalidMsg) {
                    echo "<div class='alert alert-warning' role='alert'>";
                    echo $invalidMsg;
                    echo "</div>";
                    $invalidMsg = false;
                } elseif (isset($errorMsg) && $errorMsg) {
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo $errorMsg;
                    echo "</div>";
                    $errorMsg = false;
                } else {
                    echo NULL;
                }
                ?>
                <table class="table table-light table-borderless">
                    <thead class="table tableHead">
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Size</th>
                            <th scope="col">Modified</th>
                            <th scope="col">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once "./modules/search.php";
                        require_once "./modules/up-folder-list.php";
                        require_once "./modules/directory-list.php"; // Have to be cautious, this file changes current working directory
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php
deleteFileModal();
renameFileModal();
deleteFolderModal();
renameFolderModal();
openFileModal();
newFolderModal();

?>

<script src="./assets/js/modal-population.js"></script>

</html>