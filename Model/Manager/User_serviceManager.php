<?php

use App\Entity\Service;
use Model\DB;

class User_serviceManager{

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
                $myService[] = new Service($serviceData['id'], $serviceData['serviceFk'], $serviceData['userFk']);
            }
        }
        return $myService;
    }

}