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
     * Get user logged in.
     * @param array $request
     */
    public function login(array $request) {
        // Si l'utilisateur est déjà connecté, je le renvoie sur son profile.
        if(!is_null($this->getLoggedInUser())) {
            $this->redirectTo('user', 'profile'); // Pas besoin de else puisque l'utilisateur est redirigé si déjà connecté
        }

        // Je vérifie si le formulaire a été soumis ou pas.
        if($this->isFormSubmitted() && $this->issetAndNotEmpty($request['email'], $request['password'])) {
            $mail = DB::secureData($request['email']);
            $password = DB::secureData($request['password']);

            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $userManager = new UserManager();
                $user = $userManager->getByMail($mail);
                if(!is_null($user)) {
                    // Alors le user existe bien, on peut vérifier le password.
                    $encodedPassword = $userManager->getUserPassword($user);
                    if(password_verify($password, $encodedPassword)) {
                        // L'objet utilisateur se trouve en session, on peut l'utiliser partout, si cette variable de session existe ( connected_user ) c'est que l'utilisateur est connecté
                        $_SESSION['connected_user'] = $user->getId();
                        $this->redirectTo('user', 'profile');
                    }
                    else {
                        $this->setErrorMessage("Erreur, le mot de passe n'est pas correct");
                    }
                }
                else {
                    $this->setErrorMessage("L'adresse email n'a pa pu être trouvée, ce compte ne semble pas exister.");
                }
            }
            else {
                $this->setErrorMessage("Le format de l'adresse email n'est pas bon.");
            }

        }
        // On affiche la vue qqui est en charge du formulaire d'inscription.
        $this->addCss([
            'forms.css',
            'errors.css',
        ]);
        $this->showView('user/connect');
    }


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
            if($this->issetAndNotEmpty($request['firstname'], $request['lastname'], $request['pseudo'], $request['birthday'],
                $request['city'], $request['address'], $request['codeZip'], $request['mail'], $request['password'], $request['passwordConfirm'])
            ) {
                // Optionals
                $other = DB::secureData($request['other']);
                $phone = DB::secureData($request['phone']);

                // Starting checking provided - required form data.
                $password = DB::secureData($request['password']);
                $passwordConfirm = DB::secureData($request['passwordConfirm']);
                $firstName = DB::secureData($request['firstname']);
                $lastName = DB::secureData($request['lastname']);
                $pseudo = DB::secureData($request['pseudo']);
                $city = DB::secureData($request['city']);
                $address = DB::secureData($request['address']);
                $zip = DB::secureInt($request['codeZip']);
                $birthday = DB::secureData($request['birthday']);
                $mail = DB::secureData($request['mail']);

                $userManager = new UserManager();
                $userTest = $userManager->getByMail($mail);
                if(is_null($userTest)) {
                    // Checking passwords, zip, phone, birthday
                    // TODO => Vérifie que le password ait bien les pré requis, vérifie l'email, le téléphone, etc...
                    // TODO => Vérifier si le pseudo n'est pas déjà pris...
                    // TODO => Vérifier que les champs optionnels ne soient pas vide avant de mettre à jour.....

                    $roleManager = new RoleManager();
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
            }
            else {
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
        $this->addCss([
            'profile.css',
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
            if ($this->issetAndNotEmpty($req['firstname'], $req['lastname'], $req['mail'])) {

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
                if($this->issetAndNotEmpty($req['password'], $req['passwordConfirm'])) {
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

                if($passwordResult) {
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
            if($this->issetAndNotEmpty($req['pseudo'], $req['city'], $req['address'], $req['codeZip'], $req['birthday'])) {
                $pseudo = DB::secureData($req['pseudo']);
                $city = DB::secureData($req['city']);
                $address = DB::secureData($req['address']);
                $zip = DB::secureInt($req['codeZip']);
                $birthday = DB::secureData($req['birthday']);

                // TODO check birthday, $codeZip, phone, ...
                $userProfile->setPseudo($pseudo);
                $userProfile->setCodeZip($zip);
                $userProfile->setCity($city);
                $userProfile->setAddress($address);
                $userProfile->setBirthday($birthday);

                // Checking if MoreInfo was provided.
                if($this->issetAndNotEmpty($req['other'])) {
                    $userProfile->setMoreInfos(DB::secureData($req['other']));
                }

                // Checking if phone was provided.
                if($this->issetAndNotEmpty($req['phone'])) {
                    $userProfile->setPhone(DB::secureData($req['phone']));
                }

                if($profileManager->updateProfile($userProfile)) {
                    $this->setSuccessMessage("Votre profil a bien été mis à jour");
                }
                else {
                    $this->setErrorMessage("Une erreur est survenue en mettant à jour votre profil");
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