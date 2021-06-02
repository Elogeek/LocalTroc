<?php
//envoyer un code par sms lors de l'inscription pour confirmer le compte ?!
use App\Entity\User;
use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
use Model\DB;

require_once $_SERVER ['DOCUMENT_ROOT'] . '/include.php';

$userManager = new User();
$user = $userManager;

$roleManager = new RoleManager();
$role = $roleManager;

$userActual = unserialize($_SESSION['userActual']);


if($_POST['email'] && $_POST['password'] && isset($_POST['passwordRepeat'])) {

}