<?php


use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;
use App\Manager\MessageManager;

class AdminController extends Controller {

    private array $javaScripts;
    private array $css;
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
        if($this->isAdmin($this->user)) {
            $this->addJavaScript($this->javaScripts);
            $this->addCss($this->css);
            $this->showView('admin/users', [
                'users' => $this->userManager->getAllUsers(),
                'userProfile' => $this->userProfileManager->getUserProfile($this->user),
            ]);
        }
        else {
            // If user is not admin, redirect to the user space.
            $this->redirectTo('user', 'profile');
        }
    }


    /**
     * Delete a user.
     * @param int $id
     */
    public function deleteUser(int $id) {
        if($this->isAdmin($this->user)) {
            $this->addJavaScript($this->javaScripts);
            $this->addCss($this->css);

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
            $this->showView('admin/users', [
                'users' => $this->userManager->getAllUsers(),
                'userProfile' => $this->userProfileManager->getUserProfile($this->user),
            ]);
        }
        else {
            // If user is not admin, redirect to the user space.
            $this->redirectTo('user', 'profile');
        }
    }
}