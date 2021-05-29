<?php

use App\Entity\User;
use PDOException;
use PDO;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/OpinionService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/OpinionServiceManager.php';



//Return an opinion by user via an service
$opinion = new opinionServiceManager();

$opinion->getOpinion(1, 3, "");

if(true) {
    echo "mon opinion <br>";
}

die(); // STOP SCRIPT TEST.


//return an opinion via subjet(service)
$opinion = new OpinionServiceManager();
if($opinion->getSubjectOpinion(' couture', 3)) {
    echo "voilà le sujet du service'<br>";
}
else {
    echo "Erreur<br>";
    die(); // Arret du script de test.
}
//die();

// return alla opinion by user
$opinion = new OpinionServiceManager();
if($opinion->getOpinions(1, 3, "fhhfudui")) {
    echo "toutes mes opinions<br>";
}
else {
    echo "Erreur<br>";
    die();
}
//die();

echo "<br>TOUTE LA CLASSE EST OK !<br>";
