<?php


use App\Manager\RoleManager;
use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;
use App\Manager\MessageManager;
use Model\DB;

class AdminController extends Controller {

    private array $javaScripts;
    private array $css;
    private RoleManager $rolesManager;
    private UserManager $userManager;
    private UserProfileManager $userProfileManager;
    private MessageManager $messageManager;
    private UserServiceManager $userServiceManager;

    public function __construct() {
        parent::__construct();
        // Building needed managers.
        $this->userManager = new UserManager();
        $this->userServiceManager = new UserServiceManager();
        $this->userProfileManager = new UserProfileManager();
        $this->messageManager = new MessageManager();
        $this->rolesManager = new RoleManager();

        $this->css = [
            'profile.css',
            'forms.css',
            'services.css',
            'modalWindow.css',
            'admin.css',
        ];
        $this->javaScripts = [
            'Objects/ModalWindow.js',
            'profile.js',
            'admin.js'
        ];
    }

    /**
     * List all available users.
     */
    public function listUsers() {
        // Rediret user if he is not an admin.
        $this->redirectIfNotAdmin($this->user);
        $this->addJavaScript($this->javaScripts);
        $this->addCss($this->css);
        $this->showView('admin/users', [
            'users' => $this->userManager->getAllUsers(),
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }


    /**
     * Delete a user.
     * @param int $id
     */
    public function deleteUser(int $id) {
        $this->redirectIfNotAdmin($this->user);
        $user = $this->userManager->getById($id);
        if(!is_null($user)) {
            // Getting all user data and delete them to be RGPD conform.
            $messages = $this->messageManager->getSentMessages($user);
            $profile = $this->userProfileManager->getUserProfile($user);
            $services = $this->userServiceManager->getServicesByUser($user);

            // Deleting sent messages.
            foreach($messages as $message) {
                $this->messageManager->deleteMessage($message);
            }

            // Deleting profile.
            $this->userProfileManager->deleteUserProfile($profile);

            // Deleting services.
            foreach($services as $service) {
                $this->userServiceManager->deleteService($service);
            }

            // Deleting user connection information.
            if($this->userManager->deleteUser($user)) {
                $this->setSuccessMessage("L'utilisateur a bien été supprimé");
            }
            else {
                $this->setErrorMessage("Erreur en supprimant cet utilisateur.");
            }
        } else {
            $this->setErrorMessage("L'utilisateur n'a pas été trouvé");
        }
        // Je retourne vers la liste des utilisateurs.
        $this->listUsers();
    }


    /**
     * List all available services.
     */
    public function listServices() {
        $this->redirectIfNotAdmin($this->user);

        $this->addJavaScript($this->javaScripts);
        $this->addCss($this->css);
        $this->showView('admin/services', [
            'services' => $this->userServiceManager->getServices(),
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }


    /**
     * Delete a service.
     * @param int $id
     */
    public function deleteService(int $id) {
        $this->redirectIfNotAdmin($this->user);
        // Deleting the service.
        $service = $this->userServiceManager->getService($id);
        if(!is_null($service)) {
            // Suppression des messages associés au service.
            $messages = $this->messageManager->getMessagesByUserService($service);
            foreach ($messages as $message) {
                $this->messageManager->deleteMessage($message);
            }

            // Suppression du service en lui même
            if($this->userServiceManager->deleteService($service)) {
                $this->setSuccessMessage("Le service a bien été supprimé.");
            }
            else {
                $this->setErrorMessage("Une erreur est survenue en supprimant le service");
            }
        }
        else {
            $this->setErrorMessage("Erreur, le service n'existe pas");
        }
        $this->listServices();
    }

    /**
     * Edit a user
     * @param int $id
     * @param array $req
     */
    public function editUser(int $id, array $req) {
        $this->redirectIfNotAdmin($this->user);
        // Getting user to edit.
        $user = $this->userManager->getById($id);
        if($user) {
            $userProfile = $this->userProfileManager->getUserProfile($user);

            if($this->isFormSubmitted()) {

                // Edit user basic informations.
                if($this->issetAndNotEmpty($req, 'pseudo', 'city', 'address', 'codeZip', 'birthday')) {
                    $mail = DB::secureData($req['mail']);
                    $firstName = DB::secureData($req['firstname']);
                    $lastname = DB::secureData($req['lastname']);

                    // Checking user not already exists.
                    $error = false;
                    if($mail !== $user->getEmail() && $this->userManager->getByMail($mail) !== null || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                        $error = true;
                        $this->setErrorMessage("Adresse email est déjà prise ou n'est pas au bon format.");
                    }

                    // If no errors.
                    if(!$error) {
                        $user->setFirstname($firstName);
                        $user->setLastName($lastname);
                        $user->setEmail($mail);

                        $infosRes = $this->userManager->updateUser($user);

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
                                    $passwordResult = $this->userManager->updatePassword($user, $pass);
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

                // Edit user profile.
                if($this->issetAndNotEmpty($req, 'pseudo', 'city', 'address', 'codeZip', 'birthday')) {
                    $pseudo = DB::secureData($req['pseudo']);
                    $city = DB::secureData($req['city']);
                    $address = DB::secureData($req['address']);
                    $zip = DB::secureInt($req['codeZip']);
                    $birthday = DB::secureData($req['birthday']);

                    // Checking all user inputs.
                    $error = false;

                    // Checking if pseudo is already taken.
                    if($pseudo !== $userProfile->getPseudo() && $this->userProfileManager->isPseudoTaken($pseudo)) {
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
                        if($_FILES['avatar']['size'] > 0) {
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

                        // Checking if phone was provided.
                        if ($this->issetAndNotEmpty($req, 'phone')) {
                            // Checking phone => in belgium, phone numbers have min 9 ( fixes ) and 10 ( smartphones ) chars
                            $phone = DB::secureData($req['phone']);
                            if(strlen($phone) > 0 ){
                                if(!(strlen($phone) === 9 || strlen($phone) === 10) || !is_numeric($phone)) {
                                    $this->setErrorMessage("Le numéro de téléphone doit être au format national belge ( 9 ou 10 chiffres ).");
                                } else {
                                    $userProfile->setPhone($phone);
                                }
                            }
                        }

                        if ($this->userProfileManager->updateProfile($userProfile)) {
                            $this->setSuccessMessage("Votre profil a bien été mis à jour");
                        } else {
                            $this->setErrorMessage("Une erreur est survenue en mettant à jour votre profil");
                        }
                    }
                }
            }

            $this->addCss($this->css);
            $this->addJavaScript($this->javaScripts);
            $this->showView('admin/editUser', [
                'user' => $user,
                'userProfile' => $userProfile,
            ]);
        }
        else {
            $this->setErrorMessage("L'utilisateur spécifié ne peut être trouvé");
        }
    }

    /**
     * Edit a user service.
     * @param int $id
     * @param array $req
     */
    public function editService(int $id, array $req) {
        // Rediret to user profile if connected user is not admin.
        $this->redirectIfNotAdmin($this->user);
        $service = $this->userServiceManager->getService($id);

        if(!is_null($service)) {
            if ($this->isFormSubmitted()) {
                if ($this->issetAndNotEmpty($req, 'subject', 'descriptionService')) {
                    $subject = DB::secureData($req['subject']);
                    $description = DB::secureData($req['descriptionService']);

                    $service->setSubject($subject);
                    $service->setDescription($description);
                    $service->setServiceDate((new \DateTime())->format('Y-m-d h:i:s'));

                    // Checking if user has uploaded a service image.
                    if ($_FILES['serviceImage']['size'] > 0) {
                        $fileUploader = new FileUpload($_FILES['serviceImage'], '/assets/uploads/services/');
                        if (!$fileUploader->isSizeInThreshold() || !$fileUploader->upload()) {
                            $this->setErrorMessage("Une erreur est survenue en envoyant l'image de votre service.");
                        } else {
                            $service->setImage($fileUploader->getFinalFileName());
                        }
                    }

                    $this->userServiceManager->updateService($service);
                    if ($service->getId() !== null) {
                        $this->setSuccessMessage("Votre service a bien été ajouté.");
                    } else {
                        $this->setErrorMessage("Une erreur est survenue en ajoutant votre service.");
                    }
                } else {
                    $this->setErrorMessage("Tous les champs requis ne sont pas remplis !");
                }
            }

            $this->addCss($this->css);
            $this->addJavaScript($this->javaScripts);
            $this->showView('admin/editService', [
                'service' => $service,
                'userProfile' => $this->userProfileManager->getUserProfile($this->user)
            ]);
        }
        else {
            $this->setErrorMessage("Ce service n'a pas pu être trouvé !");
        }
    }


    /**
     * Allow admin to promote / unpromote users.
     */
    public function manageRoles(array $request) {
        // Redirect user if he is not an admin.
        $this->redirectIfNotAdmin($this->user);
        if($this->isFormSubmitted()) {
            $userId = DB::secureInt($request['user-id']);
            $roleId = DB::secureInt($request['role-id']);
            if($userId !== 0) {
                $user = $this->userManager->getById($userId);
                $role = $this->rolesManager->getRoleById($roleId);

                if(!is_null($user) && !is_null($role)) {
                    $user->setRole($role);
                    if($this->userManager->updateUser($user)) {
                        $this->setSuccessMessage("Le rôle utilisateur a bien été modifié.");
                    }
                    else {
                        $this->setErrorMessage("Une erreur est survenue lors de l'édition du rôle utilisateur.");
                    }
                }
                else {
                    $this->setErrorMessage("L'utilisateur ou le rôle n'existe pas.");
                }
            }
            else {
                $this->setErrorMessage("Vous n'avez pas sélectionné d'utilisateur.");
            }
        }

        // Getting users and removing the current logged in admin ( users cannot change their own role )
        $users = $this->userManager->getAllUsers();
        foreach ($users as $key => $user) {
            if($user->getId() === $this->user->getId()) {
                unset($users[$key]);
            }
        }
        $this->addJavaScript($this->javaScripts);
        $this->addCss($this->css);
        $this->showView('admin/manageRole', [
            'roles' => $this->rolesManager->getRoles(),
            'users' => $users,
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }

    /**
     * Service moderation.
     * @param int|null $id
     */
    public function serviceValidate(int $id=null) {
        // Redirect user if he is not an admin.
        $this->redirectIfNotAdmin($this->user);
        $this->addJavaScript($this->javaScripts);
        $this->addCss($this->css);

        if($id !== null) {
            $service = $this->userServiceManager->getService($id);
            if(!is_null($service)) {
                $service->setValidated(1);
                if($this->userServiceManager->updateService($service)) {
                    $this->setSuccessMessage("Le service a bien été validé.");
                }
                else {
                    $this->setErrorMessage("Le service n'a pas pu être validé.");
                }
            }
            else {
                $this->setErrorMessage("Le service n'a pas pu etre trouvé");
            }
        }

        $this->showView('admin/servicesValidate', [
            'services' => $this->userServiceManager->getNotValidatedServices(),
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }
}