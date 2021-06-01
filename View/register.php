
<div class="background">
    <div class="container">

        <?php
        if($_GET['success'] && intval($_GET['success']) === 1) {
            ?> <div class="success">Le compte a bien été cré, merci !</div> <?php
            }
         ?>

        <form action="register.php" method="post">
           <div>
               <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required="required">
           </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Veuillez entrer un mot de passe valide" required="required">
            </div>
            <div>
                <input type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Password repeat" required="required">
            </div>
            <!--help-->
            <p>Le mot de de passe doit être plus grand que 5 caractères, avoir une lettre majuscule, une lettre minuscule, un caractère spécial et un nombre</p>

            <button type="submit">Connexion</button>
        </form>
    </div>
</div>

<!--create compte user placer dans le footer-->
<div id="createAccountModal">
    <form action="">
        <div class="form-title text-center">
            <h4>Créer un compte client</h4>
        </div>

        <!-- first name and last name -->
        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom" required>
        <div class="invalid-feedback">Veuillez entrer un prénom valide</div>

        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Nom" required>
        <div class="invalid-feedback">Veuillez entrer un nom valide</div>

        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" required>
        <div class="invalid-feedback">Veuillez entrer un pseudo valide, où votre prénom </div>

        <!-- User infos. -->
        <input type="file" name="avatar" placeholder="Choissisez une image comme avatar">

        <input type="date" name="birthday" required>

        <input name="city" type="text" placeholder="city" required>
        <div class="invalid-feedback">Veuillez entrer une ville valide</div>

        <input name="address" type="text" placeholder="address" required>
        <div class="invalid-feedback">Veuillez entrer une adresse valide</div>

        <input name="codeZip" type="number" placeholder="code postal" required>
        <div class="invalid-feedback">Veuillez entrer un code postal valide</div>

        <input name="country" type="text" placeholder="pays" required>
        <div class="invalid-feedback">Veuillez entrer un pays valide</div>

        <input name="other" type="text" placeholder="autre : diplôme, passions,compétences,..." required>

        <input name="phone" type="tel" class="form-control" placeholder="Téléphone">
        <div class="invalid-feedback">Veuillez entrer un numéro de téléphone valide au format: +33...</div>


        <!-- User info connect -->
        <input name="mail" type="email" placeholder="Adresse mail" required>
        <div class="invalid-feedback">Veuillez entrer une adresse mail valide</div>

        <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required>
        <p>Plus grand que 5 caractères, lettres, majuscules et chiffres et caractères spéciaux</p>
        <div class="invalid-feedback">Veuillez entrer un mot de passe valide</div>

        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Répétez le mot de passe" required>
        <div class="invalid-feedback">Les deux mots de passe ne correspondent pas</div>

        <button type="submit" class="btn btn-secondary btn-block mt-4">Créer mon compte</button>
    </form>

</div>