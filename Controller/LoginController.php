<?php

use App\Model\Entity\UserManager;
use Model\DB;

/**
 * Manage user login.
 * Class LoginController
 */
class LoginController extends Controller {

    /**
     * LoginController constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get user logged in.
     * @param array $request
     */
    public function login(array $request) {

        $this->redirectIfLoggedIn('user', 'profile');

        // Je vérifie si le formulaire a été soumis ou pas.
        if($this->isFormSubmitted() && $this->issetAndNotEmpty($request, 'email', 'password')) {
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
        // On affiche la vue qui est en charge du formulaire inscription.
        $this->addCss(['forms.css']);
        $this->showView('login/connect');
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
}