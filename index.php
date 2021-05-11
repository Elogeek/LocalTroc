<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <script src="https://kit.fontawesome.com/e3ddf954eb.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>

<header>
    <!--forcer l'user a évaluer le services et l'user service comme vinted par expl après chaque service === AVIS (*****)-->
    <!--main menu-->
    <div class="nav-section">
        <img id="logo" src="/assets/img/logo.png" alt="logoSite">
        <div id="menuService"> Services
            <!--for catégorie-->
            <a href="#"  title="for category"> Paramètres services</a>
            <div id="nav_service">
                <a href="#" title="itemMenu"> Rédiger une annonce</a <!--ok photo-->
                <a href="#" title="itemMenu"> Rendre un service</a
                <a href="#" title="itemMenu"> Modifier une annonce</a
                <a href="#" title="itemMenu"> Supprimer une annonce</a
                <a href="#" title="itemMenu"> Signaler un service malveillant</a


            </div>
        </div>
        <div> A propros
            <div id="nav_about">
                <a href="#" title="itemMenu"> Informations légales</a
                <a href="#" title="itemMenu"> Où nous trouver?</a <!--bref intro du site-->
                <a href="#" title="itemMenu"> Ce site utilise des cookies</a
                <a href="#" title="itemMenu"> Protections des données utilisateurs</a
                <a href="#" title="itemMenu"> Rappel charte (réglements du site)</a <!--charte déjà signer leurs de l'envoie du code par mail-->
            </div>

        </div>
        <div>Recherche rapide</div> <!--redirection big search bar avec search le + proche (expl ta === tapis/table....)-->
        <div>Chat</div>
        <!--lorsque l'utilisateur fait une recherche service et trouve le bon, quand il clique sur une enveloppe message -->
        <div>Avis</div> <!--redirection bar statisfaction users-->
        <div>Partager</div> <!--redirection footer?-->
        <div>Se connecter
            <a href="#" title="spaceUser">Paramètres du compte</a>
            <div id="nav_spaceUser">
                <a href="#" title="itemMenu"> Changer d'avatar</a
                <a href="#" title="itemMenu"> Changer d'adresse email</a
                <a href="#" title="itemMenu"> Changer de numéro de téléphone</a
                <a href="#" title="itemMenu"> Changer de pseudo</a
                <a href="#" title="itemMenu"> Supprimer le compte</a
                <a href="#" title="itemMenu"> Voir mes évaluations</a
                <a href="#" title="itemMenu"> Recevoir mes étoiles</a <!--now/+later-->
                <a href="#" title="itemMenu"> Mes avis rédigées</a
                <a href="#" title="itemMenu"> Signaler un membre malveillant</a
            </div>

        </div>

    </div>
</header>

    <section>
        <div class="section1">
            <!--videoImg-->
            <div id="videoImg"></div>
        </div>
    </section>
