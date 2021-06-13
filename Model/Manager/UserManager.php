<?php
namespace App\Model\Entity;

use App\Entity\Role;
use App\Entity\User;
use App\Manager\RoleManager;
use Model\DB;

class UserManager
{

    /**
     * Return all users.
     * @return array
     */
    public function getAllUsers(): array {
        $users = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user ORDER BY id DESC");
        if($request->execute() && $data = $request->fetchAll()) {
            $roleManager = new RoleManager();
            foreach($data as $udata) {
                $role = $roleManager->getRoleById($udata['role_fk']);
                $users[] = new User($udata['id'], $role, $udata['firstname'], $udata['lastName'], $udata['email']);
            }
        }
        return $users;
    }

    /**
     *
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User {
        $user = null;
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id ");
        $request->bindValue(':id', $id);
        $result = $request->execute();
        $data = $request->fetch();

        if ($result && $data) {
            $roleManager = new RoleManager();
            $role = $roleManager->getRoleById($data['role_fk']);
            $user = new User($data['id'], $role, $data['firstname'], $data['lastName'], $data['email']);
        }
        return $user;
    }


    /**
     * Return a user based on provided email if any.
     * @param string $mail
     * @return User|null
     */
    public function getByMail(string $mail): ?User {
        $user = null;
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE email = :mail");
        $request->bindValue(':mail', $mail);
        if($request->execute()) {
            $data = $request->fetch();
            if($request->rowCount() > 0) {
                $roleManager = new RoleManager();
                $role = $roleManager->getRoleById($data['role_fk']);
                $user = new User($data['id'], $role, $data['firstname'], $data['lastName'], $data['email']);
            }
        }
        return $user;
    }

    /**
     * Return an User by his user name or null
     * @param string $email
     * @return bool
     */
    public function existUser(string $email): bool
    {
        $request = DB::getInstance()->prepare("SELECT count(*) as cnt FROM user WHERE email = :mail");
        $request->bindValue(':mail', $email);
        $request->execute();
        return intval($request->fetch()['cnt']) > 0;
    }

    /**
     * Add an user into table user
     * @param User $user
     * @return bool
     */
    public function addUser(User &$user): bool
    {
        $request = DB::getInstance()->prepare("
            INSERT INTO user (role_fk, firstname, lastName, email, password) 
                    VALUES (:role, :firstname,:lastName, :mail, :password)
        ");

        $request->bindValue(":role", $user->getRole()->getId());
        $request->bindValue(":firstname", $user->getFirstname());
        $request->bindValue(":lastName", $user->getLastName());
        $request->bindValue(":mail", $user->getEmail());
        $request->bindValue(":password", DB::encodePassword($user->getPassword()));
        $result = $request->execute();
        $user->setId(DB::getInstance()->lastInsertId());
        return $result;
    }

    /**
     * Delete  an user in the Database
     * @param User $user
     * @return bool
     */
    public function deleteUser(User $user): bool
    {
        $request = DB::getInstance()->prepare("DELETE FROM user WHERE  id =:id");
        $request->bindValue(":id", $user->getId());
        return $request->execute();
    }


    /**
     * Modify user
     * @param User $user
     * @return bool
     */
    public function updateUser(User $user): bool
    {
        $request = DB::getInstance()->prepare(" 
            UPDATE user SET  role_fk = :role, firstName = :firstName, lastName = :lastName, email = :email
                WHERE id = :id
        ");
        $request->bindValue(':id', $user->getId());
        $request->bindValue(':role', $user->getRole()->getId());
        $request->bindValue(':firstName', $user->getFirstname());
        $request->bindValue(':lastName', $user->getLastName());
        $request->bindValue(':email', $user->getEmail());
        return $request->execute();
    }


    /**
     * Modify password user and encode new password in the BDD
     * @param User $user
     * @param string $plainPassword
     * @return bool
     */
    public function updatePassword(User $user, string $plainPassword): bool
    {
        $request = DB::getInstance()->prepare(" UPDATE user SET password = :password WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        $request->bindValue(':password', DB::encodePassword($plainPassword));
        $request->execute();
        return $plainPassword;
    }


    /**
     * Return plainPassword
     * (is used with the function check password by example to check the two passwords)
     * @param User $user
     * @return string
     */
    public function getUserPassword(User $user): string
    {
        $request = DB::getInstance()->prepare("SELECT password FROM user WHERE id = :id");
        $request->bindValue(':id', $user->getId());
        $request->execute();
        return $request->fetch()['password'];
    }
}