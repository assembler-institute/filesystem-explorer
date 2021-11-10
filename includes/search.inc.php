<?php
session_start();
require_once("dbh.inc.php");
$name = $_GET["search"];


$fetchQuery = $db->prepare("
SELECT * FROM `files` WHERE name=:name
");

$fetchQuery->execute([
    "name" => $name
]);

$fileFetched = $fetchQuery->rowCount() ? $fetchQuery : [];
