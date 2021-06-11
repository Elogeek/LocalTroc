<?php

require_once dirname(__FILE__) . '/../../../Model/Entity/User.php';
require_once dirname(__FILE__) . '/../../../Model/Entity/Role.php';
require_once dirname(__FILE__) . '/../../../Model/Manager/RoleManager.php';
require_once dirname(__FILE__) . '/../../../Model/DB.php';
require_once dirname(__FILE__) . '/../../../Model/Manager/UserManager.php';

use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
use PHPUnit\Framework\TestCase;
use App\Entity\User;

class UserManagerUnitTest extends TestCase {

    // test addUser()
    public function testUserManager() {
        $user = new User();
        $user->setId(null);
        $user->setFirstname("bubulle");
        $user->setLastName("super");
        $user->setEmail("bubulle@gmail.com");
        $user->setPassword("1Aze45672");

        // create a role to do the set role
        $roleManager = new RoleManager();
        $role = $roleManager->getDefaultRole();

        // add the role to the user created at the top
        $user->setRole($role);

        // create a UserManager object
        $userManager = new UserManager();
        // Insert the user
        $userManager->addUser($user);
        //check that the id is not null
        $this->assertNotNull($user->getId());

        // test modify mail user
        $user->setEmail("superbubule@gmail.com");
        $res = $userManager->updateUser($user);
        $this->assertTrue($res);

        // test return mail user
        $result = $userManager->getByMail($user->getEmail());
        $this->assertNotNull($result);

        // test delete user
        $result = $userManager->deleteUser($user);
        $this->assertTrue($result);
    }

}