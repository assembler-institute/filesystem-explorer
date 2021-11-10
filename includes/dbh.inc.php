<?php

// CONNECTION WITH DATA BASE 

$dsn = "mysql:host=".$_SERVER["SERVER_NAME"].";dbname=files_system";
$dbusername ="root";
$dbpassword = "";

$db = new PDO($dsn, $dbusername, $dbpassword);
?>