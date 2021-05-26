<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Model/Manager/UserServiceManager.php';

$manager = new UserServiceManager();

$manager->getServices();
