<?php

class opinionServiceController {

public function goOpinion() {
$username = "John";
require_once "./include.php";
require_once './View/user/opinion.php';
}

}


//check a dossier user exist, and create if not exist (check one * et pas 2 in the boucle)
if (!is_dir("uploads")) {
    mkdir('uploads','0755');
}
//type file accept
$mineTypes = ["text/plain", "image/jpeg", "image/png", "image/jpg"];

//récupération an file/files user
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Classes/FileUpload.php';

$fileUploader = new FileUpload($_FILES['avatar'], $_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/avatars');
if($fileUploader->isSizeInThreshold()) {
    $result = $fileUploader->upload(); // succes ou échec.
}
