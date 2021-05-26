<?php

use App\Entity\Role;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/RoleManager.php';

$manager = new RoleManager();
$role = $manager->getRoleById(1);
Dumper::dieAndDump($role);
$adminUsers = $manager->getUsersByRole($role);
Dumper::dieAndDump($adminUsers);

// Exemple tester ajout d'un role
$roleAdd = new Role();
$roleAdd->setName('role test');
$manager->addRole($roleAdd);

if($roleAdd->getId()) {
    echo "Le role a bien été ajouté<br>";
}
else {
    echo "Erreur en ajoutant le rôle<br>";
    die(); // Arret du script de test.
}

// Si le script continue après le test d'ajout du rôle, alors on peut continuer.
// On tente de récupérer un rôle par son nom.
$roleByName = $manager->getRoleByName('role test');
if($roleAdd->getId() === $roleByName->getId()) {
    echo "Le role a bien été récupéré et est égal à : 'role test'<br>";
}
else {
    echo "Erreur en récupérant le rôle: 'role test'<br>";
    die(); // Arret du script de test.
}

// Si le script continue, c'est qu'on a pu récupérer le role 'role test'.
// On tente la suppression d'un role.
if($manager->deleteRole($roleByName)) {
    echo "Le role a bien été supprimé<br>";
}
else {
    echo "Le rôle n'a pas été supprimé<br>";
    die();
}


echo "<br>TOUTE LA CLASSE EST OK !<br>";