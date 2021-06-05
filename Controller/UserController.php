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
     * Handle user disconnect and redirect to index.
     */
    public function disconnect() {
        $_SESSION = []; // Je remplace le tableau $_SESSION par un tableau qui ne contient rien.
        session_unset();
        session_destroy();
        $this->redirectTo('index');
    }


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