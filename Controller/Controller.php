<?php

/**
 * Class Controller, base controller to be extended.
 */
class Controller {

    /**
     * Show a provided view with all provided params.
     * @param string $viewName
     * @param array|null $params
     * @param array $javaScripts
     * @param array $css
     */
    public function showView(string $viewName, array $params = [], array $javaScripts = [], array $css = []) {
        // Handling optional JavaScripts.
        for($i = 0; $i < count($javaScripts); $i++) {
            $javaScripts[$i] = '/assets/js/' . $javaScripts[$i] . '.js';
        }

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