<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/e3ddf954eb.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Document</title>
</head>
<div class="container">
    <!--my menu-->
    <div class="nav">

        <div id="logo"><img  id="myLogo" src="/assets/img/logo.png" alt="logoSite"></div>

        <div class="menu">
            <p><i class="far fa-handshake"></i> Services</p>
            <div class="submenu">
                <a href="#"  title="item"><i class="fas fa-cog"></i> Paramètres services</a>
                <a href="#" title="item"><i class="far fa-edit"></i> Rédiger une annonce</a> <!--ok photo-->
                <a href="#" title="item"><i class="far fa-handshake"></i>  Rendre un service</a>
                <a href="#" title="item"><i class="far fa-edit"></i> Modifier une annonce</a>
                <a href="#" title="item"><i class="far fa-trash-alt"></i> Supprimer une annonce</a>
                <a href="#" title="item"><i class="fas fa-ban"></i> Signaler un service malveillant</a>
            </div>
        </div>

        <div class="menu">
            <p><i class="far fa-question-circle"></i> A propos</p>
            <div class="submenu">
                <a href="#" title="item"> Informations légales</a>
                <a href="#" title="item"> Où nous trouver?</a> <!-- bref intro du site  -->
                <a href="#" title="item"> Protections des données utilisateurs</a>
                <a href="#" title="item"> Rappel charte (règlement du site)</a> <!-- charte déjà signer leurs de l'envoi du code par mail -->
            </div>
        </div>

        <div><i class="fas fa-search"></i> Recherche rapide</div> <!--redirection big search bar avec search le + proche (expl ta === tapis/table....)-->

        <div class="menu">
            <p><i class="fas fa-user-astronaut"></i> Mon compte</p>
            <div class="submenu">
                <a href="#" title="item"><i class="fas fa-user-astronaut"></i> Mon profil</a>
                <a href="#" title="item"><i class="fas fa-user-cog"></i> Paramètres du compte</a>
                <a href="#" title="item"><i class="far fa-smile-beam"></i> Changer d'avatar</a>
                <a href="#" title="item"><i class="fas fa-at"></i> Changer d'adresse email</a>
                <a href="#" title="item"><i class="fas fa-phone"></i> Changer de numéro de téléphone</a>
                <a href="#" title="item"><i class="far fa-hand-point-right"></i> Changer de pseudo</a>
                <a href="#" title="item"><i class="fas fa-user-times"></i>  Supprimer le compte</a>
                <a href="#" title="item"><i class="far fa-star"></i> Voir mes évaluations</a>
                <!-- option now/+later-->
                <a href="#" title="item"><i class="far fa-grin-stars"></i> Recevoir mes étoiles</a>
                <a href="#" title="item"><i class="far fa-edit"></i> Mes avis rédigées</a>
                <a href="#" title="item"> <i class="fas fa-user-slash"></i> Signaler un membre malveillant</a>
            </div>

        </div>
        <div><p> <i class="fas fa-power-off"></i> Déconnection </p></div>

    </div>

    <div class="containerMessage">
        <form action="" method="get">
            <div><span>A <?php $_SESSION['$email']?></span></div>
            <hr>
            <label for="textContent"></label>
            <textarea name="textContent" id="textContent" cols="65" rows="10" placeholder=" Tapez votre message"></textarea>
            <div><span> De  <?php $_SESSION['$email']?> </span></div>
            <button type="submit" value="Envoyer">Envoyer</button>
        </form>
    </div>