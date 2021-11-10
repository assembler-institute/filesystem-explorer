<?php
include_once "./utils.php";

$path = $_GET["path"];
$extension = $_GET["extension"];


switch ($extension) {
    case 'txt':
    case 'pdf':
        read_txt($path);
        break;
    case 'docx':
    case 'doc':
        read_docx($path);
        break;
    case 'jpg':
    case 'png':
    case 'gif':
    case 'jpeg':
    case 'webp':
    case 'svg':
        echo "<img src='$path' alt='$path' />";
        break;
        // case 'zip':
        // case 'rar':
        //ZipArchive::RDONLY   ****PENDIENTE
        // case '7z':
        //     gzread($path, filesize($path));
        //     break;
    case 'mp3':
        echo "<audio controls>
      <source src='$path' type='audio/mp3'>
    </audio>";
        break;
    case 'mp4':
        echo "<video controls>
      <source src='$path' type='video/mp4'>
    </video>";
        break;
    case 'folder':
        header("Location: ../lower.php?pathLower=$path");
        break;
    default:
        echo "File type not supported";
        break;
}
