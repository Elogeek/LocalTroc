<?php

/**
 * Manage Register route.
 * Class RegisterRouter
 */
class RegisterRouter {

    public static function route() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/RegisterController.php';
        (new RegisterController())->register($_POST);
    }
}