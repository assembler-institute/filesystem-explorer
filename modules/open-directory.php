<?php
session_start();

$openedFolder = substr($_GET["directory"], 2);

$_SESSION["currentPath"] = "/" . $openedFolder;


header("Location: ../index.php");
