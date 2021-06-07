<?php

class ServiceController extends Controller
{
    /**
     * Handle service addition.
     */
    public function addService(array $request) {

        $this->addCss([
            'forms.css'
        ]);
        $this->showView('service/createService');
    }

}