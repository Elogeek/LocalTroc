<?php

/**
 * Info router to route to CGU and confidentiality policy.
 * Class InfoRouter
 */
class InfoRouter {

    public static function route() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/InfoController.php';
        $controller = new InfoController();

        if(isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'cgu':
                    $controller->getCGU();
                    break;
                case 'confidentiality':
                    $controller->getConfidentialityPolicy();
                    break;
                case 'contact':
                    $controller->getContactForm();
                    break;
                default:
                    $controller->infoIndex();
            }
        }
        else {
           $controller->infoIndex();
        }
    }
}