<?php

//récupération an file/files user
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Classes/FileUpload.php';

$fileUploader = new FileUpload($_FILES['avatar'], $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/avatars');
if($fileUploader->isSizeInThreshold()) {
    $result = $fileUploader->upload(); // succes ou échec.
}

