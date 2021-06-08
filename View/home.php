

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
            <a class="btn" href="/index.php?controller=register">Inscription gratuite</a>
        </div>
    </div><?php
} ?>

<!--articles diapo-->
<div class="diapo">
    <h2 id="titleDiapo">Besoin d'aide ? Rien à faire, envie de partager son temps, sa passion... </h2>

    <div class="elements">
        <!--one slide-->
        <div class="element active">
            <img src="/assets/img/carouselImg/déménagement.jpg" alt="img1">
            <div class="caption">
                <p>
                    Vous avez accumuler trop de chose ? Pas assez de place pour tout déménager ?
                    Rédiger une annonce sur LocalTroc.
                </p>
            </div>
        </div>

        <!--two slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/cuisine.jpg" alt="img2">
            <div class="caption">
                <p>
                    Vous avez beaucoup de connaissances en cuisine ? Envie de partager des recettes ?
                    LocalTroc est fait pour vous.
                </p>
            </div>
        </div>
        <!--three slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/couture.jpg" alt="img3">
            <div class="caption">
                <p>
                    Trop de connaissances en couture, envie de partager sa passion ? LocalTroc est fait pour vous.
                </p>
            </div>
        </div>

        <!--four slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/massage.webp" alt="img4">
            <div class="caption">
                <p>
                    Trop nerveux, envie de relaxation, besoin d' améliorer ces compétences en massage? Trouver un troqueur/ une troqueuse.
                </p>
            </div>
        </div>
        <!--five slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/travel.webp" alt="img5">
            <div class="caption">
                <p>
                    Envie de s'évader dans votre région, besoin de vacances? Venez sur LocalTroc.
                </p>
            </div>
        </div>

        <!--six slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/makeUp.jpg" alt="img6">
            <div class="caption">
                <p>
                    Pas douée pour se maquiller seul? Où tout,simplement maquiller les enfants pour les grandes occasions? C'est sur LocalTroc.
                </p>
            </div>
        </div>

        <!--seven slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/course.jpg" alt="img7">
            <div class="caption">
                <p>
                    Pas le temps de faire vos courses vous même? Vous chercher une personne de confiance pour les faire à votre place ?
                    Trouver un troqueur/ une troqueuse.
                </p>
            </div>
        </div>

        <!-- eight slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/baby-sitter.jpg" alt="img8">
            <div class="caption">
                <p>
                    Besoin de faire garder vos enfants ? Envie de garder les enfants de vos voisins?
                    Pratiquer le troc.
                </p>
            </div>
        </div>

        <!-- nine slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/jardinage.jpg" alt="img9">
            <div class="caption">
                <p>
                    Besoin d'aide en jardinerie? Trouver un troqueur/troqueuse.
                </p>
            </div>
        </div>

        <!-- ten slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/dog-sitter.jpg" alt="img10">
            <div class="caption">
                <p>
                    Personne pour garder ou promener son chien ? Parcourir nos annonces.
                </p>
            </div>
        </div>

        <!-- eleven slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/bricolage.jpg" alt="img11">
            <div class="caption">
                <p>
                    Vous êtes très bon bricoleur ? Vous chercher un bon bricoleur dans votre région ?
                    Pratiquer le troc.
                </p>
            </div>
        </div>

        <!-- twelve slide-->
        <div class="element">
            <img src="/assets/img/carouselImg/photographe.jpg" alt="img12">
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
        <a class="btn" href="/index.php?controller=register">Inscription gratuite</a>
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
    <div class="lastSerivces">
        <div class="imageRectangle"></div> <!--soit linux où avatar de l' user qui créer le service-->
        <div class="subjectServices">
            <h2>Course</h2>
            <span>Paru le date here</span>
            <hr>
        </div>
        <div class="descriptionServices">
            <p>
                <span>John</span> a besoin d'aide pour faire ses courses  à <span> Bourlers (6460) . </span>
            </p>
        </div>
    </div>

    <div class="lastSerivces">
        <div class="imageRectangle"></div> <!--soit linux où avatar de l' user qui créer le service-->
        <div class="subjectServices">
            <h2>Course</h2>
            <span>Paru le date here</span>
            <hr>
        </div>
        <div class="descriptionServices">
            <p>
                <span>John</span> a besoin d'aide pour faire ses courses  à <span> Bourlers (6460) . </span>
            </p>
        </div>
    </div>

    <div class="lastSerivces">
        <div class="imageRectangle"></div> <!--soit linux où avatar de l' user qui créer le service-->
        <div class="subjectServices">
            <h2>Course</h2>
            <span>Paru le date here</span>
            <hr>
        </div>
        <div class="descriptionServices">
            <p>
                <span>John</span> a besoin d'aide pour faire ses courses  à <span> Bourlers (6460) . </span>
            </p>
        </div>
    </div>
</div>



