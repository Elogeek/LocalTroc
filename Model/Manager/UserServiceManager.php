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
                $userService[] = new UserService($serviceData['id'], $user);
            }
        }
        return $userService;
    }

    /**
     * Return all services
     * @return array
     */
    public function getServices(): array {
        $userManager = new UserManager();
        $services = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service");
        if ($request->execute()) {
            foreach ($request->fetchAll() as $serviceData) {
                $user = $userManager->getById($serviceData['user_fk']);
                $services[] = new UserService($serviceData['id'], $user, $serviceData['service_date'], $serviceData['subject'], $serviceData['description']);
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
            return new UserService($data['id']);
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
            INSERT INTO user_service (user_fk, service_date, subject, description) 
                VALUES (:user_fk, :service_date, :subject, :description)
        ");

        $request->bindValue(':user_fk', $service->getUser()->getId());
        $request->bindValue(':service_date',$service->getServiceDate());
        $request->bindValue(':subject', $service->getSubject());
        $request->bindValue(':description', $service->getDescription());

        $request->execute();
        $service->setId(DB::getInstance()->lastInsertId());
        return $service->getId() !== null && $service->getId() > 0;
    }

    /**
     * Modify/update  service into the Database
     * @param Userservice $service
     * @return bool
     */
    public function updateService(Userservice $service): bool {
        $request = DB::getInstance()->prepare("
            UPDATE user_service SET description = :description, subject = :subject WHERE id = :id AND user_fk = :user
        ");
        $request->bindValue(':description', $service->getDescription());
        $request->bindValue(':subject', $service->getSubject());
        $request->bindValue(':id',$service->getId());
        $request->bindValue(':user', $service->getUser()->getId());

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

}