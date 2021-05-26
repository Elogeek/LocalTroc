<?php

use App\Entity\UserService;
use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/RoleManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/UserService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserServiceManager.php';

$manager = new UserServiceManager();

//return an service by user_fk
$userManager = new UserManager();
$user = $userManager->getById(3);
$services = $manager->getServicesByUser($user);
Dumper::dieAndDump($services);

//return all services
$services = $manager->getServices();
Dumper::dieAndDump($services);

//add a service
$service = new UserService(null, $user, '2021-05-05 05:05:05', 'Service test', 'desc test');
$serviceAdd = $manager->addService($service);

if($service->getId()) {
    echo "Le service a bien été ajouté<br>";
}
else {
    echo "Erreur en ajoutant le service<br>";
    die();
}

//modify an service
$serviceAdd = $manager->updateService($service);

if($service->getId()) {
    echo "Le service est modofié<br>";
}
else {
    echo "Erreur le service n'est pas modifié<br>";
    die();
}


//delete an service
if($manager->deleteService($service)) {
    echo "Le service est bien supprimé<br>";
}
else {
    echo "Le service n'a pas été supprimé<br>";
    die();
}

//if service NULL
if ($manager->getService(2)) {
    echo "le service est null";
}
else{
    echo " le service n'est pas null";
}

echo "<br>TOUTE LA CLASSE EST OK !<br>";
