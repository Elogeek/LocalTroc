<?php

use App\Entity\User;
use App\Manager\MessageManager;
use App\Manager\RoleManager;
use App\Manager\UserServiceManager;
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
        $this->addCss(['profile.css']);
        $this->addJavaScript([
            'Objects/ModalWindow.js',
            'profile.js',
        ]);
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

                // Checking user not already exists.
                $error = false;
                if($mail !== $user->getEmail() && $userManager->getByMail($mail) !== null || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $error = true;
                    $this->setErrorMessage("Cette adresse email est déjà prise ou n'est pas au bon format.");
                }

                // If no errors.
                if(!$error) {
                    $user->setFirstname($firstName);
                    $user->setLastName($lastname);
                    $user->setEmail($mail);

                    $infosRes = $userManager->updateUser($user);

                    $passwordResult = true;
                    // Checking if password was changed, if so, updating password.
                    if ($this->issetAndNotEmpty($req, 'password', 'passwordConfirm')) {
                        $pass = DB::secureData($req['password']);
                        $passConfirm = DB::secureData($req['passwordConfirm']);

                        if (!DB::checkPassword($pass)) {
                            $this->setErrorMessage("Le format du mot de passe n'est pas correct.");
                            $passwordResult = false;
                        } else {
                            if ($pass === $passConfirm) {
                                $passwordResult = $userManager->updatePassword($user, $pass);
                            } else {
                                $this->setErrorMessage("Les mots de passe ne correspondent pas");
                                $passwordResult = false;
                            }
                        }
                    }

                    if ($infosRes && $passwordResult) {
                        $this->setSuccessMessage("Vos informations ont bien été mises à jour !");
                    }
                }
            }
        }

        $this->addJavaScript([
            'Objects/ModalWindow.js',
            'profile.js',
        ]);

        $this->addCss([
            'profile.css',
            'forms.css',
            'errors.css',
        ]);
        $this->showView('user/editInformation', [
            'userProfile' => (new UserProfileManager())->getUserProfile($this->getLoggedInUser()),
        ]);
    }


    /**
     * Edit user in site profile.
     * @param array $req
     */
    public function editProfile(array $req) {
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

                // Checking all user inputs.
                $error = false;

                // Checking if pseudo is already taken.
                if($pseudo !== $userProfile->getPseudo() && $profileManager->isPseudoTaken($pseudo)) {
                    $error = true;
                    $this->setErrorMessage("Désolé, mais ce pseudo est déjà pris.");
                }
                // Checking birthday.
                elseif(!DateUtils::isDateValid($birthday) || !DateUtils::isDateBetween($birthday)) {
                    $error = true;
                    $this->setErrorMessage("La date ne semble pas valide.");
                }
                // Checking zip code
                elseif(strlen($zip) !== 4 || !is_numeric($zip)) {
                    $error = true;
                    $this->setErrorMessage("Le code postal doit être de 4 chiffre, au format belge.");
                }

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

                    // Checking if avatar was provided.
                    if($this->issetAndNotEmpty($_FILES, 'avatar')) {
                        $fileUploader = new FileUpload($_FILES['avatar'], '/assets/uploads/avatars/');
                        if($fileUploader->isSizeInThreshold()) {
                            if($fileUploader->upload()) {
                                $this->setSuccessMessage("Votre avatar a bien été mis à jour");
                                $userProfile->setAvatar($fileUploader->getFinalFileName());
                            }
                            else {
                                $this->setErrorMessage("Une erreur est survenue en envoyant votre avatar");
                            }
                        }
                        else {
                            $this->setErrorMessage("L'image fournie est trop volumineuse, elle ne doit pas dépasser 5 Mo");
                        }
                    }
                    else {
                        $this->setErrorMessage("L'avatar n'a pas été fourni");
                    }

                    // Checking if phone was provided.
                    if ($this->issetAndNotEmpty($req, 'phone')) {
                        // Checking phone => in belgium, phone numbers have min 9 ( fixes ) and 10 ( smartphones ) chars
                        $phone = DB::secureData($req['phone']);
                        if(strlen($phone) > 0 ){
                            if(!(strlen($phone) === 9 || strlen($phone) === 10) || !is_numeric($phone)) {
                                $error = true;
                                $this->setErrorMessage("Le numéro de téléphone doit être au format national belge ( 9 ou 10 chiffres ).");
                            } else {
                                $userProfile->setPhone($phone);
                            }
                        }
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

        $this->addJavaScript([
            'Objects/ModalWindow.js',
            'profile.js',
        ]);

        $this->addCss([
            'profile.css',
            'forms.css',
            'errors.css',
        ]);

        $this->showView('user/editProfile', [
            'userProfile' => $userProfile,
        ]);
    }


    /**
     * Delete all user data.
     */
    public function deleteUser() {
        $user = $this->getLoggedInUser();
        if(is_null($user)) {
            $this->redirectTo('user', 'login');
        }

        $userManager = new UserManager();
        $messageManager = new MessageManager();
        $userProfileManager = new UserProfileManager();
        $serviceManager = new UserServiceManager();

        // Getting all user data and delete them to be RGPD conform.
        $messages = $messageManager->getSentMessages($user);
        $profile = $userProfileManager->getUserProfile($user);
        $services = $serviceManager->getServicesByUser($user);

        foreach($messages as $message) {
            $messageManager->deleteMessage($message);
        }

        $userProfileManager->deleteUserProfile($profile);

        foreach($services as $service) {
            $serviceManager->deleteService($service);
        }

        // Finally deleting the user itself.
        $userManager->deleteUser($user);

        $this->redirectTo('login', 'disconnect');
    }


}