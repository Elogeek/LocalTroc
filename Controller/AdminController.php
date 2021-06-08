<?php


use App\Manager\UserServiceManager;
use App\Model\Entity\UserManager;

class AdminController extends Controller {

    private array $javaScripts;
    private array $css;
    private UserManager $userManager;
    private UserServiceManager $userServiceManager;

    public function __construct() {
        parent::__construct();
        $this->userManager = new UserManager();
        $this->userServiceManager = new UserServiceManager();
        $this->css = [
            'profile.css',
            'forms.css',
            'services.css',
            'modalWindow.css'
        ];
        $this->javaScripts = [
            'Objects/ModalWindow.js',
            'profile.js',
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
                'users' => $this->userManager->getAllUsers()
            ]);
        }
        else {
            // If user is not admin, redirect to the user space.
            $this->redirectTo('user', 'profile');
        }
    }
}