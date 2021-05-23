<?php

use App\Entity\UserService;
use Model\DB;

class UserServiceManager {

    /** Return array service(s) by userFk
     * @param $userFk
     * @return array|null
     */
    public function getServiceByUser($userFk): ?array {
        $myService = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE user_fk = :userFk");
        $request->bindValue(':userFk',$userFk);
        $result = $request->execute();
        if ($result){
            $data = $request->fetchAll();
            foreach ($data as $serviceData) {
                $myService[] = new UserService($serviceData['id'], $serviceData['userFk']);
            }
        }
        return $myService;
    }

    /** Return all services
     * @return array
     */
    public function getServices(): array {
        $services = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service");
        $result = $request->execute();
        if ($result) {
            $data = $request->fetchAll();
            foreach ($data as $serviceData) {
                $services[] = new UserService($serviceData['id'], $serviceData['user_fk'], $serviceData['service_date'], $serviceData['subject'], $serviceData['description']);
            }
        }
        return $services;
    }

    /** Return an service or null
     * @param $id
     * @return Userservice|null
     */
    public function getService($id): ?Userservice {
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE id = :id");
        $request->bindValue(';id', $id);
        $result = $request->execute();
        $service = null;

        if ($result && $data = $request->fetch()) {
            $service = new Userservice($data['id']);
        }
        return $service;
    }

    /** Return all services by subject
     * @param $subject
     * @return UserService|null
     */
    public function getSubject($subject) : ? array {
        $arraySubject = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE subject = :subject");
        $request->bindValue(':subject', $subject);
        $result = $request->execute();
        if ($result) {
            $data = $request->fetchAll();
            foreach ($data as $datas) {
                $arraySubject = new UserService( $datas['subject']);
            }
        }
        return $arraySubject;
    }

    /** Add an service on the Database
     * @param Userservice $service
     * @return bool
     */
    public function addService(Userservice $service): bool {
        $request =DB::getInstance()->prepare("INSERT INTO user_service (id, user_fk, service_date, subject, description) 
                                                    VALUES (:id, :user_fk, :service_date, :subject, :description)");

        $request->bindValue(':id', $service->getId());
        $request->bindValue(':user_fk', $service->getUserFk());
        $request->bindValue(':service_date',$service->getServiceDate());
        $request->bindValue(':subject', $service->getSubject());
        $request->bindValue(':description', $service->getDescription());

        return $request->execute() && DB::getInstance()->lastInsertId() != 0;
    }

    /** Modify/update  service into the Database
     * @param Userservice $service
     * @return bool
     */
    public function updateService(Userservice $service): bool {
        $request = DB::getInstance()->prepare("UPDATE user_service SET description = :description WHERE id = :id AND user_fk = :user");
        $request->bindValue(':description', $service->getDescription());
        $request->bindValue(':id',$service->getId());
        $request->bindValue(':user', $service->getUserFk());

        return $request->execute() ;
    }

    /** Delete an service into the Database
     * @param Userservice $service
     * @return bool
     */
    public function deleteService(Userservice $service):bool {
        $request = DB::getInstance()->prepare('DELETE FROM user_service WHERE  id = :id');
        $request->bindValue(':id',$service->getId());

        return $request->execute();
    }
}