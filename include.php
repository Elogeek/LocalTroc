<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once  $_SERVER ['DOCUMENT_ROOT'] . '/Model/DB.php';
require_once  $_SERVER ['DOCUMENT_ROOT'] . '/Controller/Controller.php';

// Inclusion des modèles et des Entités.
require_once  $_SERVER ['DOCUMENT_ROOT'] . '/Model/Entity/Message.php';
//require_once  $_SERVER ['DOCUMENT_ROOT'] . '/Model/Entity/OpinionService.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Entity/Role.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Entity/User.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Entity/UserProfile.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Entity/UserService.php';

require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Manager/MessageManager.php';
//require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Manager/OpinionServiceManager.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Manager/RoleManager.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Manager/UserManager.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Manager/UserProfileManager.php';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/Model/Manager/UserServiceManager.php';



