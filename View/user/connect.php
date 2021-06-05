
<div class="container">
    <div class="internal-container">
        <div class="profile-content form">
            <h1>Connexion</h1>
            <hr>
            <div class="login-form form">
                <form action="/index.php?controller=login" method="POST">
                   <div class="form-group">
                       <input type="email" id="email" name="email" placeholder="Adresse e-mail" required>
                   </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Mot de passe valide" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Connexion">
                    </div>
                </form>
                <p id="createAccount">Pas encore de compte ? <a title="Register" href="/index.php?controller=register">Créez en un</a>.</p>
            </div>
        </div>
    </div>
</div>