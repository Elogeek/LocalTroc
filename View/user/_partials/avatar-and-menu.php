<?php
    use App\Entity\User;
    use App\Entity\User\UserProfile;
    $userProfile = $params['userProfile'];
?>

<!-- Template used to embed avatar AND menu -->
<div class="imgAvatar">
    <?php
    if($userProfile->getAvatar() === null) { ?>
        <img src="/assets/img/defaultImages/userProfile.webp" alt="Mon profile"> <?php
    } else { ?>
        <img src="/assets/uploads/avatars/<?= $userProfile->getAvatar() ?>" alt="Mon profile"> <?php
    } ?>
    <span> <?= $userProfile->getPseudo() ?></span>

    <?php
        // Checking if connected user is admin and display admin menu if so.
        if($user->getRole()->getName() === 'admin') {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/View/admin/_partials/admin-menu.php';
        }
    ?>
    <div class="user-profile-menu">
        <nav>
            <ul>
                <li>
                    <a href="/index.php?controller=service&action=user-services" title="Mes services">
                        <i class="fas fa-briefcase"></i>Mes services
                    </a>
                </li>

                <li>
                    <a href="/index.php?controller=user&action=profile" title="Mon profil">
                        <i class="fas fa-user-alt"></i>Mon profil
                    </a>
                </li>
                <li>
                    <a href="/index.php?controller=user&action=editProfile" title="Editer profil">
                        <i class="fas fa-user-edit"></i>Editer mon profil
                    </a>
                </li>
                <li>
                    <a href="/index.php?controller=user&action=editInformation" title="Editer mes informations">
                        <i class="fas fa-edit"></i>Editer mes informations
                    </a>
                </li>
                <li>
                    <a id="delete-user" href="/index.php?controller=user&action=delete" title="Editer mes informations">
                        <i class="fas fa-trash"></i>Supprimer mon compte
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>