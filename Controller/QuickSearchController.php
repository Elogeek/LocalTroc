<?php
class QuickSearchController
{

    public function goToQSearch()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/include.php";
        require_once './View/service/quickSearch.php';

        echo $_SERVER['DOCUMENT_ROOT'] . "/include.php";
    }
}