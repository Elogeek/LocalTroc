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
        $javaScripts = [
            'HeaderCarousel',
            'GenericCarousel',
        ];
        $this->showView('home', [], $javaScripts, ['headerCarousel']);
    }
}