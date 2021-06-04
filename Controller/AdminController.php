<?php


class AdminController extends Controller {

    public function goToAdmin()
    {
        $username = "Elodie";
        require_once "../include.php";
        require_once './View/admin/pageAdmin.php';
        $this->showView(  'admin/pageAdmin', [], [], ['pageAdmin']);
    }
}