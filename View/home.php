
<!--forcer l'user a évaluer le services de l'user comme vinted après chaque service ===  donner AVIS (*****)-->

    <div class="div1">
        <!--slider--->
        <div id="slider"></div>
    </div>


<h2>Qu'est-ce-que LocalTroc ?</h2>
<div class="div2">
    <div>
        <i class="fas fa-users"></i>
        <p class="div2Text">COMMUNAUTÉ</p>
    </div>
    <div>
        <i class="fas fa-map"></i>
            <p class="div2Text">LOCAL</p>
    </div>
    <div>
        <i class="fas fa-piggy-bank"></i>
            <p class="div2Text">GRATUIT</p>
    </div>
</div>

<?php
if(!$connected) { ?>
    <div id="div3">
        <div id="div3Text">
            <span>LocalTroc est 100% gratuit !</span>
            <span>Lancez - vous !</span><br>
            <a class="btn" href="/index.php?controller=user&action=register">Inscription gratuite</a>
        </div>
    </div><?php
} ?>



<div id="div4">
    <h2>Ma recherche rapide !</h2>
    <div id="search-bar">
        <input type="text" placeholder=" Où ?">
        <input type="text" placeholder=" Quand ?">
        <input type="text" placeholder=" Quoi ?">
        <button type="submit" name="header_search_submit" class="button-reset color-inherit db o-60 absolute center-v right-1 hover-primary6"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-search fa-w-16 fa-fw"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg></button>
        <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
    </div>
</div>

<!--articles diapo-->
<div class="diapo">
    <h2 id="titleDiapo">Besoin d'aide ? Rien à faire, envie de partager son temps, sa passion... </h2>

    <div class="elements">
        <!--one slide-->
        <div class="element active">
            <img src="/assets/img/déménagement.jpg" alt="img1">
            <div class="caption">
                <p>
                    Vous avez accumuler trop de chose ? Pas assez de place pour tout déménager ?
                    Rédiger une annonce sur LocalTroc.
                </p>
            </div>
        </div>

        <!--two slide-->
        <div class="element">
            <img src="/assets/img/cuisine.jpg" alt="img2">
            <div class="caption">
                <p>
                    Vous avez beaucoup de connaissances en cuisine ? Envie de partager des recettes ?
                    LocalTroc est fait pour vous.
                </p>
            </div>
        </div>
        <!--three slide-->
        <div class="element">
            <img src="/assets/img/couture.jpg" alt="img3">
            <div class="caption">
                <p>
                    Trop de connaissances en couture, envie de partager sa passion ? LocalTroc est fait pour vous.
                </p>
            </div>
        </div>

        <!--four slide-->
        <div class="element">
            <img src="/assets/img/massage.webp" alt="img4">
            <div class="caption">
                <p>
                    Trop nerveux, envie de relaxation, besoin d' améliorer ces compétences en massage? Trouver un troqueur/ une troqueuse.
                </p>
            </div>
        </div>
        <!--five slide-->
        <div class="element">
            <img src="/assets/img/travel.webp" alt="img5">
            <div class="caption">
                <p>
                    Envie de s'évader dans votre région, besoin de vacances? Venez sur LocalTroc.
                </p>
            </div>
        </div>

        <!--six slide-->
        <div class="element">
            <img src="/assets/img/makeUp.jpg" alt="img6">
            <div class="caption">
                <p>
                    Pas douée pour se maquiller seul? Où tout,simplement maquiller les enfants pour les grandes occasions? C'est sur LocalTroc.
                </p>
            </div>
        </div>

        <!--seven slide-->
        <div class="element">
            <img src="/assets/img/course.jpg" alt="img7">
            <div class="caption">
                <p>
                    Pas le temps de faire vos courses vous même? Vous chercher une personne de confiance pour les faire à votre place ?
                    Trouver un troqueur/ une troqueuse.
                </p>
            </div>
        </div>

        <!-- eight slide-->
        <div class="element">
            <img src="/assets/img/baby-sitter.jpg" alt="img8">
            <div class="caption">
                <p>
                    Besoin de faire garder vos enfants ? Envie de garder les enfants de vos voisins?
                    Pratiquer le troc.
                </p>
            </div>
        </div>

        <!-- nine slide-->
        <div class="element">
            <img src="/assets/img/jardinage.jpg" alt="img9">
            <div class="caption">
                <p>
                    Besoin d'aide en jardinerie? Trouver un troqueur/troqueuse.
                </p>
            </div>
        </div>

        <!-- ten slide-->
        <div class="element">
            <img src="/assets/img/dog-sitter.jpg" alt="img10">
            <div class="caption">
                <p>
                    Personne pour garder ou promener son chien ? Parcourir nos annonces.
                </p>
            </div>
        </div>

        <!-- eleven slide-->
        <div class="element">
            <img src="/assets/img/bricolage.jpg" alt="img11">
            <div class="caption">
                <p>
                    Vous êtes très bon bricoleur ? Vous chercher un bon bricoleur dans votre région ?
                    Pratiquer le troc.
                </p>
            </div>
        </div>

        <!-- twelve slide-->
        <div class="element">
            <img src="/assets/img/photographe.jpg" alt="img12">
            <div class="caption">
                <p>
                    Vous êtes bon photographe ? Vous chercher un bon photographe dans votre région? Venez sur LocalTroc.
                </p>
            </div>
        </div>

   </div>

    <!-- control navigation : arrows -->
    <i id="navLeft" class="las la-chevron-left"></i>
    <i id="navRight" class="las la-chevron-right"></i>

