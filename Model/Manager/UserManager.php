<?php
namespace App\Model\Entity;

use App\Entity\User;
use Model\DB;

class UserManager {

    /** Return an User by his id
     * @param int $id
     * @return User|null
     */
    public function getById(int $id): ?User {
        $user = null;
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE id = :id");
        $request->bindValue(':id', $id);
        $result = $request->execute();

        if ($result) {
            $userData = $request->fetch();
            if ($userData) {
                $user = new User($userData['id'], $userData['username'], $userData['lastName'], $userData['email'], $userData['phone'],$userData['password']);
            }
        }

        return $user;
    }

    /**
     * Return an User by his user name or null
     * @param string $email
     * @return User|null
     */
    public function existUser(string $email): ?User {
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE email = :mail");
        $request->bindValue(':mail', $email);
        $result = $request->execute();
        $user = null;

        if ($result && $userData = $request->fetch()) {
            $user = new User($userData['id'], $userData['username'], $userData['lastName'], $userData['email'], $userData['phone'],$userData['password']);
        }

        return $user;
    }

    /**
     * Add an user into table user
     * @param User $user
     * @return bool
     */
    public function addUser(User $user): bool
    {
        $request = DB::getInstance()->prepare("INSERT INTO user (id,username,lastName,email,phone,password) VALUES (:id, :username,:lastName, :mail, :phone, :password)");

        $request->bindValue(":id",$user->getId());
        $request->bindValue(":username", $user->getUsername());
        $request->bindValue(":lastName",$user->getLastName());
        $request->bindValue(":mail", $user->getMail());
        $request->bindValue(":phone",$user->getPhone());
        $request->bindValue(":password", password_hash($user->getPassword(), PASSWORD_BCRYPT));

        return $request->execute() && DB::encodePassword($request) && DB::getInstance()->lastInsertId() != 0;
    }

    /**
     * Sanitize cookies session User
     * Destroy session cookie
     * @param int $id
     * @param string $username
     * @return User|null
     */
    public function  sanitizeCookie(int $id, string $username): ?User {
        if (isset($_SESSION['id'], $_SESSION['username'])) {
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

    /** Delete  an user in the Database
     * @param int $id
     * @param User $user
     * @return User|null
     */
    public function deleteUser(int $id, User $user): ?User {
        $request = DB::getInstance()->prepare("DELETE FROM user WHERE  id =:id");
        $request->bindValue(":id",$user->getId());
        $request->execute();
        return $user;
    }

}