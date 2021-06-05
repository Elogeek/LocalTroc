<?php

class UserRouter {

    /**
     * Route user to controller.
     * @param string $action
     * @param array $request
     */
    public static function route(string $action, array $request) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/UserController.php';
        $controller = new UserController();
         switch ($_GET['action']) {
            case 'register':
                $controller->register($_POST);
                break;

            case 'profile':
                $controller->profile();
                break;

            case 'editInformation':
                $controller->editInformation($_POST);
                break;

            case 'editProfile':
                $controller->editProfile($_POST);
                break;

            case 'delete' :
                //$manager->deleteUser();
                break;

            default:
                self::default($request);
        }
    }


    public static function default(array $request) {
        // Display the home page if no action asked in get params.
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/HomeController.php';
        $controller = new HomeController();
        $controller->index();
    }
}
