<?php

class AdminRouter {

    /**
     * Route user to controller.
     */
    public static function route() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/AdminController.php';
        $controller = new AdminRouter();

        switch ($_GET['action']) {

            case 'user-list':
                $controller->listUsers();
                break;

            default:
                home();
        }
    }
}