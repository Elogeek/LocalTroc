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

            default:
                home();
        }
    }

}