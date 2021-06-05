<?php

use App\Entity\User;
use App\Model\Entity\UserManager;

/**
 * Class Controller, base controller to be extended.
 */
class Controller {

    private ?string $errorMessage = null;
    private ?string $successMessage = null;
    private ?array $javaScripts = null;
    private ?array $css = null;

    /**
     * Show a provided view with all provided params.
     * @param string $viewName
     * @param array|null $params
     */
    public function showView(string $viewName, array $params = []) {
        // Getting connected user.
        $user = $this->getLoggedInUser();
        $connected = !is_null($user);

        // Handling additional JavaScripts.
        if(!is_null($this->javaScripts)) {
            $javaScripts = array_map(function ($js) { return '/assets/js/' . $js;}, $this->javaScripts);
            $this->javaScripts = null;
        }
        else {
            $javaScripts = [];
        }

        // Handling additional css.
        if(!is_null($this->css)) {
            $css = array_map(function ($cs) { return '/assets/css/' . $cs;}, $this->css);
            $this->css = null;
        }
        else {
            $css = [];
        }

        // Checking if there are at least one error or success message.
        if(!is_null($this->errorMessage)) {
            $error = $this->errorMessage;
            $this->errorMessage = null;
        }

        if(!is_null($this->successMessage)) {
            $success = $this->successMessage;
            $this->successMessage = null;
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

    /**
     * Check if form was submitted.
     * @return bool
     */
    public function isFormSubmitted(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST) && isset($_POST['submit']);
    }


    /**
     * Return true if all provided parameters was set.
     * @param array $array
     * @param mixed ...$keys
     * @return bool
     */
    public function issetAndNotEmpty(array $array, ...$keys): bool {
        foreach ($keys as $key) {
            if(!isset($array[$key]) || empty($array[$key])) {
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

    /**
     * Add JavaScript to the next view.
     * @param array $javaScripts
     */
    public function addJavaScript(array $javaScripts) {
        $this->javaScripts = $javaScripts;
    }

    /**
     * Add css to the next view.
     * @param array $css
     */
    public function addCss(array $css) {
        $this->css = $css;
    }

    /**
     * Redirect to specified controller with or without specified action.
     * @param string $controller
     * @param string|null $action
     */
    public function redirectTo(string $controller, string $action = null) {
        $route = '';
        if($controller !== 'index') {
            $route = $action !== null ? "?controller=$controller&action=$action" : "?controller=$controller";
        }
        header('Location: /index.php' . $route);
    }


    /**
     * Return the connected user or null
     * @return User|null
     */
    public function getLoggedInUser(): ?User {
        if(array_key_exists('connected_user', $_SESSION)) {
            $userManager = new UserManager();
            $user = $userManager->getById($_SESSION['connected_user']);
            if($user->getId()) {
                return $user;
            }
        }
        return null;
    }
}