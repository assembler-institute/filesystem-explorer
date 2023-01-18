<?php
$filename = $_GET['path'];
$lines = [];
$f = fopen("." . $filename, 'r');

if (!$f) {
    return;
}

while (!feof($f)) {
    $lines[] = fgets($f);
}
fclose($f);

echo json_encode(["text" => $lines]);
