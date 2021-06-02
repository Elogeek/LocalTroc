<?php

/**
 * Class Controller, base controller to be extended.
 */
class Controller {

    public ?string $errorMessage = null;
    public ?string $successMessage = null;

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
        // Handling optional css
        for($i = 0; $i < count($css); $i++) {
            $css[$i] = '/assets/css/' . $css[$i] . '.css';
        }

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/header.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/menu.php';

        $file = $_SERVER['DOCUMENT_ROOT'] . '/View/' . $viewName . '.php';
        if(file_exists($file)) {
            // Checking if there are at least one error or success message.
            if(!is_null($this->errorMessage)) {
                $error = $this->errorMessage;
                $this->errorMessage = null;
            }

            if(!is_null($this->successMessage)) {
                $success = $this->successMessage;
                $this->successMessage = null;
            }

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


    /**
     * Check if form was submitted.
     * @return bool
     */
    public function isFormSubmitted(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) && isset($_POST['submit']);
    }


    /**
     * Return true if all provided parameters was set.
     * @param ...$params
     * @return bool
     */
    public function issetAndNotEmpty(...$params): bool {
        foreach ($params as $param) {
            if(!isset($param) || empty($param)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Add an error message to be displayed.
     * @param string $message
     */
    public function setErrorMessage(string $message) {
        $this->errorMessage = $message;
    }


    /**
     * Add a succes message to be displayed.
     * @param string $message
     */
    public function setSuccessMessage(string $message) {
        $this->successMessage = $message;
    }
}