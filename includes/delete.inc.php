<?php
require_once("./dbh.inc.php");
$id = $_GET["id"];
$path = $_GET["path"];


$deleteQuery = $db->prepare("
DELETE FROM `files` WHERE `id` = :id;
");

$deleteQuery->execute([
    "id" => $id
]);



function rmDir_rf($path)
{
    foreach (glob($path . "/*") as $archivos_carpeta) {
        if (is_dir($archivos_carpeta)) {
            rmDir_rf($archivos_carpeta);
        } else {
            unlink($archivos_carpeta);
        }
    }
    rmdir($path);
};

if (is_dir($path)) {
    rmDir_rf($path);
} else {
    unlink($path);
}


header("location: ../index.php");
