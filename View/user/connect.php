
    <div class="container">
        <form action="/index.php?controller=user&action=login" method="POST">
           <div>
               <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required>
           </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Veuillez entrer un mot de passe valide" required>
            </div>
            <!--help-->
            <p>Le mot de de passe doit être plus grand que 5 caractères, avoir une lettre majuscule, une lettre minuscule, et un nombre . </p>

            <input type="submit" name="submit" value="Connexion">
        </form>
        <div>
            <p>Pas encore de compte ? <a title="Register" href="/index.php?controller=user&action=register">Créez en un</a>.</p>
        </div>
    </div>
