<?php

use App\Model\Entity\UserManager;

require_once "include.php";


require_once $_SERVER['DOCUMENT_ROOT'] . '/include.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        case 'services':
            $controller = new ServiceController();

            switch ($_GET['action']) {
                case 'new' :
                    $controller->addService($_POST);
                    break;

                case 'read':
                    if (isset($_GET['services'])) {
                 // $controller->getServices();
                    }
                    break;

                case 'update':
                    if (isset($_GET['service'])) {
                  //$manager->updateArticle($_GET['article']);
                    } else {
                        //$manager->updateService();
                    }
                    break;

                case 'delete':
                // $manager->deleteService();
                    break;

                default:
                    break;
            }

            break;

        case 'user':
            $manager = new UserManager();

            if (isset($_GET['action'])) {
                switch ($_GET['action']) {

                    case ' to connect':
                        $manager->existUser("");
                        session_start();
                        break;

                    case 'addUser':
                        $manager->addUser("");
                        break;

                    case 'disconnect':
                        $manager->sanitizeCookie();
                        break;

                    case 'delete' :
                        $manager->deleteUser();
                        break;

                    default:
                        break;
                }
            }
            break;
        case "search" :
            $controller = new QuickSearchController();
            $controller->goToQSearch();
    }

} else {
// Créer un home controller qui ne fait que afficher la vue home.
     $controller = new HomeController();
     $controller->index();

}

//check create service file upload
if (isset($_GET['success'])) {
    ?> <div class="success">Vos fichiers ont bien été envoyés, merci.</div><?php
}
elseif (isset($_GET['e'])) {
    $messageError = base64_decode($_GET['e']);
    $messageError = json_decode($messageError);
    foreach ($messageError as $messgError) {
        ?> <div class="error"><?=$messageError?></div><?php
    }
}
//if admin ===>page admin
/*if ($username["Elodie"]->getAdmin($id) === 1) {
    session_start();
    $controller = new AdminController();
    $controller->gotoAdmin();
}*/



