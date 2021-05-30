<?php

use App\Entity\User;
use App\Model\Entity\UserManager;


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);


require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/RoleManager.php';


//return a user by id
$userManager = new UserManager();
$user = $userManager->getById(3);
Dumper::dieAndDump($user);

//Return an User by his user name or null
$exists = $userManager->existUser('doejohn@gmail.com');
if($exists){
    echo " Email user existe <br>";
}
else {
    echo "Erreur email user not existe<br>";
    die();
}

//add user
$role = $user->getRole();
$user = new User(null, $role, 'jean', 'doe','jeandoe@gmail.com', 'passwordtest');
$userManager->addUser($user);

if($user->getId()) {
    echo "Le role  de l'utilisateur a bien été ajouté<br>";
}
else {
    echo "Erreur en ajoutant l'utilisateur<br>";
    die();
}

// Test de la mise à jour d'un user.
$user->setEmail('007.nux@gmail.com');
$result = $userManager->updateUser($user);

if($result) {
    echo "user mis à jour<br>";
}
else {
    echo "user pas mis à jour<br>";
    die();
}

// Test de la fonction de mise à jour du password.
$result = $userManager->updatePassword($user , 'azerty0000');
if($result) {
    echo 'mot de passe modifié';
}
else {
    echo " erreur lors de la modification du mot de passe";
    die();
}

// Teste la fonction de récupération du mot de passe utilisateur en base de données.
$result = $userManager->getUserPassword($user);
if($result) {
    echo "tout est ok<br>";
}
else {
    echo " une erreur est survenue";
    die();
}

//delete user
if($userManager->deleteUser($user)) {
    echo "User supprimé<br>";
}
else {
    echo "User pas supprimé<br>";
    die();
}


echo "<br>TOUTE LA CLASSE EST OK !<br>";



