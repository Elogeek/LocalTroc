<?php

use App\Entity\User;
use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
use Model\DB;

/**
 * Manage user registrations.
 * Class RegisterController
 */
class RegisterController extends Controller {

    /**
     * Handle user account register.
     * @param array $request
     */
    public function register(array $request) {
        // Si un utilisateur connecté tente d'accéder à la page d'enregistrelment, alors on le redirige vers son profil.
        if(!is_null($this->getLoggedInUser())) {
            $this->redirectTo('user', 'profile'); // Pas besoin de else puisque l'utilisateur est redirigé si déjà connecté
        }

        // Checking if form was submit.
        if($this->isFormSubmitted()) {

            // Checking all required are set.
            if($this->issetAndNotEmpty($request, 'fname','lname','pseudo','birthday','city','address','zip','mail','passwd','passwdConfirm')) {
                $userManager = new UserManager();
                $roleManager = new RoleManager();
                $profileManager = new UserProfileManager();

                // Optionals
                $other = isset($request['other']) && !empty($request['other']) ? DB::secureData($request['other']) : '';
                $phone = isset($request['phone']) && !empty($request['phone']) ? DB::secureData($request['phone']) : '';

                // Starting checking provided - required form data.
                $password = DB::secureData($request['passwd']);
                $passwordConfirm = DB::secureData($request['passwdConfirm']);
                $firstName = DB::secureData($request['fname']);
                $lastName = DB::secureData($request['lname']);
                $pseudo = DB::secureData($request['pseudo']);
                $city = DB::secureData($request['city']);
                $address = DB::secureData($request['address']);
                $zip = DB::secureInt($request['zip']);
                $birthday = DB::secureData($request['birthday']);
                $mail = DB::secureData($request['mail']);

                // Checking all user inputs.
                $error = false;

                // Checking user not already exists.
                if($userManager->getByMail($mail) !== null) {
                    $error = true;
                    $this->setErrorMessage("Cette adresse email est déjà prise.");
                }
                // Checking if pseudo is already taken.
                elseif($profileManager->isPseudoTaken($pseudo)) {
                    $error = true;
                    $this->setErrorMessage("Désolé, mais ce pseudo est déjà pris.");
                }
                // Checking password.
                elseif($password !== $passwordConfirm || !DB::checkPassword($password)) {
                    $error = true;
                    $this->setErrorMessage("Les mots de passe ne correspondent pas ou ne respectent pas le critère de sécurité.");
                }
                // Checking user mail.
                elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $error = true;
                    $this->setErrorMessage("Le format de l'adresse mail n'est pas correct.");
                }
                // Checking birthday.
                // Si la date n'est pas valide ou si la date ne se situe pas dans la limite [-100 ans ... -10 ans].
                elseif(!DateUtils::isDateValid($birthday) || !DateUtils::isDateBetween($birthday)) {
                    $error = true;
                    $this->setErrorMessage("La date ne semble pas valide.");
                }
                // Checking zip code
                elseif(strlen($zip) !== 4 || !is_numeric($zip)) {
                    $error = true;
                    $this->setErrorMessage("Le code postal doit être de 4 chiffre, au format belge.");
                }
                // Checking phone => in belgium, phone numbers have min 9 ( fixes ) and 10 ( smartphones ) chars
                if(strlen($phone) > 0 ){
                    if(!(strlen($phone) === 9 || strlen($phone) === 10) || !is_numeric($phone)) {
                        $error = true;
                        $this->setErrorMessage("Le numéro de téléphone doit être au format national belge ( 9 ou 10 chiffres ).");
                    }
                }

                // If no errors were found, then registering user.
                if(!$error) {
                    $user = new User();
                    $user->setEmail($mail);
                    $user->setFirstname($firstName);
                    $user->setLastName($lastName);
                    $user->setId(null);
                    $user->setPassword($password);
                    $user->setRole($roleManager->getDefaultRole());

                    // Sauvegarde du nouvel user.
                    if ($userManager->addUser($user) && $user->getId() !== null) {
                        // addUser retourne true en cas de succès, ou false en cas d'erreur.
                        // Si c'est true, on peut ajouter le profil, le profileManager crée automatiquement un profil quand on essaie de le récupérer pour un user et qui ne l'a pas
                        $profile = $profileManager->getUserProfile($user);
                        $profile->setAddress($address);
                        $profile->setCity($city);
                        $profile->setCodeZip($zip);
                        $profile->setMoreInfos($other);
                        $profile->setPhone($phone);
                        $profile->setPseudo($pseudo);
                        $profile->setBirthday($birthday);

                        if ($profileManager->updateProfile($profile)) {
                            $this->setSuccessMessage("Votre compte a bien été créé.");
                        } else {
                            $this->setErrorMessage("Une erreur est survenue lors de la génération de votre profile.");
                        }

                    } else {
                        // Si c'est false, alors on notifie l'utilisateur.
                        $this->setErrorMessage("Une erreur est survenue en créant votre compte.");
                    }
                }

            } else {
                $this->setErrorMessage('Les champs requis ne sont pas tous remplis');
            }
        }

        $this->addCss([
            'forms.css',
            'errors.css',
        ]);
        $this->showView('user/register');
    }

}