</div>

<!-- BARRE DE SATISFACTION-->
<div id="div5">
    <div id="happyBar">
        <div id="textHappy">
            <span>95%</span>
            <span>d'utilisateurs satisfaits</span>
            <div>
                <progress id="barHappy" max="100" value="85"></progress>
            </div>
        </div>
    </div>
</div>

<?php
// Discplay register button only if user is not connected.
if(!$connected) { ?>
    <div id="div6">
        <span>Envie d'essayer ? Devenir troqueur, troqueuse ? </span>
        <a class="btn" href="/index.php?controller=user&action=register">Inscription gratuite</a>
    </div> <?php
}
?>


<div id="div8">
    <div id="helpContact">
        <i class="far fa-envelope"></i>
    </div>
</div>
<!--OPTION  "helpContact" : messages automatiques besoin d'aide, un renseignement, parler avec les autres membres connecter par expl-->

<div id="div9">
    <!--Affiche près de chez soi, les derniers services create
  quand service terminée === hidden -->
    <div class="helpRectangle">
        <div class="imageRectangle"></div>
        <div class="subjectRectangle">
            <h2>Course</h2>
        </div>
        <div class="descriptionRectangle">
            <p>
                <span class="blue">Jack</span> a besoin d'aide pour faire ses courses  à <span class="gras"> Bourlers (6460) </span> <span class="timeService">aujourd'hui .</span>
            </p>
        </div>
    </div>

    <div class="helpRectangle" id="rect2">
        <div class="imageRectangle"></div>
        <div class="subjectRectangle">
            <h2>Course</h2>
        </div>
        <div class="descriptionRectangle">
            <p>
                <span class="blue">Jack</span> a besoin d'aide pour faire ses courses  à <span class="gras"> Bourlers (6460) </span> <span class="timeService">aujourd'hui .</span>
            </p>
        </div>
    </div>

    <div class="helpRectangle">
        <div class="imageRectangle"></div>
        <div class="subjectRectangle">
            <h2>Course</h2>
        </div>
        <div class="descriptionRectangle">
            <p>
                <span class="blue">Jack</span> a besoin d'aide pour faire ses courses  à <span class="gras"> Bourlers (6460) </span> <span class="timeService">aujourd'hui .</span>
            </p>
        </div>
    </div>
</div>



