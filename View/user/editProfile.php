<div class="internal-container">
    <div class="profile-content">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php' ?>

        <div class="profile-table">
            <form action="/index.php?controller=user&action=editProfile" method="POST" enctype="multipart/form-data">
                <h1>Editer mon profil </h1>
                <hr>

                <div class="form-group">
                    <div class="form-group-item">
                        <label for="pseudo">Votre pseudo</label>
                        <input type="text" name="pseudo" id="pseudo" value="<?= $userProfile->getPseudo() ?>" required>
                    </div>
                    <div class="form-group-item">
                        <label for="birthday">Votre date de naissance</label>
                        <input type="date" name="birthday" id="birthday"
                               min="<?= (new DateTime())->modify('-110 years')->format('Y-m-d') ?>"
                               max="<?= (new DateTime())->modify('-10 years')->format('Y-m-d') ?>"
                               value="<?= date('Y-m-d', strtotime($userProfile->getBirthday())) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="address">Votre adresse complète</label>
                        <input name="address" id="address" type="text" value="<?= $userProfile->getAddress() ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <label for="city">Votre ville</label>
                        <input name="city" id="city" type="text" value="<?= $userProfile->getCity() ?>" required>
                    </div>

                    <div class="form-group-item">
                        <label for="codeZip">Code postal</label>
                        <input name="codeZip" id="codeZip" type="number" value="<?= $userProfile->getCodeZip() ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <label for="phone">Votre numéro de téléphone</label>
                        <input name="phone" id="phone" type="tel" value="<?= $userProfile->getPhone() ?>">
                    </div>
                    <div class="form-group-item">
                        <label for="avatar">Votre avatar ( JPG / PNG )</label>
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
                        <input class="btn btn-secondary" type="submit" name="submit" value="Modifier">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>