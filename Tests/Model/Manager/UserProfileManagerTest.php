<?php
use App\Entity\UserService;
use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dumper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/UserProfile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/RoleManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Model/Manager/UserProfileManager.php';

// Récupération d'un user qui existe.

$userManager = new UserManager();
$userProfileManager = new UserProfileManager();


// Test de récupération d'un profil avec un utilisateur qui existe.
$user = $userManager->getById(7);
$profile = $userProfileManager->getUserProfile($user);
if($profile) {
    echo " récupération réussi <br>";
    Dumper::dieAndDump($profile);
}
else {
    echo "erreur pas de récupération<br>";
    die();
}

$profile->setMoreInfos('updated');
$profile->setCountry('somewhere');
$profile->setCodeZip(59610);
$profile->setAddress('Rue Arlette Corrente');
$profile->setCity('Fourmies');
$profile->setBirthday((new DateTime())->format('Y-m-d H:i:s'));
$profile->setAvatar('mon avatar');
$profile->setPhone('+336123456');

// Test de modification d'un profile.
if($userProfileManager->updateProfile($profile)) {
    echo "Modif réussie <br>";
}
else {
    echo "Erreur <br>";
    die();
}


// Test de suppression d'un profile.
if($userProfileManager->deleteUserProfile($profile)) {
    echo "Suppression réussie <br>";
}
else {
    echo "Erreur pas de suppression<br>";
    die();
}

echo " TOUT EST OK !";