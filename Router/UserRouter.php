<?php

class UserRouter {

    /**
     * Route user to controller.
     */
    public static function route() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/UserController.php';
        $controller = new UserController();
         switch ($_GET['action']) {
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
                $controller->deleteUser();
                break;

             case 'messages':
                 // If service id is provided, then adding a new message from user panel.
                 if(isset($_GET['sid'])) {
                     $controller->addMessage($_POST, $_GET['sid']);
                 }
                 // Display user messages.
                 else {
                     $controller->userMessages();
                 }
                 break;

            default:
                home();
        }
    }
}
