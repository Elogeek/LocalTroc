<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/include.php';

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {
        /*case 'services':
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

            break;*/

        case 'user':
            require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/UserController.php';
            $controller = new UserController();

            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'register':
                        $controller->register();
                        break;

                    case 'addUser':
                        $manager->addUser();
                        break;

                    case 'disconnect':
                        $manager->logOut('');
                        break;

                    case 'delete' :
                        $manager->deleteUser();
                        break;

                    default:
                        home();
                }
            }
            else {
                home();
            }
            break;
        case "search" :
            //$controller = new QuickSearchController();
            //$controller->goToQSearch();
            break;
    }
} else {
    home();
}


/**
 * Display the home page.
 */
function home() {
    // Display the home page if no action asked in get params.
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/HomeController.php';
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

