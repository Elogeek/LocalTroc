<?php

class ServiceController extends Controller
{
    /**
     * Handle service addition.
     */
    public function addService(array $request) {

        $this->showView('service/createService');
    }

}