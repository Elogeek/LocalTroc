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

    // TODO => Retourner la liste des utilisateurs ayant le role id donné.
    public function getUsersByRole(int $id): array {

    }

    // TODO => Retourner un Role par son nom.
    public function getRoleByName(string $roleName): Role {

    }

    // TODO => Ajouter un nouveau Role
    public function addRole(Role &$role) : bool {


        $role->setId(DB::getInstance()->lastInsertId());
    }

    // TODO => Supprime un role donné.
    public function deleteRole(Role $role) : bool {

    }
}