<?php

/**
 * Class HomeController
 */
class HomeController extends Controller {

    /**
     * Handle the home page.
     */
    public function index() {
        $this->showView('home', [], ['HeaderCarousel']);
    }
}