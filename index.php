<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include.php';

if (isset($_GET['controller'])) {
    switch ($_GET['controller']) {

        case 'register':
            RegisterRouter::route();
            break;

        case 'login':
            isset($_GET['action']) ? LoginRouter::route() : LoginRouter::default();
            break;

        case 'user':
            isset($_GET['action']) ? UserRouter::route() : home();
            break;

        case 'info':
            InfoRouter::route();
            break;

        case 'service':
            isset($_GET['action']) ? ServiceRouter::route() : home();
            break;

        case "search" :
            //$controller = new QuickSearchController();
            //$controller->goToQSearch();
            break;
    }
}
else {
    home();
}


/**
 * Display the home page.
 */
function home() {
    // Display the home page if no action asked in get params.
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Controller/HomeController.php';
    $controller = new HomeController();
    $controller->index();
}


//check create service file upload
if (isset($_GET['success'])) {
    ?> <div class="success">Vos fichiers ont bien été envoyés, merci.</div><?php
}
elseif (isset($_GET['e'])) {
    $messageError = base64_decode($_GET['e']);
    $messageError = json_decode($messageError);
    foreach ($messageError as $messgError) {
        ?> <div class="error"><?=$messageError?></div><?php
    }
}

