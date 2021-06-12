<?php

namespace App\Manager;

use App\Entity\User;
use App\Entity\UserService;
use App\Model\Entity\UserManager;
use Model\DB;

class UserServiceManager {

    /**
     * Return array service(s) by userFk
     * @param User $user
     * @return array
     */
    public function getServicesByUser(User $user): array {
        $userService = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE user_fk = :userFk");
        $request->bindValue(':userFk', $user->getId());
        if ($request->execute()) {
            foreach ($request->fetchAll() as $serviceData) {
                $srv = new UserService();
                $srv->setId($serviceData['id']);
                $srv->setDescription($serviceData['description']);
                $srv->setServiceDate($serviceData['service_date']);
                $srv->setSubject($serviceData['subject']);
                $srv->setUser($user);
                $srv->setImage($serviceData['image']);
                $srv->setValidated($serviceData['validate']);
                $userService[] = $srv;
            }
        }
        return $userService;
    }


    /**
     * Return all services
     * @param int|null $limit
     * @param bool $validated
     * @return array
     */
    public function getServices(int $limit = null, bool $validated=false): array {
        // With limit.
        $limitSQL = '';
        if(!is_null($limit)) {
            $limitSQL = " LIMIT $limit";
        }

        // Only validated ones.
        $validateSQL = '';
        if($validated) {
            $validateSQL = " WHERE validate = 1 ";
        }

        $userManager = new UserManager();
        $services = [];
        $request = DB::getInstance()->prepare("
            SELECT * FROM user_service
                $validateSQL
                ORDER BY id desc
                $limitSQL
            ");

        if ($request->execute()) {
            foreach ($request->fetchAll() as $serviceData) {
                $user = $userManager->getById($serviceData['user_fk']);
                $srv = new UserService();
                $srv->setId($serviceData['id']);
                $srv->setDescription($serviceData['description']);
                $srv->setServiceDate($serviceData['service_date']);
                $srv->setSubject($serviceData['subject']);
                $srv->setUser($user);
                $srv->setImage($serviceData['image']);
                $srv->setValidated($serviceData['validate']);
                $services[] = $srv;
            }
        }
        return $services;
    }


    /**
     * Return an service or null
     * @param int $id
     * @return Userservice|null
     */
    public function getService(int $id): ?Userservice {
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE id = :id");
        $request->bindValue(':id', $id);
        $result = $request->execute();

        if ($result && $data = $request->fetch()) {
            $userManager = new UserManager();
            $srv = new UserService();
            $srv->setId($data['id']);
            $srv->setDescription($data['description']);
            $srv->setServiceDate($data['service_date']);
            $srv->setSubject($data['subject']);
            $srv->setUser($userManager->getById($data['user_fk']));
            $srv->setImage($data['image']);
            $srv->setValidated($data['validate']);
            return $srv;
        }
        return null;
    }


    /**
     * Add an service on the Database
     * @param Userservice $service
     * @return bool
     */
    public function addService(Userservice &$service): bool {
        $request = DB::getInstance()->prepare("
            INSERT INTO user_service (user_fk, service_date, subject, description, image) 
                VALUES (:user_fk, :service_date, :subject, :description, :image)
        ");

        $request->bindValue(':user_fk', $service->getUser()->getId());
        $request->bindValue(':service_date',$service->getServiceDate());
        $request->bindValue(':subject', $service->getSubject());
        $request->bindValue(':description', $service->getDescription());
        $request->bindValue(':image', $service->getImage());

        $request->execute();
        $service->setId(DB::getInstance()->lastInsertId());
        return $service->getId() !== null && $service->getId() > 0;
    }

    /**
     * Modify/update service into the Database
     * @param Userservice $service
     * @return bool
     */
    public function updateService(Userservice $service): bool {
        $request = DB::getInstance()->prepare("
            UPDATE user_service 
                SET description = :description, 
                    subject = :subject,
                    image = :image,
                    validate = :validate
                WHERE id = :id AND user_fk = :user
        ");
        $request->bindValue(':description', $service->getDescription());
        $request->bindValue(':subject', $service->getSubject());
        $request->bindValue(':id',$service->getId());
        $request->bindValue(':user', $service->getUser()->getId());
        $request->bindValue(':image', $service->getImage());
        $request->bindValue(':validate', $service->getValidated());

        return $request->execute() ;
    }

    /**
     * Delete an service into the Database
     * @param Userservice $service
     * @return bool
     */
    public function deleteService(Userservice $service): bool {
        $request = DB::getInstance()->prepare('DELETE FROM user_service WHERE  id = :id');
        $request->bindValue(':id',$service->getId());

        return $request->execute();
    }


    /**
     * Return not validated user services.
     * @return array
     */
    public function getNotValidatedServices(): array
    {
        $userManager = new UserManager();
        $services = [];
        $request = DB::getInstance()->prepare("
            SELECT * FROM user_service 
                WHERE validate = 0
                ORDER BY id desc
            ");

        if ($request->execute() && $servicesData = $request->fetchAll()) {
            foreach ($servicesData as $serviceData) {
                $user = $userManager->getById($serviceData['user_fk']);
                $srv = new UserService();
                $srv->setId($serviceData['id']);
                $srv->setDescription($serviceData['description']);
                $srv->setServiceDate($serviceData['service_date']);
                $srv->setSubject($serviceData['subject']);
                $srv->setUser($user);
                $srv->setImage($serviceData['image']);
                $srv->setValidated($serviceData['validate']);
                $services[] = $srv;
            }
        }
        return $services;
    }

    /**
     * @param string $criteria
     * @param string $searchText
     * @param bool $true
     * @return array
     */
    public function search(string $criteria, string $searchText, bool $true): array {
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);

        $services = [];
        if($criteria === 'user') {
            $request = DB::getInstance()->prepare("
                SELECT u.id as uid, p.id as pid FROM user as u 
                    INNER JOIN user_profile as p ON u.id = p.user_fk
                WHERE u.firstname LIKE :search OR u.lastName LIKE :search OR p.pseudo LIKE :search
            ");
        }
        elseif($criteria === 'city') {
            $request = DB::getInstance()->prepare("
                SELECT user_fk as uid FROM user_profile WHERE city LIKE :search
            ");
        }

        $request->bindValue(':search', "%" . strtolower($searchText) . "%");

        if($request->execute() && $data = $request->fetchAll()) {
            $userManager = new UserManager();
            foreach ($data as $udata) {
                $user = $userManager->getById($udata['uid']);
                $services = array_merge($services, $this->getServicesByUser($user));
            }
        }


        return $services;
    }

}