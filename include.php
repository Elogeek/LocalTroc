<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Loading routes.
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/RegisterRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/LoginRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/UserRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/InfoRouter.php';

// Loading dependencies classes.
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DateUtils.php';

// Inclusion des modèles et des Entités.
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/Message.php';
//require_once  $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/OpinionService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/UserProfile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/UserService.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/MessageManager.php';
//require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/OpinionServiceManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/RoleManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserProfileManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserServiceManager.php';



