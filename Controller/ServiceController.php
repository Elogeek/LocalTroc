<?php

class ServiceController extends Controller
{
    /**
     * Handle service addition.
     */
    public function addService(array $request) {

        if($this->isFormSubmitted()) {

        }

        $this->addCss([
            'profile.css',
            'forms.css',
            'errors.css',
        ]);

        $this->showView('service/createService', [
            'userProfile' => (new UserProfileManager())->getUserProfile($this->getLoggedInUser())
        ]);
    }

}