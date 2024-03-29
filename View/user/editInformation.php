

<div class="internal-container">
    <div class="profile-content">

        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php' ?>

        <div class="profile-table">

            <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/add-service-button.php' ?>

            <form action="/index.php?controller=user&action=editInformation" method="POST">
                <h1>Editer mon compte </h1>
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

                <div class="form-group">
                    <div class="form-group-item">
                        <input class="btn btn-secondary" type="submit" name="submit" value="Sauvegarder">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>