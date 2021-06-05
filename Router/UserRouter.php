<?php

class UserRouter {

    /**
     * Route user to controller.
     */
    public static function route() {
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
                home();
        }
    }
}
