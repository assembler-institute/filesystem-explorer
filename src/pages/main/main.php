<?php
require_once "../../php/Login/login-control.php";
revisar_si_existe_sesion();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>File System Explorer</title>

	<!-- Script del CDN de Jquery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">

	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
	<link rel="stylesheet" href="main.css">

	<!-- Iconos traidos de Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous" />

</head>

<body class="main_layout">
	<header class="d-flex flex-row justify-content-between main__header bg-light">
		<div class="logo__wrapper">
			<div class="logo__app">
				<img src="./../../../doc/img/JonathanAndErick_logo.png" alt="">
			</div>
		</div>
		<div class="w-100 d-flex justify-content-center pt-2 pb-2 mb-3 h-100">
			<div class="d-flex flex-row gap-3 pt-2 pb-2 mb-3 h-100 search__component border border-secondary">
				<div class="d-flex justify-content-center align-item-center">
					<i class="fas fa-search"></i>
				</div>
				<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search" id="search__bar--input" value="">
			</div>
			<div class="search__bar--main--container" id="search__bar--main--container">
				<p>

				</p>
			</div>
		</div>
		<div class="logout__wrapper d-flex justify-content-center align-item-center h-100 d-inline-block gap-3">
			<div class="d-flex align-items-center">
				<h5 class="text-muted">Welcome <span class="text-dark"><?= $_SESSION["username"] ?></span></h5>
			</div>
			<div class=" d-flex align-items-center justify-content-center h-100">
				<div class="profile_picture">
					<img src='<?= $_SESSION["user_img"] ?>' alt="no user">
				</div>
			</div>
			<a href="../../php/login/logout.php" class="d-flex align-items-center text-decoration-none">
				<button type="button" class="btn btn-dark">Logout</button>
			</a>
		</div>
	</header>
	<main class="main__container">
		<aside class="d-flex flex-column justify-content-between">
			<section id="menu" class="p-2 overflow-auto border-bottom">
				<?php
				require_once "../../php/local_files/local_files_control.php";
				folders_init();
				?>
			</section>
			<div class="d-flex flex-column justify-content-evenly px-2 trash__wrapper mt-1">
				<?php if (isset($_GET["trash"])) {
					echo "<div id='trash-id' class='d-flex align-items-center trash__select folder-active'>";
				} else {
					echo "<div id='trash-id' class='d-flex align-items-center trash__select'>";
				} ?>
				<i class="uil uil-trash-alt me-2"></i>
				<div>Trash</div>
			</div>
			<div class="d-flex justify-content-center">
				<?php get_total_size(); ?>
			</div>
			</div>
		</aside>
		<section class="main__files--wrapper">
			<div class="ms-3 mt-1">
				<?php
				if (isset($_GET["folder-id"])) {
					$folder_id = $_GET["folder-id"];
				} else {
					$folder_id = 0;
				}
				$username = $_SESSION["username"];
				$root_path = $_SESSION["folders_paths"][$folder_id];
				$root_path = str_replace("C:/xampp\htdocs/filesystem-explorer/root/$username", "My Cloud", $root_path);
				if (isset($_GET["trash"])) {
					$root_path = "Trash";
				}
				echo "$root_path/";
				?>
			</div>
			<nav class="edit__buttons--wrapper d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom ">
				<div class="d-flex flex-row justify-content-start gap-2 btn__toolbar--create--folder">
					<button id="create-folder-btn" class="btn btn-light border border-secondary">
						Create folder
					</button>
					<input id="upload-file-input" type="file" name="upload-file-input" style="display: none;" data-folder="<?php
																																																									if (isset($_GET["folder-id"])) echo $_GET["folder-id"];
																																																									else echo "0"; ?>" />
					<label for="upload-file-input" class="btn btn-light border border-secondary d-flex justify-content-center align-items-center">
						Upload file
					</label>
				</div>
				<div class="d-flex flex-row justify-content-start h-100 btn__toolbar--form">
					<form id="form-new-folder" class="ms-3 mb-2 justify-content-start align-items-between gap-3 h-100 w-100" method="post" action="../../php/local_files/new_folder.php" style="display: none;">
						<input type="text" name="new-folder-name" placeholder=" Folder name">
						<button type="submit" class="btn btn-dark">Confirm</button>
						<button id="cancel-form-new-folder" type="button" class="btn btn-dark">Cancel</button>
					</form>
				</div>
				<div class="btn__toolbar mb-md-0 d-flex flex-row justify-content-end align-items-between h-100 gap-3 w-100">
					<div id="my_info--container" class="d-flex flex-row justify-content-between align-items-start gap-3 my_info--container">
					</div>
				</div>
			</nav>
			<div class="files__wrapper">
				<h4 class="px-4 pt-2">Folders</h4>
				<div class="container-fluid folder_container px-4 py-2">
					<div class="row row-cols-sm-2 row-cols-md-4 row-cols-lg-6 w-100">
						<?php read_local_folders(); ?>
					</div>
				</div>
				<h4 class="px-4 pt-2">Files</h4>
				<div class="container-fluid file_container px-4 py-2">
					<div class="row row-cols-sm-2 row-cols-md-4 row-cols-lg-6 w-100" id="file_container">
						<?php
						read_local_files();
						?>
					</div>
				</div>
			</div>
		</section>
		<section class="section_modal" id="section_modal"></section>
	</main>

	<div id="back-context" style="display: none;"></div>
	<nav id="context-menu" class="px-1 py-2" style="display: none;">
		<ul class="m-0 p-0">
			<li id="new-folder-context" class="d-flex mb-1 ps-2 pe-3">
				<i class="uil uil-plus me-2"></i>
				<div>New folder</div>
			</li>
			<li id="rename-folder-context" class="d-flex mb-1 ps-2 pe-3">
				<i class="uil uil-edit me-2"></i>
				<div>Rename folder</div>
			</li>
			<li id="delete-folder-context" class="d-flex ps-2 pe-3">
				<i class="uil uil-times me-2"></i>
				<div>Delete folder</div>
			</li>
		</ul>
	</nav>

	<template id="modalTemplate_img">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Image</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<img width="100%" height="500px" id="img_source" src="" alt="foto">
				</div>
			</div>
		</div>
	</template>

	<template id="modalTemplate_video">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Video</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<video width="100%" height="500px" controls autoplay>
						<source id="video_source" src="" type="video/mp4" />
						Su navegador no soporta contenido multimedia.
					</video>
				</div>
			</div>
		</div>
	</template>

	<template id="modalTemplate_sound">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Sound</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<audio controls autoplay>
						<source id="sound_source" src="" type="audio/mpeg">
						Your browser does not support the audio element.
					</audio>
				</div>
			</div>
		</div>
	</template>

	<template id="modalTemplate">
		<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">File not supported</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<p id="mi_source">This file cannot be displayed</p>
				</div>
			</div>
		</div>
	</template>

	<template id="modalTemplate-create-folder">
		<div class="modal-dialog modal-xl modal-dialog-centered w-50">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New folder</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<form id="new-folder-context-form">
						<input type="text" name="new-folder-name" placeholder="Folder name">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</form>
				</div>
			</div>
		</div>
	</template>

	<template id="modalTemplate-rename-folder">
		<div class="modal-dialog modal-xl modal-dialog-centered w-50">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Rename folder</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<form id="rename-folder-context-form">
						<input type="text" name="rename-folder-name" placeholder="Folder name">
						<button type="submit" class="btn btn-primary">Confirm</button>
					</form>
				</div>
			</div>
		</div>
	</template>

	<template id="modalTemplate-delete-folder">
		<div class="modal-dialog modal-xl modal-dialog-centered w-50">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete folder</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btnCloseModal"></button>
				</div>
				<div class="modal-body" id="modal-body">
					<div>Are you sure you want to delete this folder?</div>
					<button id="confirm-delete-btn" type="button" class="btn btn-primary">Yes</button>
				</div>
			</div>
		</div>
	</template>

	<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

	<script src="../../javascript/modal-play.js"></script>
	<script src="../../javascript/show-files.js"></script>
	<script src="../../javascript/new-folder-handler.js"></script>
	<script src="../../javascript/context-menu-handler.js"></script>
	<script src="../../php/search_bar/search_bar.js"></script>
	<script src="../../javascript/navbar_information.js"></script>
	<script src="../../javascript/upload-file-handler.js"></script>
</body>

</html>