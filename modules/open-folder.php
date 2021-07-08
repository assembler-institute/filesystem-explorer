<?php
session_start();

$openedFolder = $_POST["folder-name"];

if (isset($_SESSION["currentPath"])) {
    $_SESSION["currentPath"] .= "/" . $openedFolder;
} else {
    $_SESSION["currentPath"] = "/" . $openedFolder;
}

header("Location: ../index.php");
