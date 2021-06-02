<?php

class UserController extends Controller {

    /*public function goToPageUser() {
        $username = "John";
        require_once "./include.php";
        require_once './View/user/profileUserPage.php';
    }*/

    public function register() {
        $this->showView('register');
    }
}