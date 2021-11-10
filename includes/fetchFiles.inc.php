<?php
session_start();
require_once("dbh.inc.php");




$fetchQuery = $db -> prepare("
SELECT * FROM `files` WHERE daddyPath=:path
");

$fetchQuery -> execute([
  "path"=>"../root"
]);

$fileFetched = $fetchQuery -> rowCount()? $fetchQuery : [] ;
