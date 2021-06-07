<?php

use App\Entity\User;
use App\Entity\UserService;
use App\Manager\UserServiceManager;
use Model\DB;

class ServiceController extends Controller
{
    private array $profileCss;

    /**
     * ServiceController constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->profileCss = [
            'profile.css',
            'forms.css',
            'errors.css',
        ];
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

                $manager = new UserServiceManager();
                $manager->addService($service);
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
        $this->showView('service/createService', [
            'userProfile' => (new UserProfileManager())->getUserProfile($this->getLoggedInUser())
        ]);
    }


    /**
     * USER connected function
     * Show connected user services ( user profile )
     */
    public function showServices()
    {
        // Make sure user is connected before allowing to add a new service.
        $this->redirectIfNotLoggedIn('user', 'login');

        $this->addCss($this->profileCss);
    }

}