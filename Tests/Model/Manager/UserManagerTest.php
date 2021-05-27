<?php

use App\Entity\User;
use App\Model\Entity\UserManager;


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserManager.php';


//return a user by id
$userManager = new UserManager();
$user = $userManager->getById(3);
Dumper::dieAndDump($user);

//Return an User by his user name or null
$user = $userManager->existUser('doejohn@gmail.com');
if($user->getId()){
echo " Email user existe <br>";
}
else {
    echo "Erreur email user not existe<br>";
}

//add user
$user = new User(null,3, 'jean', 'doe','jeandoe@gmail.com');
$userManager->addUser($user);

if($user->getId()) {
    echo "Le role a bien été ajouté<br>";
}
else {
    echo "Erreur en ajoutant le rôle<br>";
    die();
}
die();
//delete user
if($user->deleteUser(4)) {
    echo "User supprimé<br>";
}
else {
    echo "User pas supprimé<br>";
    die();
}


echo "<br>TOUTE LA CLASSE EST OK !<br>";



