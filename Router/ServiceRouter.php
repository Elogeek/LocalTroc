<?php

class ServiceRouter {

    public static function route() {
        if(isset($_GET['action'])) {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/ServiceController.php';
            $controller = new ServiceController();

            switch ($_GET['action']) {

                case 'add':
                    $controller->addService($_POST);
                    break;

                case 'user-services':
                    $controller->showLoggedInUserServices();
                    break;

                case 'user-service-delete':
                    if(isset($_GET['id'])) {
                        // Delete user service if id was provided.
                        $controller->deleteLoggedInUserService($_GET['id']);
                    } else {
                        // f no service id was provided, then redirect to user services listing.
                        $controller->showLoggedInUserServices();
                    }
                    break;

                default:
                    // TODO => List all services.
            }
        }
    }
}