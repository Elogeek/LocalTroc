<?php
/* @var User $user */
/* @var UserProfile $userProfile */

use App\Entity\User;
use App\Entity\User\UserProfile;

$user = $params['user'];
$userProfile = $params['userProfile'];

?>

<a href="#" title="item"><i class="far fa-edit">Modifier mon profil</a>

    <div class="boxUser">
        <!--image avatar user-->
        <div class="imgAvatar">
            <img src="/assets/img/userProfile.webp" alt="MySuperProfil">
            <div class="pseudoUser">
                <!--pseudo-->
                <span> <?= $userProfile->getPseudo() ?></span>
            </div>
        </div>

        <!--info user : annif, pseudo,mail,phone,...-->
        <div class="infoDiv">
            <ul>
                <li>A propros </li>
                <hr>

                <li> Prénom : <?= $user->getFirstname() ?><li>

                <li> Nom : <?= $user->getLastName() ?></li>

                <li>
                    <!--email <i class="fas fa-at"></i>-->
                    Email : <?= $user->getEmail() ?>
                </li>

                <li>
                    <!--phone <i class="fas fa-phone"></i>-->
                    Phone : <?= $userProfile->getPhone()?>
                </li>

                <li>
                    Adresse : <?= $userProfile->getAddress()?>
                </li>

                <li>
                    <!--<i class="fas fa-map-marker-alt">-->
                        Ville: <?= $userProfile->getCity()?>

                </li>

                <li>
                    Code postal: <?= $userProfile->getCodeZip()?>
                </li>

                <li>
                    <!--brithday user <i class="fas fa-birthday-cake"></i>-->
                    Anniversaire : <?= $userProfile->getBirthday()?>
                </li>

                <li id="border">
                    <!--other-->
                    Autre :
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Précissez vos informations: diplômes, loisirs, lieu,..."></textarea>

                </li>
            </ul>

        </div>

    </div>
