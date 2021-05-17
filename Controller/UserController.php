<?php

class UserController {

    public function goToPageUser() {
        $username = "John";
        require_once "../include.php";
        require_once './View/user/profileUserPage.php';
    }
}