<?php

session_start();

$mySearchedInput = $_POST["inputSearch"];

$sesion_name = $_SESSION["username"];

$relative_dir = "C:/xampp/htdocs/filesystem-explorer/root/$sesion_name";

function directoryIterator($dir, $mySearchedInput)
{
	if ($mySearchedInput === "") {
		echo "Búscate algo wey &#128512";
	} else {
		foreach (new DirectoryIterator($dir) as $fileInfo) {
			if ($fileInfo->isDot()) {
				continue;
			}
			if (is_dir($dir . "/" . $fileInfo)) {
				$newPath = $dir . "/" . $fileInfo;
				directoryIterator($newPath, $mySearchedInput);
				if (stristr($fileInfo, $mySearchedInput, 0)) {
					echo "<p class='input__search--folders'>" . $fileInfo . " Is dir</p>\n";
				};
			} elseif (is_file($dir . "/" . $fileInfo)) {
				if (stristr($fileInfo, $mySearchedInput, 0)) {
					$complete_path = $fileInfo->getPath() . "/" . $fileInfo;
					$server_path = "http://localhost/filesystem-explorer/" . strstr($complete_path, "root");
					echo "<p class='input__search--files' data-source='$server_path'>" . $fileInfo . " Is File</p>\n";
				}
			}
		}
	}
}

echo "<div class='text__inside--input' id='text__inside--input'>";
echo directoryIterator($relative_dir, $mySearchedInput);
echo "</div>";
