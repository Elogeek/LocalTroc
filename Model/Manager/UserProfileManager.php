<?php

use App\Entity\User;
use Model\DB;

class UserProfileManager {

    /** Return an  profil user by his id
     * @param int $id
     * @return User|null
     */
    public function getMyProfil(int $id): ?User
    {
        $request = DB::getInstance()->prepare("SELECT * FROM user_profile WHERE id = :id");
        $request->bindValue(':id', $id);

        $request->execute();

    }

}