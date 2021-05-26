<?php

use App\Entity\Role;
use App\Entity\User;
use Model\DB;

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
    public function getRoleById(int $id): ?Role {
        $request = DB::getInstance()->prepare("SELECT * FROM role WHERE id = :id");
        $request->bindValue(':id', $id);
        $result = $request->execute();
        if ($result && $data = $request->fetch()) {
            return new Role($data['id'], $data['name']);
        }

        return null;
    }

    // Retourner la liste des utilisateurs ayant le role id donné.
    public function getUsersByRole(Role $role): array {
        $users = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user WHERE role_fk = :idRole");
        $request->bindValue(':idRole', $role->getId());
        $request->execute();

        foreach($request->fetchAll() as $udata) {
            $user = new User();
            $user->setId($udata['id']);
            $user->setRole($role);
            $user->setFirstname($udata['firstname']);
            $user->setLastName($udata['lastName']);
            $user->setEmail($udata['email']);
            // do not retrieve password for security reason.
            $user->setPassword('');
            $users[] = $user;
        }

        return $users;
    }

    // Retourner un Role par son nom.
    public function getRoleByName(string $roleName): Role {
        $request = DB::getInstance()->prepare("SELECT * FROM role WHERE name = :name");
        $request->bindValue(':name', $roleName);
        $request->execute();
        $role = new Role();
        if($rdata = $request->fetch()){
            $role->setId($rdata['id']);
            $role->setName($rdata['name']);
        }

        return $role;
    }

    // Ajouter un nouveau Role
    public function addRole(Role &$role) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO role (name) VALUES (:role)");
        $request->bindValue(':role', $role->getName());
        $request->execute();
        $role->setId(DB::getInstance()->lastInsertId());
        return $role->getId() !== null && $role->getId() > 0;
    }

    // Supprime un role donné.
    public function deleteRole(Role $role) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM role WHERE id = :id");
        $request->bindValue('id', $role->getId());
        return $request->execute();
    }
}