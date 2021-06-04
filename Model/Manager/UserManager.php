<?php
namespace App\Model\Entity;

use App\Entity\Role;
use App\Entity\User;
use App\Manager\RoleManager;
use Model\DB;

class UserManager
{

    /**
     * Return an User by his id
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User
    {
        $user = null;
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id ");
        $request->bindValue(':id', $id);

        if ($request->execute() && $userData = $request->fetch()) {
            $roleManager = new RoleManager();
            $role = $roleManager->getRoleById($userData['role_fk']);
            $user = new User($userData['id'], $role, $userData['firstname'], $userData['lastName'], $userData['email']);
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
     * Sanitize cookies session User
     * Destroy session cookie
     * @param int $id
     * @param string $email
     * @return void
     */
    public function logOut(int $id, string $email): void
    {
        if (isset($_SESSION['id'], $_SESSION['email'])) {
            //Destroy all session variables (the data)
            $_SESSION = array();
            $params = session_get_cookie_params();
            //destruction of the session cookie sent to the browser
            //the session id no longer exists on the session cookie side
            setcookie(session_name(), '', time() - 50000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
            //destruction ot the session
            session_destroy();
            header('location=index.php');
        }

    }

    /**
     * Delete  an user in the Database
     * @param User $user
     * @return User|null
     */
    public function deleteUser(User $user): ?User
    {
        $request = DB::getInstance()->prepare("DELETE FROM user WHERE  id =:id");
        $request->bindValue(":id", $user->getId());
        $request->execute();
        return $user;
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