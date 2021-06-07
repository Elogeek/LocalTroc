<?php

use App\Entity\User;
use App\Entity\UserService;
use App\Manager\UserServiceManager;
use Model\DB;

class ServiceController extends Controller
{
    private array $profileCss;
    private array $javaScripts;
    private UserProfileManager $userProfileManager;
    private UserServiceManager $userServiceManager;

    /**
     * ServiceController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->profileCss = [
            'profile.css',
            'forms.css',
            'services.css',
        ];

        $this->javaScripts = [
            'Objects/ModalWindow.js',
            'profile.js',
        ];

        $this->userProfileManager = new UserProfileManager();
        $this->userServiceManager = new UserServiceManager();
    }

    /**
     * USER connected function.
     * Handle service addition.
     */
    public function addService(array $request) {
        // Make sure user is connected before allowing to add a new service.
        $this->redirectIfNotLoggedIn('user', 'login');

        if($this->isFormSubmitted()) {
            if($this->issetAndNotEmpty($request, 'subject', 'descriptionService')) {
                $subject = DB::secureData($request['subject']);
                $description = DB::secureData($request['descriptionService']);

                $service = new UserService();
                $service->setSubject($subject);
                $service->setDescription($description);
                $service->setServiceDate((new \DateTime())->format('Y-m-d h:i:s'));
                $service->setUser($this->user);

                // Checking if user has uploaded a service image.
                if($_FILES['serviceImage']['size'] > 0) {
                    $fileUploader = new FileUpload($_FILES['serviceImage'], '/assets/uploads/services/');
                    if(!$fileUploader->isSizeInThreshold() || !$fileUploader->upload()) {
                        $this->setErrorMessage("Une erreur est survenue en envoyant l'image de votre service.");
                    }
                    else {
                        $service->setImage($fileUploader->getFinalFileName());
                    }
                }

                $this->userServiceManager->addService($service);
                if($service->getId() !== null) {
                    $this->setSuccessMessage("Votre service a bien été ajouté.");
                }
                else {
                    $this->setErrorMessage("Une erreur est survenue en ajoutant votre service.");
                }
            }
            else {
                $this->setErrorMessage("Tous les champs requis ne sont pas remplis !");
            }
        }

        $this->addCss($this->profileCss);
        $this->addJavaScript($this->javaScripts);
        $this->showView('service/createService', [
            'userProfile' => $this->userProfileManager->getUserProfile($this->user)
        ]);
    }


    /**
     * USER connected function // Uniquement ceux de l'utilisateur connecté.
     * Show connected user services ( user profile )
     */
    public function showLoggedInUserServices() {
        // Make sure user is connected before allowing to add a new service.
        $this->redirectIfNotLoggedIn('user', 'login');
        $this->addCss($this->profileCss);
        $this->addJavaScript($this->javaScripts);
        $this->showView('service/loggedInUserServices', [
            'services' => $this->userServiceManager->getServicesByUser($this->user),
            'userProfile' => $this->userProfileManager->getUserProfile($this->user),
        ]);
    }

    /**
     * USER connected service deletion.
     * Si l'utilisateur ayant créé le service ( son id ) est égale à l'id de l'utilisateur connecté, alors ont peut supprimer
     * @param int $serviceId
     */
    public function deleteLoggedInUserService(int $serviceId) {
        $this->redirectIfNotLoggedIn('user', 'login');
        $service = $this->userServiceManager->getService($serviceId);
        // Delete service only if service is owned by connected user.
        if($service->getUser()->getId() === $this->user->getId()) {
            $this->userServiceManager->deleteService($service);
        }
        // User service deleted, then return to user services listing.
        $this->redirectTo('service', 'user-services');
    }

}