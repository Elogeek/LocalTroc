<?php
/* @var User $user */
/* @var UserProfile $userProfile */

use App\Entity\User;
use App\Entity\User\UserProfile;

$userProfile = $params['userProfile'];

?>

<div class="profile-container">
    <!-- Edit buttons. -->
    <div id="profile-actions">
        <a href="#" title="item" class="btn btn-primary"><i class="far fa-edit"></i>Editer mes données</a>
        <a href="#" title="item" class="btn btn-primary"><i class="far fa-edit"></i>Editer mon profil</a>
    </div>

    <!--image avatar user-->
    <div id="profile-content">
        <div class="imgAvatar">
            <img src="/assets/img/userProfile.webp" alt="Mon profile">
            <div class="pseudoUser">
                <!--pseudo-->
                <span> <?= $userProfile->getPseudo() ?></span>
            </div>
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
        <h2>Vos informations de profile</h2>
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
                <td><?= $userProfile->getBirthday() ?></td>
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
