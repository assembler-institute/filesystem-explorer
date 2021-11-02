<?php
session_start();
$path = $_SESSION["path"];
array_map('unlink', glob($path));
echo $_SESSION["path"];
