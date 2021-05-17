<?php
class AdminController {

    public function goToAdmin() {
        $username = "Elodie";
        require_once "../include.php";
        require_once './View/admin/pageAdmin.php';
    }
}