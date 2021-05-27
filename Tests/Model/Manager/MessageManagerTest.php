<?php

use App\Entity\UserService;
use App\Manager\MessageManager;

use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/UserService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserServiceManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/MessageManager.php';

$userServiceManager = new UserServiceManager();
$userManager = new UserManager();
$user = $userManager->getById(3);
$services = $userServiceManager->getServicesByUser($user);

//return all messages
$messageManager = new MessageManager();
$messageManager->getMessages();
Dumper::dieAndDump($messageManager);
die();

//send a message
$messageManager = new MessageManager();
$message= $messageManager->sendMessages('test message', 1, 3);
if($message){
    echo "message envoyé";
}
else {
    echo "error envoie message";
}
//die();
//return a message by users
$messageManager = new MessageManager();
$message = $messageManager->getMessageByUser(3,1);
if($message){
    echo "tous les messages entre les users (id) 1 et (id) 3 sont ici";
}
else {
    echo "erreur, il faut trouver le problème ";
}
//die();

//return a message by subject
$messageManager = $manager->getMessage(1,$user);
Dumper::dieAndDump($messageManager);
if($message) {
    echo "Le suject était couture<br>";
}
else {
    echo "Erreur aucun message pour le sujet recherché (couture) <br>";
    die();
}
//die();

//delete
$messageManager = new MessageManager();
$message = $messageManager->deleteMessage(3);
if($message){
    echo "message delete";
}
else{
    echo "oups, message not delete";
}
//die();


//add a message
$message = new MessageManager(null, 1, 'Service test', '2021-05-05 05:05:05');
$manager->addMessage($message);

if($message->getId()) {
    echo "Message a bien été ajouté<br>";
}
else {
    echo "Erreur en ajoutant le message<br>";
    die();
}
//die();

echo "<br>TOUTE LA CLASSE EST OK !<br>";
