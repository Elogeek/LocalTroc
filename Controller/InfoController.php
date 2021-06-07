<?php

use Model\DB;

class InfoController extends Controller {

    /**
     * InfoController constructor.
     */
    public function __construct() {
        parent::__construct();
    }

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

    /**
     * Display the contact form and send the mail if form is submitted.
     */
    public function getContactForm($request) {

        if($this->isFormSubmitted() && $this->issetAndNotEmpty($request,'firstname','lastname','mail','subject','message')) {
            $mail = strip_tags($request['mail']);
            $firstname = strip_tags($request['firstname']);
            $lastname = strip_tags($request['lastname']);
            $subject = strip_tags($request['subject']);
            $message = strip_tags($request['message']);

            $message =  'De: '      . $mail .      "\n" .
                        'Nom: '     . $lastname .  "\n" .
                        'Prénom: '  . $firstname . "\n" .
                        'Message: ' . wordwrap($message, 75)
            ;

            $headers = 'From: localtroc@gmail.com'     . "\r\n" .
                       'Reply-To: localtroc@gmail.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

            $to = 'localtroc@gmail.com';
            if(mail($to, $subject, $message, $headers)) {
                $this->setSuccessMessage("Votre message a bien été envoyé.");
            }
            else {
                $this->setErrorMessage("Une erreur est survenue lors de l'envoi du mail.");
            }
        }

        $this->addCss([
            'forms.css',
            'errors.css',
        ]);
        $this->showView('info/contact');
    }
}