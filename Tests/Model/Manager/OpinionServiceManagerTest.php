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
    echo "voici mon opinion <br>";
}

die(); // STOP SCRIPT TEST.


//return an opinion via subjet(service)
$roleByName = $manager->getRoleByName('role test');
if($roleAdd->getId() === $roleByName->getId()) {
    echo "Le role a bien été récupéré et est égal à : 'role test'<br>";
}
else {
    echo "Erreur en récupérant le rôle: 'role test'<br>";
    die(); // Arret du script de test.
}

// return alla opinion by user
if($manager->deleteRole($roleByName)) {
    echo "Le role a bien été supprimé<br>";
}
else {
    echo "Le rôle n'a pas été supprimé<br>";
    die();
}


echo "<br>TOUTE LA CLASSE EST OK !<br>";
