<?php

use Model\DB;

/**
 * Class UserController
 */
class UserController extends Controller {

    /*public function goToPageUser() {
        $username = "John";
        require_once "./include.php";
        require_once './View/user/profileUserPage.php';
    }*/

    /**
     * Handle user account register.
     */
    public function register() {
        // Checking if form was submit.
        if($this->isFormSubmitted()) {
            // Checking all required are set.
            if($this->issetAndNotEmpty($_POST['firstname'], $_POST['lastname'], $_POST['pseudo'], $_POST['birthday'], $_POST['city'],
                $_POST['address'], $_POST['codeZip'], $_POST['mail'], $_POST['password'], $_POST['passwordConfirm'])
            ) {
                // Optionals
                $other = DB::secureData($_POST['other']);
                $phone = DB::secureData($_POST['phone']);
                //"avatar"

                // Starting checking provided - required form data.
                $password = DB::secureData($_POST['password']);
                $passwordConfirm = DB::secureData($_POST['passwordConfirm']);
                $firstName = DB::secureData($_POST['firstname']);
                $lastName = DB::secureData($_POST['lastname']);
                $pseudo = DB::secureData($_POST['pseudo']);
                $city = DB::secureData($_POST['city']);
                $address = DB::secureData($_POST['address']);
                $zip = DB::secureInt($_POST['codeZip']);
                $birthday = DB::secureData($_POST['birthday']);
                $mail = DB::secureData($_POST['mail']);

                // Checking passwords, zip, phone, birthday


            }
            else {
                $this->setErrorMessage('Les champs requis ne sont pas tous remplis');
            }
        }
        $this->showView('register', [], ['Forms']);
    }

}