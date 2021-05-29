<?php

use App\Entity\User;
use Model\DB;

class UserProfileManager {

    /** Return an  profil user by his id
     * @param int $id
     * @return User|null
     */
    public function oneUser(int $id): ?User {
        $request = DB::getInstance()->prepare("SELECT * FROM user_profile WHERE id = :id");
        $request->bindValue(':id', $id);

        $request->execute();

    }

    /** Modify infos users profil
     * @param int $id
     * @return User
     */
    public function updateProfil(int $id) : User {


    }


}