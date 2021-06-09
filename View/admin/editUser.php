<div class="internal-container">
    <div class="profile-content">

        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $user = $params['user'];
        $userProfile = $params['userProfile'];
        ?>

        <div class="profile-table">

            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/add-service-button.php' ?>

            <form action="/index.php?controller=admin&action=user-edit&id=<?= $user->getId() ?>" method="POST" enctype="multipart/form-data">
                <h1>Editer l'utilisateur <?= $userProfile->getPseudo() ?></h1>
                <hr>

                <!-- first name and last name -->
                <div class="form-group">
                    <div class="form-group-item">
                        <label for="firstname">Prénom</label>
                        <input type="text" name="firstname" id="firstname" value="<?= $user->getFirstname() ?>" required>
                    </div>
                    <div class="form-group-item">
                        <label for="lastname">Nom</label>
                        <input type="text" name="lastname" id="lastname" value="<?= $user->getLastName() ?>" required>
                    </div>
                </div>

                <!-- User info connect -->
                <div class="form-group">
                    <div>
                        <label for="mail">Adresse mail</label>
                        <input name="mail" id="mail" type="email" value="<?= $user->getEmail() ?>" required>
                    </div>
                </div>

                <p class="form-control-info">Si vous souhaitez changer de mot de passe</p>
                <div class="form-group">
                    <div class="form-group-item">
                        <input type="password" name="password" id="password" placeholder="Mot de passe">
                        <small class="form-control-info">Min 5 caractères, lettres, majuscule, chiffres</small>
                    </div>
                    <div class="form-group-item">
                        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Répétez le mot de passe">
                    </div>
                </div>

                <!-- Profile informations -->
                <div class="form-group">
                    <div class="form-group-item">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" value="<?= $userProfile->getPseudo() ?>" required>
                    </div>
                    <div class="form-group-item">
                        <label for="birthday">Date de naissance</label>
                        <input type="date" name="birthday" id="birthday"
                               min="<?= (new DateTime())->modify('-110 years')->format('Y-m-d') ?>"
                               max="<?= (new DateTime())->modify('-10 years')->format('Y-m-d') ?>"
                               value="<?= date('Y-m-d', strtotime($userProfile->getBirthday())) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="address">Adresse complète</label>
                        <input name="address" id="address" type="text" value="<?= $userProfile->getAddress() ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <label for="city">Ville</label>
                        <input name="city" id="city" type="text" value="<?= $userProfile->getCity() ?>" required>
                    </div>

                    <div class="form-group-item">
                        <label for="codeZip">Code postal</label>
                        <input name="codeZip" id="codeZip" type="number" value="<?= $userProfile->getCodeZip() ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <label for="phone">Numéro de téléphone</label>
                        <input name="phone" id="phone" type="tel" value="<?= $userProfile->getPhone() ?>">
                    </div>
                    <div class="form-group-item">
                        <label for="avatar">Avatar ( JPG / PNG )</label>
                        <input name="avatar" id="avatar" type="file" accept="image/png, image/jpeg">
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="other">Autres: diplômes, passions, hobbies, compétences, etc...</label>
                        <textarea name="other" id="other" rows="5"><?= $userProfile->getMoreInfos() ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <input class="btn btn-secondary" type="submit" name="submit" value="Sauvegarder">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>