<?php

/**
 * Class HomeController
 */
class HomeController extends Controller {

    /**
     * Handle the home page.
     */
    public function index() {
        // Additional javaScript
        $this->addJavaScript([
            'Objects/HeaderCarousel.js',
            'Objects/GenericCarousel.js',
        ]);

        // Additional css.
        $this->addCss(['headerCarousel.css']);
        $this->showView('home');
    }
}