<?php

/**
 * Class HomeController
 */
class HomeController extends Controller {

    private array $javaScripts;
    private array $css;

    /**
     * HomeController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->javaScripts = [
            'Objects/HeaderCarousel.js',
            'Objects/GenericCarousel.js',
        ];

        $this->css = [
            'headerCarousel.css',
        ];
    }

    /**
     * Handle the home page.
     */
    public function index() {
        // Additional javaScript
        $this->addJavaScript($this->javaScripts);

        // Additional css.
        $this->addCss($this->css);
        $this->showView('home');
    }
}