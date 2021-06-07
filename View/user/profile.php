<div class="internal-container">
    <!--image avatar user-->
    <div class="profile-content">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php' ?>

        <div class="profile-table">

            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/add-service-button.php' ?>

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
