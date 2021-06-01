<?php

use App\Entity\UserService;
use App\Manager\MessageManager;

use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/UserService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserServiceManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/MessageManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/RoleManager.php';

$userServiceManager = new UserServiceManager();
$messageManager = new MessageManager();
$userManager = new UserManager();
$user = $userManager->getById(3);

$services = $userServiceManager->getServicesByUser($user);

// Test getting all sent user messages.
$messages = $messageManager->getSentMessages($user);
if(count($messages) > 0) {
    Dumper::dieAndDump($messages);
}
else {
    echo "Le messages n'ont pas pu être récupérés, ou erreur de récuupération des données de test";
    die();
}

// Send a message
$userFK = $userManager->getById(1); // obtention d'un utilisateur qui envoie le message pour un service de l'utilisateur 3

$result = $messageManager->sendMessages('test message', $services[0], $userFK); // Premier service de la liste des services.
if($result){
    echo "Message envoyé";
}
else {
    echo "Error envoi message";
    die();
}

//delete
$messages = $messageManager->getSentMessages($user); // Pour avoir aussi le dernier message envoyé.
print_r($messages);
if(count($messages) > 0) {
    $result = $messageManager->deleteMessage($messages[count($messages) - 1]);
    if ($result) {
        echo "message delete";
    } else {
        echo "oups, message not delete";
    }
}
else {
    echo "Aucun message trouvé";
    die();
}

echo "<br>TOUTE LA CLASSE EST OK !<br>";
