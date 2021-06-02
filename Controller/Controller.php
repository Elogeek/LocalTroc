<?php

class Controller {

    public function showView(string $viewName) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/header.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/menu.php';

        $file = $_SERVER['DOCUMENT_ROOT'] . '/View/' . $viewName . '.php';
        if(file_exists($file)) {
            require_once "$file";
        } else { ?>
            <section class="error-404">
                <h1>Erreur 404</h1>
                <div>
                    La page demandée n'existe pas !
                </div>
            </section> <?php
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/footer.php';
    }
}