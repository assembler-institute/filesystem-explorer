<?php

function getFileType($extension){
    switch($extension){
        case 'pdf':
            $type="fas fa-file-pdf";
            break;
        case 'folder':
            $type="fas fa-folder";
            break;
        case 'docx':
        case 'doc':
            $type="fas fa-file-doc";
            break;
        case 'xls':
        case 'xlsx':
            $type='fas fa-file-word';
            break;
        case 'mp3':
        case 'ogg':
        case 'wav':
            $type='fas fa-file-audio';
            break;
        case 'mp4':
        case 'mov':
            $type='fas fa-video';
            break;
        case 'zip':
        case '7z':
        case 'rar':
            $type='fas fa-file-archive';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
            $type='fas fa-image';
            break;
        default:
            $type='fas fa-file-alt';
    }

    return $type;
}