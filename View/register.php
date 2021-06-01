
<div class="background">
    <div class="container">

        <?php
        if($_GET['success'] && intval($_GET['success']) === 1 {
            ?> <div class="success">Le compte a bien été cré, merci !</div><?php
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