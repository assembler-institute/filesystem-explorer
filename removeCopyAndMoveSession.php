<?php
require_once('./utils.php');
session_start();

$_SESSION['moves'] = [];
$_SESSION['copies'] = [];
Utils::saveSession(SESSION);
echo json_encode('ok');