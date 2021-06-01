<?php

use App\Entity\Role;
use App\Manager\RoleManager;

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

//Test addRole()
$roleAdd = new Role();
$roleAdd->setName('role test');
$manager->addRole($roleAdd);

if($roleAdd->getId()) {
    echo "Le role a bien été ajouté<br>";
}
else {
    echo "Erreur en ajoutant le rôle<br>";
    die(); //Stop the test script.
}

//If the script continues after the test to add the role, then we can continue.
//test retrieve a role by name.
$roleByName = $manager->getRoleByName('role test');
if($roleAdd->getId() === $roleByName->getId()) {
    echo "Le role a bien été récupéré et est égal à : 'role test'<br>";
}
else {
    echo "Erreur en récupérant le rôle: 'role test'<br>";
    die(); //Stop tne test script
}

//If the script continues, it means that we have been able to retrieve the role 'role test'
//Test deleteRole()
if($manager->deleteRole($roleByName)) {
    echo "Le role a bien été supprimé<br>";
}
else {
    echo "Le rôle n'a pas été supprimé<br>";
    die();
}


echo "<br>TOUTE LA CLASSE EST OK !<br>";
