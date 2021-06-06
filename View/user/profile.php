<?php
/* @var UserProfile $userProfile */

use App\Entity\User;
use App\Entity\User\UserProfile;

$userProfile = $params['userProfile'];

?>

<div class="internal-container">
    <!--image avatar user-->
    <div class="profile-content">
        <div class="imgAvatar">
            <?php
            if($userProfile->getAvatar() === null) { ?>
                <img src="/assets/img/userProfile.webp" alt="Mon profile"> <?php
            } else { ?>
                <img src="/assets/uploads/avatars/<?= $userProfile->getAvatar() ?>" alt="Mon profile"> <?php
            } ?>
            <span> <?= $userProfile->getPseudo() ?></span>

            <div class="user-profile-menu">
                <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/user-profile-menu.php' ?>
            </div>
        </div>

        <div class="profile-table">

            <!-- Edit buttons. -->
            <div id="profile-actions">
                <a href="/index.php?controller=user&action=editInformation" title="item" class="btn btn-primary">
                    <i class="far fa-edit"></i>Ajouter un service
                </a>
            </div>

            <h1>Mon profil </h1>
            <hr>

            <!-- User basic information. -->
            <h2>Vos informations de base</h2>
            <table class="profile-table">
                <tr>
                    <th>Nom</th>
                    <td><?= $user->getLastName() ?></td>
                </tr>
                <tr>
                    <th>Prénom</th>
                    <td><?= $user->getFirstName() ?></td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td><?= $user->getEmail() ?></td>
                </tr>
            </table>

            <!-- Profile information. -->
            <h2>Vos informations de profil</h2>
            <table class="profile-table">
                <tr>
                    <th>Pseudo</th>
                    <td><?= $userProfile->getPseudo() ?></td>
                </tr>
                <tr>
                    <th>Téléphone</th>
                    <td><?= $userProfile->getPhone() ?></td>
                </tr>
                <tr>
                    <th>Anniversaire</th>
                    <td><?= date('d / m / Y', strtotime($userProfile->getBirthday())) ?></td>
                </tr>
                <tr>
                    <th>Adresse</th>
                    <td><?= $userProfile->getAddress() ?></td>
                </tr>
                <tr>
                    <th>Code postal</th>
                    <td><?= $userProfile->getCodeZip() ?></td>
                </tr>
                <tr>
                    <th>Ville</th>
                    <td><?= $userProfile->getCity() ?></td>
                </tr>
                <tr>
                    <th>Informations complémentaires</th>
                    <td><?= $userProfile->getMoreInfos() ?></td>
                </tr>
            </table>
        </div>
    </div>

</div>
