<?php 

if(file_exists($_POST['filePath'])) {
	unlink($_POST['filePath']);
	echo $response;
} else {
	$response = false;
}

