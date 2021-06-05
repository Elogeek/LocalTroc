<?php

class LoginRouter {

    /**
     * Route user through login controller.
     */
    public static function route() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/LoginController.php';
        $controller = new LoginController();

        switch($_GET['action']) {
            case 'disconnect':
               $controller->disconnect();
                break;
            default:
                self::default();
        }
    }

    /**
     * Load the default route.
     */
    public static function default() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/LoginController.php';
        (new LoginController())->login($_POST);
    }
}
