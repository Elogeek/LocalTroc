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

//Retrieving an existing user.

$userManager = new UserManager();
$userProfileManager = new UserProfileManager();


//Test recovery of a profile with an existing user.
$user = $userManager->getById(7);
$profile = $userProfileManager->getUserProfile($user);
if($profile) {
    echo "Récupération du profil user réussi <br>";
    Dumper::dieAndDump($profile);
}
else {
    echo "Erreur de récupération du profil user <br>";
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

//Test modify profile
if($userProfileManager->updateProfile($profile)) {
    echo "Modif réussie <br>";
}
else {
    echo "Erreur aucune modif réussie <br>";
    die();
}


//Test delete profile.
if($userProfileManager->deleteUserProfile($profile)) {
    echo "Suppression réussie <br>";
}
else {
    echo "Erreur de suppression du profil user<br>";
    die();
}

echo " TOUT EST OK !";