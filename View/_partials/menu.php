<div class="container">
    <!--my menu-->
    <nav>

        <div id="logo">
            <a href="/index.php">
                <img  id="myLogo" src="/assets/img/logo.png" alt="logoSite">
            </a>
        </div>

        <div class="nav">
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
                <p><i class="far fa-question-circle"></i> </p>
                <div class="submenu">
                    <a href="#" title="item"> Informations légales</a>
                    <a href="#" title="item"> Où nous trouver?</a> <!-- bref intro du site  -->
                    <a href="#" title="item"> Protections des données utilisateurs</a>
                    <a href="#" title="item"> Rappel charte (règlement du site)</a> <!-- charte déjà signer leurs de l'envoi du code par mail -->
                </div>
            </div>

            <div><i class="fas fa-search"></i> Recherche rapide</div> <!--redirection big search bar avec search le + proche (expl ta === tapis/table....)-->

            <?php
            // Si l'utilisateur est connecté, alors on affiche l'entrée de menu 'Mon profil'.
            if($connected) { ?>
                <div class="menu">
                    <p>
                        <i class="fas fa-user-astronaut"></i>
                        <a href="/index.php?controller=user&action=profile">Mon profil</a>
                    </p>
                    <div class="submenu">
                        <a href="#" title="item"><i class="far fa-smile-beam"></i> Changer d'avatar</a>
                        <a href="#" title="item"><i class="fas fa-at"></i> Changer d'adresse email</a>
                        <a href="#" title="item"><i class="fas fa-phone"></i> Changer de numéro de téléphone</a>
                        <a href="#" title="item"><i class="far fa-hand-point-right"></i> Changer de pseudo</a>
                        <a href="#" title="item"><i class="fas fa-user-times"></i>  Supprimer le compte</a>
                        <a href="#" title="item"><i class="far fa-star"></i> Voir mes évaluations</a>
                        <!-- option now/+later-->
                        <a href="#" title="item"><i class="far fa-edit"></i> Mes avis rédigées</a>
                    </div>

                </div> <?php
            } ?>

            <?php
            // Si l'utilisateur n'est pas connecté, alors on affiche le lien de connexion.
            if(!$connected) { ?>
                <div>
                    <a title="Connexion" href="/index.php?controller=user&action=login"> Se connecter</a>
                </div> <?php
            } else {
                // Si l'utilisateur est connecté, alors on peut afficher le bouton de déconnexion ?>
                <div>
                    <i class="fas fa-power-off"></i>
                    <a title="Déconnexion" href="/index.php?controller=user&action=disconnect">Déconnexion</a>
                </div><?php
            }
            ?>
        </div>
    </nav>

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

