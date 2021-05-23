<?php

use App\Entity\User;
use Model\DB;

require_once $_SERVER['DOCUMENT_ROOT'] . '/include.php';
/**
 * Class RolesManager
 */
class RoleManager
{

    /**
     * Return a Role object based on a given role id.
     * @param int $id
     * @return Role
     */
    public function getAdmin($id): ?Role {
        $role = null;
        $request = DB::getInstance()->prepare("Select * FROM role WHERE id = :id");
        $request->bindValue(':id', $id);
        $result = $request->execute();
        if ($result && $data = $request->fetch()) {
            $role = new Role($data['id'], $data['name']);
        }

        return $role;
    }

    /**
     * Return true if user is admin.
     * @param User $user
     * @return bool
     */
    public static function isAdmin(User $user) {
        return $user->getRoleFk()->getId() && $user->getRoleFk()->getName() === 'admin';
    }
}