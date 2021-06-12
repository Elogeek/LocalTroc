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
                    if(isset($_GET['id']))
                        // Delete user service if id was provided.
                        $controller->deleteLoggedInUserService($_GET['id']);
                    else
                        // if no service id was provided, then redirect to user services listing.
                        $controller->showLoggedInUserServices();
                    break;

                case 'user-service-edit':
                    if(isset($_GET['id']))
                        $controller->editLoggedInUserService($_GET['id'], $_POST);
                    else
                        // Redirect to logged in user services if no service id provided.
                        $controller->showLoggedInUserServices();
                    break;

                case 'read':
                    if(isset($_GET['id']))
                        $controller->readService($_GET['id']);
                    else
                        home();
                    break;

                case 'message':
                    $controller->sendMessage($_POST);
                    break;

                default:
                    // List all services. ( also used for action=show-all )
                    $controller->displayAllServices();
            }
        }
    }
}