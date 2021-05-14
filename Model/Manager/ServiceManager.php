<?php
namespace App\Model\Manager;

use App\Entity\Service;
use Model\DB;
use PDO;
use PDOException;
use App\Model\Manager\User_service;

class ServiceManager {

    /** Return all services
     * @return array
     */
    public function getServices(): array {
        $services = [];
        $request = DB::getInstance()->prepare("SELECT * FROM service");
        $result = $request->execute();
        if ($result) {
            $data = $request->fetchAll();
            foreach ($data as $serviceData) {
                $services[] = new Service($serviceData['id'], $serviceData['date'], $serviceData['description_service']);
            }
        }
        return $services;
    }

    /** Return an service or null
     * @param $id
     * @return Service|null
     */
    public function getService($id): ?Service {
        $request = DB::getInstance()->prepare("SELECT *FROM service WHERE id = :id");
        $request->bindValue(';id', $id);
        $result = $request->execute();
        $service = null;

        if ($result && $data = $request->fetch()) {
            $service = new Service($data['id'], $data['date'], $data['description_service']);
        }
        return $service;
    }

    /** Add an service on the Database
     * @param Service $service
     * @return bool
     */
    public function addService(Service $service): bool {
        $request =DB::getInstance()->prepare("INSERT INTO service (id, date, 'description-service') VALUES (:id,:date,:contentService)");
        echo'hello';
        $request->bindValue(':id', $service->getId());
        $request->bindValue(';date',$service->getDate());
        $request->bindValue(':contentService', $service->getContentService());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /** Modify/update  service into the Database
     * @param Service $service
     * @return bool
     */
    public function updateService(Service $service): bool {
        $request = DB::getInstance()->prepare("UPDATE service SET `description-service` = :contentService WHERE id = :id");
        $request->bindValue(':content', $service->getContentService());
        $request->bindValue(':id',$service->getId());

        return $request->execute() ;
    }

    /** Delete an service into the Database
     * @param Service $service
     * @return bool
     */
    public function deleteService(Service $service):bool {
        $request = DB::getInstance()->prepare('DELETE FROM service WHERE  id = :id');
        $request->bindValue(':id',$service->getId());

        return $request->execute();
    }

}