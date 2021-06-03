<?php

use App\Entity\User;
use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
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

                // TODO => Vérifie que le password ait bien les pré requis, vérifie l'email, le téléphone, etc...

                $userManager = new UserManager();
                $roleManager = new RoleManager();
                $user = new User();
                $user->setEmail($mail);
                $user->setFirstname($firstName);
                $user->setLastName($lastName);
                $user->setId(null);
                $user->setPassword($password);
                $user->setRole($roleManager->getDefaultRole());

                // Sauvegarde du nouvel user.
                if($userManager->addUser($user) && $user->getId() !== null) {
                    // addUser retourne true en cas de succès, ou false en cas d'erreur.
                    // Si c'est true, on peut ajouter le profile, le profileManager crée automatiquement un profil quand on essaie de le récupérer pour un user et qui ne l'a pas
                    $profileManager = new UserProfileManager();
                    $profile = $profileManager->getUserProfile($user);
                    $profile->setAddress($address);
                    $profile->setBirthday($birthday);
                    $profile->setCity($city);
                    $profile->setCodeZip($zip);
                    $profile->setMoreInfos($other);
                    $profile->setPhone($phone);
                    $profile->setPseudo($pseudo);
                    if($profileManager->updateProfile($profile)) {
                        $this->setSuccessMessage("Votre compte a bien été créé.");
                    }
                    else {
                        $this->setErrorMessage("Une erreur est survenue lors de la génération de votre profile.");
                    }
                }
                else {
                    // Si c'est false, alors on notifie l'utilisateur.
                    $this->setErrorMessage("Une erreur est survenue en créant votre compte.");
                }
            }
            else {
                $this->setErrorMessage('Les champs requis ne sont pas tous remplis');
            }
        }
        $this->showView('register', [], ['Forms']);
    }

}