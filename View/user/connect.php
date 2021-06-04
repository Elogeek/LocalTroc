
<div class="container">
    <h1>Connexion</h1>
    <hr>
    <div class="login-form form">
        <form action="/index.php?controller=user&action=login" method="POST">
           <div class="form-group">
               <input type="email" id="email" name="email" placeholder="Votre adresse e-mail" required>
           </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Veuillez entrer un mot de passe valide" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Connexion">
            </div>
        </form>
        <div>
            <p>Pas encore de compte ? <a title="Register" href="/index.php?controller=user&action=register">Créez en un</a>.</p>
        </div>
    </div>
</div>