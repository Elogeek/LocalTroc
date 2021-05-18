<?php

class HomeController {

    public function index() {
        $username = "John";
        require_once "include.php";
        require_once './View/home.php';
    }
}