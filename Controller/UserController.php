<?php

use App\Entity\User;
use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
use Model\DB;

/**
 * Class UserController
 */
class UserController extends Controller {

    /**
     * Handle user profile.
     */
    public function profile() {
        $user = $this->getLoggedInUser();
        if(is_null($user)) {
            $this->redirectTo('user', 'login');
        }

        /* return profile user */
        $this->addCss(['profile.css',]);
        $this->showView('user/profile', [
            'userProfile' => (new UserProfileManager())->getUserProfile($user),
        ]);
    }


    /**
     * Edit user account information.
     * @param array $req
     */
    public function editInformation(array $req) {
        $user = $this->getLoggedInUser();
        if(is_null($user)) {
            $this->redirectTo('user', 'login');
        }

        if($this->isFormSubmitted()) {
            // Checking all required are set.
            if ($this->issetAndNotEmpty($req, 'firstname', 'lastname', 'mail')) {

                $userManager = new UserManager();

                $mail = DB::secureData($req['mail']);
                $firstName = DB::secureData($req['firstname']);
                $lastname = DB::secureData($req['lastname']);

                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $user->setEmail($mail);
                }

                $user->setFirstname($firstName);
                $user->setLastName($lastname);

                $infosRes = $userManager->updateUser($user);

                $passwordResult = true;
                // Checking if password was changed, if so, updating password.
                if($this->issetAndNotEmpty($req, 'password', 'passwordConfirm')) {
                    $pass = DB::secureData($req['password']);
                    $passConfirm = DB::secureData($req['passwordConfirm']);

                    if(!DB::checkPassword($pass)) {
                        $this->setErrorMessage("Le format du mot de passe n'est pas correct.");
                        $passwordResult = false;
                    }
                    else {
                        if($pass === $passConfirm) {
                            $passwordResult = $userManager->updatePassword($user, $pass);
                        }
                        else {
                            $this->setErrorMessage("Les mots de passe ne correspondent pas");
                            $passwordResult = false;
                        }
                    }
                }

                if($infosRes && $passwordResult) {
                    $this->setSuccessMessage("Vos informations ont bien été mises à jour !");
                }
            }
        }

        $this->addCss([
            'profile.css',
            'forms.css',
            'errors.css',
        ]);
        $this->showView('user/editInformation');
    }


    /**
     * Edit user in site profile.
     * @param array $req
     */
    public function editProfile(array $req)
    {
        // Redirect user to the login page if he try to access the edit page without being logged in.
        $user = $this->getLoggedInUser();
        if(is_null($user)) {
            $this->redirectTo('user', 'login');
        }
        // Getting user profile to populate html fields and update user profile with provided data.
        $profileManager = new UserProfileManager();
        $userProfile = $profileManager->getUserProfile($user);

        if($this->isFormSubmitted()) {
            // Starting checking provided - required form data.
            if($this->issetAndNotEmpty($req, 'pseudo', 'city', 'address', 'codeZip', 'birthday')) {
                $pseudo = DB::secureData($req['pseudo']);
                $city = DB::secureData($req['city']);
                $address = DB::secureData($req['address']);
                $zip = DB::secureInt($req['codeZip']);
                $birthday = DB::secureData($req['birthday']);

                $error = false;
                // Si la date n'est pas valide ou si la date ne se situe pas dans la limite [-100 ans ... -10 ans].
                if(!DateUtils::isDateValid($birthday) || !DateUtils::isDateBetween($birthday)) {
                    $error = true;
                    $this->setErrorMessage("La date ne semble pas valide.");
                }


                // TODO check $codeZip, phone, ...
                if(!$error) {
                    $userProfile->setPseudo($pseudo);
                    $userProfile->setCodeZip($zip);
                    $userProfile->setCity($city);
                    $userProfile->setAddress($address);
                    $userProfile->setBirthday($birthday);

                    // Checking if MoreInfo was provided.
                    if ($this->issetAndNotEmpty($req, 'other')) {
                        $userProfile->setMoreInfos(DB::secureData($req['other']));
                    }

                    // Checking if phone was provided.
                    if ($this->issetAndNotEmpty($req, 'phone')) {
                        $userProfile->setPhone(DB::secureData($req['phone']));
                    }

                    if ($profileManager->updateProfile($userProfile)) {
                        $this->setSuccessMessage("Votre profil a bien été mis à jour");
                    } else {
                        $this->setErrorMessage("Une erreur est survenue en mettant à jour votre profil");
                    }
                }
            }
            else {
                $this->setErrorMessage("Certains champs obligatoires sont manquants");
            }
        }

        $this->addCss([
            'profile.css',
            'forms.css',
            'errors.css',
        ]);

        $this->showView('user/editProfile', [
            'userProfile' => $userProfile,
        ]);
    }


}