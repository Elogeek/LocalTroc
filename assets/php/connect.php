<?php

use App\Entity\User;
use App\Manager\RoleManager;
use App\Model\Entity\UserManager;
use Model\DB;

require_once 'include.php';

$userManager = new User;
$user = $userManager;

// Getting current user if any.
if(isset($_SESSION['current_user'])) {
    $currentUser = unserialize($_SESSION['current_user']);
    if(RoleManager::isPower($currentUser) || RoleManager::isAdmin($currentUser)) {
        // Display the admin area
        header('location: ./View/admin/pageAdmin.php');
    }
}
else {
    $currentUser = new User();
}

if (isset($_GET['page'])) {
    // Admin area.
    if ($_GET['page'] === 'admin') {
        //If the connected user is admin or moderator then we can display the amdministration space.
        if ($currentUser->getId() && RoleManager::isPower($currentUser)) {
            require './View/admin/pageAdmin.php';
        } else {
            // Redirect to the home page if user is not admin or moderator.
            header('location: home.php');
        }
    }

    // Login process, after having provided login informations.
    elseif($_GET['page'] === 'login') {
        if(isset($_POST['email']) && isset($_POST['password'])) {
            $email = DB::secureData($_POST['email']);
            $password = DB::secureData($_POST['password']);

            if(!$currentUser->getId()) {
                DB::setMessage("Nous n'avons aucun utilisateur avec cet email", 'error');
            }
            else {
                if(DB::checkPassword(($password === $currentUser->getPassword()))) {
                    // Do something with logged in user.
                    $_SESSION['current_user'] = serialize($currentUser);
                    if(RoleManager::isPower($currentUser)) {
                        echo "Redirect to admin area";
                        header('Location: index.php?page=admin');
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
}
// Else, then display client area.
else {
    require './View/user/profileUserPage.php';
}