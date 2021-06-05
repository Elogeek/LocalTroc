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
                    <!-- annonce : ok  pour photo-->
                    <a href="#" title="Editer une annonce"><i class="far fa-edit"></i> Rédiger une annonce</a>
                    <a href="#" title="Donner un service"><i class="far fa-handshake"></i>  Rendre un service</a>
                    <a href="#" title="Modifier"><i class="far fa-edit"></i> Modifier une annonce</a>
                    <a href="#" title="Supprimer une annonce"><i class="far fa-trash-alt"></i> Supprimer une annonce</a>

                </div>
            </div>

            <div class="menu">
                <p><i class="far fa-question-circle"></i> </p>
                <div class="submenu">
                    <a href="#" title="Règles du site"> Charte et règlement du site </a>
                </div>
            </div>

            <div><i class="fas fa-search"></i> Recherche rapide</div>
            <!--redirection big search bar(home) avec search le + proche (expl ta === tapis/table....)-->

            <?php
            // Si l'utilisateur est connecté, alors on affiche l'entrée de menu 'Mon profil'.
            if($connected) { ?>
                <div class="menu">
                    <p>
                        <i class="fas fa-user-astronaut"></i>
                        <a title="Mon profil" href="/index.php?controller=user&action=profile">Mon profil</a>
                    </p>
                    <div class="submenu">
                        <a href="#" title="Modifier mon profil"><i class="far fa-smile-beam"></i> Changer d'avatar</a>
                        <a href="#" title="Modifier mon profil"><i class="fas fa-at"></i> Changer d'adresse email</a>
                        <a href="#" title="Modifier mon profil"><i class="fas fa-phone"></i> Changer de numéro de téléphone</a>
                        <a href="#" title="Modifier mon profil"><i class="far fa-hand-point-right"></i> Changer de pseudo</a>
                        <a href="#" title="Supprimer mon compte"><i class="fas fa-user-times"></i>  Supprimer le compte</a>
                        <!-- option now/+later-->
                        <a href="#" title="Mes avis"><i class="far fa-edit"></i> Mes avis rédigées</a>
                    </div>

                </div> <?php
            } ?>

            <?php
            // Si l'utilisateur n'est pas connecté, alors on affiche le lien de connexion.
            if(!$connected) { ?>
                <div>
                    <a title="Connexion" href="/index.php?controller=login"> Se connecter</a>
                </div> <?php
            } else {
                // Si l'utilisateur est connecté, alors on peut afficher le bouton de déconnexion ?>
                <div>
                    <a title="Déconnexion" href="/index.php?controller=login&action=disconnect">
                        <i class="fas fa-power-off"></i>
                    </a>
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

