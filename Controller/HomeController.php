<?php

class HomeController {

    public function index() {
        $username = "John";
        require_once './View/home.php';
    }
}