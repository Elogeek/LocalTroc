<?php
if(isset($error)) { ?>
    <div class="error">
        <?= $error ?>
    </div><?php
}

if(isset($success)) { ?>
    <div class="success">
    <?= $success ?>
    </div><?php
}

?>
<!-- Create user account -->
<div>
    <form action="/index.php?controller=user&action=register" method="POST">
        <h4>Créer un compte client</h4>

        <!-- first name and last name -->
        <input type="text" name="firstname" id="firstname" placeholder="Prénom" required>
        <div class="invalid-feedback">Veuillez entrer un prénom valide</div>

        <input type="text" name="lastname" id="lastname" placeholder="Nom" required>
        <div class="invalid-feedback">Veuillez entrer un nom valide</div>

        <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" required>
        <div class="invalid-feedback">Veuillez entrer votre pseudo</div>

        <!-- User infos. -->
        <input type="file" name="avatar" placeholder="Choissisez une image comme avatar">

        <input type="date" name="birthday" required>

        <input name="city" type="text" placeholder="Ville" required>
        <div class="invalid-feedback">Veuillez entrer une ville valide</div>

        <input name="address" type="text" placeholder="Adresse" required>
        <div class="invalid-feedback">Veuillez entrer une adresse valide</div>

        <input name="codeZip" type="number" placeholder="Code postal" required>
        <div class="invalid-feedback">Veuillez entrer un code postal valide</div>

        <input name="country" type="text" placeholder="Pays" required>
        <div class="invalid-feedback">Veuillez entrer un pays valide</div>

        <input name="other" type="text" placeholder="Autre : diplôme, passions, compétences,...">

        <input name="phone" type="tel" placeholder="Téléphone">
        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format: +33...</div>


        <!-- User info connect -->
        <input name="mail" type="email" placeholder="Adresse mail" required>
        <div class="invalid-feedback">Veuillez entrer une adresse mail valide</div>

        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <small>Plus grand que 5 caractères, lettres, majuscules, chiffres et caractères spéciaux</small>
        <div class="invalid-feedback">Veuillez entrer un mot de passe valide</div>

        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Répétez le mot de passe" required>
        <div class="invalid-feedback">Les deux mots de passe ne correspondent pas</div>

        <input type="submit" name="submit" value="Créer mon compte">
    </form>

</div>