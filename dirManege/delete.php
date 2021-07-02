<?php
require("../functions/dirManege.php");
$deletedDir=$_GET['path'];
//echo $deletedDir;
removeDir($deletedDir);
