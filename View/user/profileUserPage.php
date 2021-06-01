<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/e3ddf954eb.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/style.css">
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
                <a href="#" title="item"> Où nous trouver?</a>
                <a href="#" title="item"> Protections des données utilisateurs</a>
                <a href="#" title="item"> Rappel charte (règlement du site)</a>
            </div>
        </div>

        <div><i class="fas fa-search"></i> Recherche rapide</div>

        <div class="menu">
            <p><i class="fas fa-user-astronaut"></i> Mon compte</p>
            <div class="submenu">
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


    <div class="boxUser">
        <!--image avatar user-->
        <div class="imgAvatar">
            <img src="/assets/img/userProfile.webp" alt="MySuperProfil">
            <div class="pseudoUser">
                <!--pseudo-->
                <span> Jhon </span>
            </div>
        </div>

        <!--info user : annif, pseudo,mail,phone,...-->
        <div class="infoDiv">
            <ul>
                <li>A propros </li>
                <hr>

                <li> Pseudo : JOHN

                <li>
                    <!--email <i class="fas fa-at"></i>-->
                    Email :
                </li>
                <li>
                    <!--phone <i class="fas fa-phone"></i>-->
                    Phone :
                </li>
                <li>
                    <!--city <i class="fas fa-map-marker-alt"></i>-->
                    City:
                </li>
                <li>
                    <!--brithday user <i class="fas fa-birthday-cake"></i>-->
                    Brithday :
                </li>
                <!--here eval service user-->
                <li>
                    Evaluations : /5
                    <div>
                        <!--here star-->
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <div>
                        <!--avis other user for a service-->
                        Voir les avis
                    </div>
                </li>
                <li id="border">
                    <!--other-->
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Précissez vos informations: diplômes, loisirs, lieu,..."></textarea>
                    <!--school <i class="fas fa-graduation-cap"></i> -->
                    Other :

                </li>
            </ul>

        </div>

    </div>
