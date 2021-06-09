<div class="internal-container">
    <div class="profile-content">
        <form action="/index.php?controller=register" method="POST">
            <h1>Créer un compte </h1>
            <hr>

            <!-- first name and last name -->
            <div class="form-group">
                <div class="form-group-item">
                    <label for="firstname">Votre prénom</label>
                    <input type="text" name="fname" id="firstname" required>
                </div>
                <div class="form-group-item">
                    <label for="lastname">Votre nom</label>
                    <input type="text" name="lname" id="lastname" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-item">
                    <label for="pseudo">Votre pseudo</label>
                    <input type="text" name="pseudo" id="pseudo" required>
                </div>
                <div class="form-group-item">
                    <label for="birthday">Votre date de naissance</label>
                    <input type="date" name="birthday" id="birthday"
                           min="<?= (new DateTime())->modify('-110 years')->format('Y-m-d') ?>"
                           max="<?= (new DateTime())->modify('-10 years')->format('Y-m-d') ?>">
                </div>
            </div>

            <div class="form-group">
                <div>
                    <label for="address">Votre adresse complète</label>
                    <input name="address" id="address" type="text" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-item">
                    <label for="city">Votre ville</label>
                    <input name="city" id="city" type="text" required>
                </div>

                <div class="form-group-item">
                    <label for="zip">Code postal</label>
                    <input name="zip" id="zip" type="number" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-item">
                    <label for="phone">Votre numéro de téléphone, format national</label>
                    <input name="phone" id="phone" type="tel" placeholder="Téléphone">
                </div>

                <div class="form-group-item">
                    <label for="mail">Votre adresse mail</label>
                    <input name="mail" id="mail" type="email" placeholder="Adresse mail" required>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-item">
                    <label for="password">Votre mot de passe</label>
                    <input type="password" name="passwd" id="password" required>
                    <small class="form-control-info">Min 5 caractères, lettres, majuscules, chiffres </small>
                </div>

                <div class="form-group-item">
                    <label for="passwordConfirm">Confirmez votre mot de passe</label>
                    <input type="password" name="passwdConfirm" id="passwordConfirm" required>
                </div>

            </div>

            <div class="form-group">
                <div>
                    <label for="other">Autres: diplômes, passions, hobbies, compétences, etc...</label>
                    <textarea name="other" id="other" rows="5"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="cgu-confirm">
                    <input type="checkbox" id="confirm" name="confirm" value="0">
                    <p>
                        En m'enregistrant sur LocalTroc, je confirme avoir pris connaissance des
                        <a target="_blank" href="/index.php?controller=info&action=cgu" title="Conditions générales d'utilisation">
                            conditions générales d'utilisation
                        </a>
                        et de la <a target="_blank" href="/index.php?controller=info&action=confidentiality" title="Politique de confidentialité">
                            politique de confidentialité des données
                        </a>.
                    </p>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group-item">
                    <input class="btn btn-secondary" type="submit" name="submit" value="Créer mon compte">
                </div>
            </div>

        </form>
    </div>
</div>