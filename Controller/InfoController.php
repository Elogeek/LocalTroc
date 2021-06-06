<?php

class InfoController extends Controller {

    /**
     * Display the info page that links to CGU and Confidentiality policy.
     */
    public function infoIndex() {
        $this->showView('info/infoIndex');
    }

    /**
     * CGU ( Conditions générales d'utilisation )
     */
    public function getCGU() {
        $this->showView('info/cgu');
    }

    /**
     * Confidentiality policy ( Politique de confidentialité, RGPD ).
     */
    public function getConfidentialityPolicy() {
        $this->showView('info/confidentiality');
    }
}