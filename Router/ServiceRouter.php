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
                default:
                    // TODO => List all services.
            }
        }
    }
}