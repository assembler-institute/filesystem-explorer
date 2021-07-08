<?php
session_start();

$explodedPath = explode("/", $_SESSION["currentPath"]);
var_dump($explodedPath);

if (count($explodedPath) > 1) {
    array_pop($explodedPath);
    if (is_array($explodedPath)) {
        $_SESSION["currentPath"] = implode("/", $explodedPath);
    }
    header("Location: ../index.php");
    /* else {
        echo "was not array"; // TODO: verify if this case happens
        var_dump($explodedPath);
        $_SESSION["currentPath"] = "/" . $explodedPath;
    } */
}
