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

    private array $javaScripts;
    private array $css;
    private UserManager $userManager;
    private UserProfileManager  $userProfileManager;

    /**
     * UserController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->javaScripts = [
            'Objects/ModalWindow.js',
            'profile.js',
        ];

        $this->css = [
            'profile.css',
            'forms.css',
            'modalWindow.css',
        ];

        $this->userProfileManager = new UserProfileManager();
        $this->userManager = new UserManager();
    }

    /**
     * Handle user profile.
     */
    public function profile() {
        $this->redirectIfNotLoggedIn('user', 'login');
        $this->addCss($this->css);
        $this->addJavaScript($this->javaScripts);
        $this->showView('user/profile', [
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }


    /**
     * Edit user account information.
     * @param array $req
     */
    public function editInformation(array $req) {
        $this->redirectIfNotLoggedIn('user', 'login');

        if($this->isFormSubmitted()) {
            // Checking all required are set.
            if ($this->issetAndNotEmpty($req, 'firstname', 'lastname', 'mail')) {
                $mail = DB::secureData($req['mail']);
                $firstName = DB::secureData($req['firstname']);
                $lastname = DB::secureData($req['lastname']);

                // Checking user not already exists.
                $error = false;
                if($mail !== $this->user->getEmail() && $this->userManager->getByMail($mail) !== null || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $error = true;
                    $this->setErrorMessage("Cette adresse email est déjà prise ou n'est pas au bon format.");
                }

                // If no errors.
                if(!$error) {
                    $this->user->setFirstname($firstName);
                    $this->user->setLastName($lastname);
                    $this->user->setEmail($mail);

                    $infosRes = $this->userManager->updateUser($this->user);

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
                                $passwordResult = $this->userManager->updatePassword($this->user, $pass);
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

        $this->addJavaScript($this->javaScripts);
        $this->addCss($this->css);

        $this->showView('user/editInformation', [
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }


    /**
     * Edit user in site profile.
     * @param array $req
     */
    public function editProfile(array $req) {
        $this->redirectIfNotLoggedIn('user', 'login');

        // Getting user profile to populate html fields and update user profile with provided data.
        $userProfile = $this->userProfileManager->getUserProfile($this->user);

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
            else {
                $this->setErrorMessage("Certains champs obligatoires sont manquants");
            }
        }

        $this->addJavaScript($this->javaScripts);
        $this->addCss($this->css);

        $this->showView('user/editProfile', [
            'userProfile' => $userProfile,
        ]);
    }


    /**
     * Delete all user data.
     */
    public function deleteUser() {
        $this->redirectIfNotLoggedIn('user', 'login');

        $messageManager = new MessageManager();
        $serviceManager = new UserServiceManager();

        // Getting all user data and delete them to be RGPD conform.
        $messages = $messageManager->getSentMessages($this->user);
        $profile = $this->userProfileManager->getUserProfile($this->user);
        $services = $serviceManager->getServicesByUser($this->user);

        foreach($messages as $message) {
            $messageManager->deleteMessage($message);
        }

        $this->userProfileManager->deleteUserProfile($profile);

        foreach($services as $service) {
            $serviceManager->deleteService($service);
        }

        // Finally deleting the user itself.
        $this->userManager->deleteUser($this->user);
        $this->redirectTo('login', 'disconnect');
    }


    /**
     * Display the user messages list.
     */
    public function userMessages() {
        $this->redirectIfNotLoggedIn('user', 'login');

        $messageManager = new MessageManager();
        $userServiceManager = new UserServiceManager();

        // Getting available messages for connected user services.
        $services = $userServiceManager->getServicesByUser($this->user);
        $servicesMsg = [];
        foreach ($services as $service) {
            $messages = $messageManager->getMessagesByUserService($service);
            if(count($messages) > 0) {
                $servicesMsg[$service->getId()] = $messages;
            }
        }

        // Filtering messages to get pair to pair messages.
        $messages = [];
        foreach( $servicesMsg as $serviceId => $msgArray) {
            $msgs = [];
            // Grouping messages by sender.
            for($y = 0; $y < count($msgArray); $y++) {
                if($msgArray[$y]->getUserFrom()->getId() === $this->user->getId()) {
                    $msgs[$msgArray[$y]->getUserTo()->getId()][] = $msgArray[$y];
                }
                else {
                    $msgs[$msgArray[$y]->getUserFrom()->getId()][] = $msgArray[$y];
                }
            }

            $messages[$serviceId]['messages'] = $msgs;
            $messages[$serviceId]['service'] = $userServiceManager->getService($serviceId);
        }

        $this->addJavaScript($this->javaScripts);
        $this->addCss([...$this->css, 'messages.css']);

        $this->showView('user/messages', [
            'fromUserServices' => $messages,
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }

    /**
     * Add a respond message to service on user profile
     * @param $req
     * @param $sid
     */
    public function addMessage($req, $sid) {
        $this->redirectIfNotLoggedIn('index');

        if($this->isFormSubmitted()) {
            if($this->issetAndNotEmpty($req, 'message', 'user-from', 'user-to')) {
                $msg = DB::secureData($req['message']);
                $userFrom = DB::secureInt($req['user-from']);
                $userTo = DB::secureInt($req['user-to']);

                $service = (new UserServiceManager())->getService($sid);

                if (!is_null($service)) {
                    $messageManager = new MessageManager();
                    if($service->getUser()->getId() === $this->user->getId()) {
                        $userFrom = $this->userManager->getById($userFrom);
                        $userTo = $this->userManager->getById($userTo);
                    }
                    if($messageManager->sendMessages($msg, $service, $userFrom, $userTo)) {
                        $this->setSuccessMessage("Votre message a bien été envoyé");
                    }
                    else {
                        $this->setErrorMessage("Une erreur est survenue en envoyant votre message.");
                    }
                }
            }
        }

        $this->userMessages();
    }


    /**
     * Delete a message if ownad by logged in user..
     * @param int $messageId
     */
    public function deleteMessage(int $messageId) {
        $this->redirectIfNotLoggedIn('index');
        $messagesManager = new MessageManager();
        $message = $messagesManager->getById($messageId);
        if($message && $message->getUserFrom()->getId() === $this->user->getId()) {
            if($messagesManager->deleteMessage($message)) {
                $this->setSuccessMessage("Votre message a bien été supprimé");
            }
            else {
                $this->setErrorMessage("Une erreur est survenue en supprimant votre message");
            }
        }

        $this->userMessages();
    }

}