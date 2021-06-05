<?php

class LoginRouter {

    /**
     * Route user through login controller.
     * @param string $action
     * @param array $request
     */
    public static function route(string $action, array $request) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/LoginController.php';
        $controller = new LoginController();

        switch($action) {
            case 'disconnect':
               $controller->disconnect();
                break;
            default:
                (new LoginController())->login($request);
        }
    }

    /**
     * Load the default route.
     * @param array $request
     */
    public static function default(array $request) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/LoginController.php';
        (new LoginController())->login($request);
    }
}
