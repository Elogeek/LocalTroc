<?php
/* @var UserProfile $userProfile */

use App\Entity\User;
use App\Entity\User\UserProfile;

$userProfile = $params['userProfile'];

?>

<div class="internal-container">
    <div class="profile-content form">
        <form action="/index.php?controller=user&action=editProfile" method="POST">
            <h1>Editer mon profil </h1>
            <hr>

            <div class="form-group">
                <div class="form-group-item">
                    <label for="pseudo">Votre pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" value="<?= $userProfile->getPseudo() ?>" required>
                </div>
                <div class="form-group-item">
                    <label for="birthday">Votre date de naissance</label>
                    <input type="date" name="birthday" id="birthday" value="<?= $userProfile->getBirthday() ?>" required>
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
            </div>

            <div class="form-group">
                <div>
                    <label for="other">Autres: diplômes, passions, hobbies, compétences, etc...</label>
                    <textarea name="other" id="other" rows="5"><?= $userProfile->getMoreInfos() ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-item">
                    <input type="submit" name="submit" value="Modifier">
                </div>
            </div>

        </form>
    </div>
</div>