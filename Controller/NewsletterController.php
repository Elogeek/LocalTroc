<?php

class NewsletterController {

    public function newsletter() {
        $username = "John";
        require_once "include.php";
        require_once './View/newsletter.php';
    }
}