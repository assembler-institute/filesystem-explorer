<?php
$file = $_POST['filePath'];
$fileExtension = mime_content_type($file);
$fileExtension = explode('/', $fileExtension)[0];
switch ($fileExtension) {
  case 'image':
    echo "<img src='$file' style='width:150px;'>";
    break;
  case 'audio':
    echo "<audio controls> <source src='$file' type='audio/mpeg'> No audio support. </audio>";
    break;
  case 'video':
    echo "<video width='320' height='240' controls autoplay> <source src='$file' type='video/mp4'> Your browser does not support the video tag. </video>";
    break;
  case 'text':
    $file = fopen($file, "r");
    $content = fread($file, filesize($file));
    echo "<p>'$content' </p>";
    fclose($file);
    break;
  default:
    # code...
    break;
}
  

  // fclose($file);
  //txt -> // echo file_get_contents($file);