<!--my image slide-->
    <h2>Qu'est-ce-que LocalTroc ?</h2>
    <div class="font">
        <i class="fas fa-users"></i>
        <i class="fas fa-comments"></i>
        <i class="fas fa-map"></i>
        <i class="fas fa-euro-sign"></i>
    </div>

    <div class="text">
        <div>Communauté</div>
        <div>Blog</div>
        <div>Local</div>
        <div>GRATUIT</div>
    </div>

   <div id="section2">
       <div id="brefText">
           <span>LocalTroc est 100% gratuit !</span><br>
           <span>Lancez - vous !</span><br>
           <button class="btn" type="button">Inscription gratuite</button>
       </div>
   </div>

    <!--frieze-->
    <div class="frieze"></div>

    <div id="section3">
        Ma recherche rapide !
         <div id="search-bar">
             <input type="text" placeholder=" Où ?">
             <input type="text" placeholder=" Quand ?">
             <input type="text" placeholder=" Quoi?">
                <button type="submit" name="header_search_submit" class="button-reset color-inherit db o-60 absolute center-v right-1 hover-primary6"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-fw"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg></button>
                <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
         </div>
    </div>

    <div id="section4">
      <span>Envie d'essayer ? Devenir troqueur, troqueuse ? </span>
      <button class="btn" type="button">Inscription gratuite</button>
    </div>

    <h2 id="titleArtc">Besoin d'aide ? Rien à faire, envie de partager son temps, sa passion... Sur LocalTroc, vous trouverez tout !</h2>

     <div id="articles">
         <div class="carousel__container">

              <div class="item">
                  <img class="imgArtcls" src="assets/img/jardinage.jpg" alt="jardin">
                  <div class="item__description">Besoin d'aide en jardinerie? Trouver un troqueur/troqueuse.</div>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/dog-sitter.jpg" alt="dog-sitter">
                  <div class="item__description">Personne pour garder ou promener son chien ? Parcourir nos annonces.</div>
              </div>

              <div class="item">
                  <img class="imgArtcls"  src="assets/img/couture.jpg" alt="couture">
                  <div class="item__description">
                      Trop de connaissances en couture, envie de partager sa passion ?
                      LocalTroc est fait pour vous .
                  </div>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/photographe.jpg" alt="photographe">
                  <div class="item__description">
                      Vous êtes bon photographe ? Vous chercher un bon photographe dans votre région?
                      Venez sur LocalTroc .
                  </div>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/course.jpg" alt="course">
                  <div class="item__description">
                      Pas le temps de faire vos courses vous même? Vous chercher une personne de confiance pour les faire à votre place ?
                      Trouver un troqueur/ une troqueuse .
                  </div>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/baby-sitter.jpg" alt="baby-sitter">
                  <div class="item__description">
                      Besoin de faire garder vos enfants ? Envie de garder les enfants de vos voisins?
                      Pratiquer le troc .
                  </div>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/déménagement.jpg" alt="demenagement">
                  <div class="item__description">
                      Vous avez accumuler trop de chose ? Pas assez de place pour tout déménager ?
                      Rédiger une annonce sur LocalTroc .
                  </div>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/cuisine.jpg" alt="cuisine">
                  <div class="item__description">
                      Vous avez beaucoup de connaissances en cuisine ? Envie de partager des recettes ?
                      LocalTroc est fait pour vous .
                  </span>
              </div>

              <div class="item">
                  <img class="imgArtcls" src="assets/img/bricolage.jpg" alt="bricolage">
                  <div class="item__description">
                      Vous êtes très bon bricoleur ? Vous chercher un bon bricoleur dans votre région ?
                      Pratiquer le troc .
                  </div>
              </div>
              <div>
                  <!--control carousel-->
                  <div class="carousel__next"></div>
                  <div class="carousel__prev"></div>
         </div>
     </div>
         <!-- BARRE DE SATISFACTION ET AVIS CLIENT HERE / bckgrd linear
            <img src="assets/img/expl.png" alt="expl">


    autre section ===> section5 ?
    si assez de temps, services près de chez soi sur une carte (style google maps)
     avec les services en minuscule (icône), quand service terminée === hidden -->

    <!--sous la carte ===> un onglet message qui serait le "helpContact" des users avec messages automatiques
    besoin d'aide, un renseignement, parler avec les autres menbres connecter par expl-->
    <div id="helpContact">
        <!--<i class="far fa-envelope"></i>-->
    </div>
<footer>

    <div class="titleShare">Nous rejoindre !</div>

    <!-- si le temps block "restons en conctact"===>newletter?-->
    <div class="share">
        <div>
            <i id="twitter" class="fab fa-twitter-square"></i>
        </div>

        <div>
            <i id="facebook" class="fab fa-facebook-square"></i>
        </div>

        <div>
            <i id="google" class="fab fa-google-plus-square"></i>
        </div>
        <div>
            <i id="insta" class="fab fa-instagram-square"></i>
        </div>
        <div>
            <i id="linkd" class="fab fa-linkedin"></i>
        </div>
        <div>
            <i id="printerest" class="fab fa-pinterest-square"></i>
        </div>

        <div id="span">
            By Elogeek
        </div>
    </div>

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/assets/js/app.js"></script>
</body>
</html>

