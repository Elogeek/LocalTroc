<?php
use App\Entity\User;
use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
use Model\DB;

require_once $_SERVER ['DOCUMENT_ROOT'] . '/include.php';

$userManager = new User();
$user = $userManager;

$roleManager = new RoleManager();
$role = $roleManager;

$userActual = unserialize($_SESSION['userActual']);

//area admin
if(isset($_SESSION['current_user'])) {
    //If user actual === admin ==== area admin
    if ($userActual->getId() && $role->getRoleById(1) || $role->getRoleByName('admin')) {
        require './View/admin/pageAdmin.php';
    }
    else {
    //Else redirect to the home page if user actual is not admin
        header('location: home.php');
    }

}

// Login process, after having provided login informations.
elseif($_GET['page'] === 'connect') {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = DB::secureData($_POST['email']);
        //Check verify passwords ( in BDD and user script password)
        $password = DB::secureData($_POST['password'] && DB::checkPassword('password'));
        //If passwords not correct ( pas les mêmes passwords)
        if(!$userActual->getId()) {
            DB::setMessage("Nous n'avons aucun utilisateur avec cet email", 'error');
        }
        else {
            //If passwords correct === area admin
            if(DB::checkPassword(($password === $userActual->getPassword()))) {

                $_SESSION['current_user'] = serialize($userActual);
                if( $role->getRoleById(1) || $role->getRoleByName('admin')) {
                    echo "Redirect to admin area";
                    header('Location: /View/admin/pageAdmin.php');
                }
            }
            else {
                DB::setMessage("Le mot de passe entré n'est pas correct", 'error');
            }
        }

        require './View/home.php';
    }
}
// Disconnect process.
elseif($_GET['page'] === 'logout') {
    $currentUser = null;
    $_SESSION = [];
    $userManager = new UserManager();
    $userManager->logOut($_SESSION['email'],$_SESSION['id']);
    header('Location: index.php');
}

// Else, then display user area.
else {
    require './View/user/profileUserPage.php';
}