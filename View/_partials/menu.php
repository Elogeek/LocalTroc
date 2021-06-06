<div class="container">
    <!--my menu-->
    <nav>

        <div id="logo">
            <a href="/index.php"><img  id="myLogo" src="/assets/img/logo.png" alt="logoSite"></a>
        </div>

        <div class="menu"> <?php
            // Si l'utilisateur est connecté, alors on affiche l'entrée de menu 'Mon profil'.
            if($connected) { ?>
                <!-- Display My account link. -->
                <a id="userController" title="Mon profil" href="/index.php?controller=user&action=profile">
                    <i class="fas fa-user-astronaut"></i>Mon compte
                </a>
                <!-- Display logout link. -->
                <a id="loginController" title="Déconnexion" href="/index.php?controller=login&action=disconnect">
                    <i class="fas fa-power-off"></i>
                </a> <?php
            }
            else { ?>
                <!-- User not connected, display login link. -->
                <a id="loginController" title="Connexion" href="/index.php?controller=login">Se connecter</a> <?php
            } ?>

            <!-- Help and legal pages. -->
            <a id="helpController" href="#" title="Règles du site">
                <i class="far fa-question-circle"></i>
            </a>

        </div>

        <div class="mobile-menu">
            <i class="fas fa-bars"></i>
            <div class="mobile-menu-content"> <?php
                if($connected) { ?>
                    <a title="Mon profil" href="/index.php?controller=user&action=profile">Mon compte</a><hr>
                    <a title="Déconnexion" href="/index.php?controller=login&action=disconnect">Déconnection</a> <?php
                }
                else { ?>
                    <a title="Connexion" href="/index.php?controller=login">Se connecter</a> <?php
                } ?>

                <hr>
                <a id="helpController" href="#" title="Règles du site">A propos</a>
            </div>
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

