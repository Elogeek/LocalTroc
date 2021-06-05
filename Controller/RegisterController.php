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
                // Optionals
                $other = DB::secureData($request['other']);
                $phone = DB::secureData($request['phone']);

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

                $userManager = new UserManager();
                $userTest = $userManager->getByMail($mail);

                // Checking if user already exists into the users table.
                if(is_null($userTest)) {
                    // Checking passwords, zip, phone, birthday
                    // TODO => Vérifie le téléphone, etc...
                    // TODO => Vérifier si le pseudo n'est pas déjà pris...
                    // TODO => Vérifier que les champs optionnels ne soient pas vide avant de mettre à jour.....

                    $error = false;
                    $roleManager = new RoleManager();
                    $user = new User();
                    // Checking user mail.
                    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $error = true;
                        $this->setErrorMessage("Le format de l'adresse mail n'est pas correct");
                    }
                    else {
                        $user->setEmail($mail);
                    }

                    // Checking password.
                    if($password !== $passwordConfirm || !DB::checkPassword($password)) {
                        $error = true;
                        $this->setErrorMessage("Les mots de passe ne correspondent pas ou ne respectent pas le critère de sécurité");
                    }
                    else {
                        $user->setPassword($password);
                    }

                    $user->setFirstname($firstName);
                    $user->setLastName($lastName);
                    $user->setId(null);
                    $user->setRole($roleManager->getDefaultRole());

                    // Sauvegarde du nouvel user.
                    if (!$error && $userManager->addUser($user) && $user->getId() !== null) {
                        // addUser retourne true en cas de succès, ou false en cas d'erreur.
                        // Si c'est true, on peut ajouter le profil, le profileManager crée automatiquement un profil quand on essaie de le récupérer pour un user et qui ne l'a pas
                        $profileManager = new UserProfileManager();
                        $profile = $profileManager->getUserProfile($user);
                        $profile->setAddress($address);
                        $profile->setBirthday($birthday);
                        $profile->setCity($city);
                        $profile->setCodeZip($zip);
                        $profile->setMoreInfos($other);
                        $profile->setPhone($phone);
                        $profile->setPseudo($pseudo);

                        if ($profileManager->updateProfile($profile)) {
                            $this->setSuccessMessage("Votre compte a bien été créé.");
                        } else {
                            $this->setErrorMessage("Une erreur est survenue lors de la génération de votre profile.");
                        }

                    } else {
                        // Si c'est false, alors on notifie l'utilisateur.
                        $this->setErrorMessage("Une erreur est survenue en créant votre compte.");
                    }
                } else {
                    $this->setErrorMessage("L'utilisateur existe déjà");
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