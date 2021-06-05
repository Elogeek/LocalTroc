<?php

use App\Model\Entity\UserManager;
use Model\DB;

/**
 * Manage user login.
 * Class LoginController
 */
class LoginController extends Controller {

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
        // On affiche la vue qqui est en charge du formulaire d'inscription.
        $this->addCss([
            'forms.css',
            'errors.css',
        ]);
        $this->showView('user/connect');
    }

}