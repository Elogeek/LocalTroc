<?php
// Starting session.
session_start();

// Loading routes.
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/RegisterRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/LoginRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/UserRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/InfoRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/ServiceRouter.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Router/AdminRouter.php';

// Loading dependencies classes.
require_once  $_SERVER['DOCUMENT_ROOT'] . '/Model/DB.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/DateUtils.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Classes/FileUpload.php';

// Including entities and models.
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/Role.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/UserProfile.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Entity/UserService.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/MessageManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/RoleManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserProfileManager.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserServiceManager.php';

// Loading always available controller ( search, all others controllers are called only when needed ).
require_once $_SERVER["DOCUMENT_ROOT"] . '/Controller/SearchController.php';



