<?php

use App\Entity\User;
use App\Entity\User\UserProfile;
use Model\DB;

class UserProfileManager {


    /**
     * Return a user profile.
     * @param User $user
     * @return UserProfile
     */
    public function getUserProfile(User $user): UserProfile {
        $request = DB::getInstance()->prepare("SELECT * FROM user_profile WHERE user_fk = :id");
        $request->bindValue(':id', $user->getId());
        $request->execute();
        $data = $request->fetch();

        if ($request->rowCount() > 0) {
            $userProfile = new UserProfile();
            $userProfile->setId($data['id']);
            $userProfile->setUser($user);
            $userProfile->setPseudo($data['pseudo']);
            $userProfile->setAvatar($data['avatar']);
            $userProfile->setBirthday($data['birthday']);
            $userProfile->setCity($data['city']);
            $userProfile->setAddress($data['address']);
            $userProfile->setCodeZip($data['code_zip']);
            $userProfile->setCountry($data['country']);
            $userProfile->setMoreInfos($data['more_infos']);
            $userProfile->setPhone($data['phone']);
            return $userProfile;
        }

        // Warning, if the user does not have a profile, invoke the "createProfile" function with empty data
        return $this->createProfile($user);
    }


    /**
     * Modify infos users profil
     * @param UserProfile $userProfile
     * @return bool
     */
    public function updateProfile(UserProfile $userProfile): bool {
        $request = DB::getInstance()->prepare("
            UPDATE user_profile SET user_fk = :user, pseudo = :pseudo, avatar = :avatar, birthday = :birthday, 
                city = :city, address = :address, code_zip = :codeZip, country = :country,
                    more_infos = :moreInfo, phone = :phone WHERE id = :id
        ");

        $request->bindValue(':id', $userProfile->getId());
        $request->bindValue(":user", $userProfile->getUser()->getId());
        $request->bindValue(':pseudo', $userProfile->getPseudo());
        $request->bindValue(':avatar', $userProfile->getAvatar());
        $request->bindValue(':birthday', $userProfile->getBirthday());
        $request->bindValue(':city', $userProfile->getCity());
        $request->bindValue(':address', $userProfile->getAddress());
        $request->bindValue(':codeZip', $userProfile->getCodeZip());
        $request->bindValue(':country', $userProfile->getCountry());
        $request->bindValue(':moreInfo', $userProfile->getMoreInfos());
        $request->bindValue(':phone', $userProfile->getPhone());

        return $request->execute();
    }


    /**
     * DELETE a USER PROFILE
     * @param UserProfile $userProfile
     * @return bool
     */
    public function deleteUserProfile(UserProfile $userProfile): bool {
        $request = DB::getInstance()->prepare("DELETE FROM user_profile WHERE id = :id");
        $request->bindValue(':id', $userProfile->getId());

        return $request->execute();
    }

    /** Add a profile user in the BDD
     * @param User $user
     * @return UserProfile
     */
    private function createProfile(User $user): ?UserProfile {
        $request = DB::getInstance()->prepare(" 
            INSERT INTO user_profile(user_fk, pseudo, avatar, birthday, city, address, code_zip, country, more_infos, phone)
                VALUES (:userFK, :pseudo, :avatar, :birthday, :city, :address, :codeZip, :country, :moreInfo, :phone)
        ");

        $request->bindValue(':userFK', $user->getId());
        $request->bindValue(':pseudo', $user->getFirstname());
        $request->bindValue(':avatar', null);
        $request->bindValue(':birthday', null);
        $request->bindValue(':city', '');
        $request->bindValue(':address', '');
        $request->bindValue(':codeZip', '');
        $request->bindValue(':country', '');
        $request->bindValue(':moreInfo',null);
        $request->bindValue(':phone', null);

        if($request->execute()) {
            $profile = new UserProfile();
            $profile->setId(DB::getInstance()->lastInsertId());
            $profile->setUser($user);
            $profile->setPseudo($user->getFirstname());
            $profile->setAvatar(null);
            $profile->setBirthday('0000-00-00 00:00:OO');
            $profile->setCity('');
            $profile->setAddress('');
            $profile->setCodeZip('');
            $profile->setCountry('');
            $profile->setMoreInfos(null);
            $profile->setPhone(null);
            return $profile;
        }
        return null;
    }

}