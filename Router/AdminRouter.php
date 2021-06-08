<?php

class AdminRouter {

    /**
     * Route user to controller.
     */
    public static function route() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/AdminController.php';
        $controller = new AdminController();

        switch ($_GET['action']) {

            case 'users-list':
                $controller->listUsers();
                break;

            case 'user-delete':
                if(isset($_GET['id'])) {
                    $controller->deleteUser($_GET['id']);
                }
                else {
                    home();
                }
                break;

            case 'services-list':
                $controller->listServices();
                break;

            case 'service-delete':
                if(isset($_GET['id'])) {
                    $controller->deleteService($_GET['id']);
                }
                else {
                    home();
                }
                break;

            default:
                home();
        }
    }

}