<div id="headerCarousel">
    <!--slider--->
    <div id="slider"></div>
</div>

<section>
    <h1 class="site-tite">Qu'est-ce-que LocalTroc ?</h1>
    <div class="site-description">
        <div>
            <i class="fas fa-users"></i>
            <p>communauté</p>
        </div>
        <div>
            <i class="fas fa-map"></i>
            <p>local</p>
        </div>
        <div>
            <i class="fas fa-piggy-bank"></i>
            <p>gratuit</p>
        </div>
    </div>
</section>

<?php
if(!$connected) { ?>
    <section class="callToAction">
        <span>LocalTroc est 100% gratuit !</span>
        <span>Lancez - vous !</span><br>
        <a class="btn" href="/index.php?controller=register">Inscription gratuite</a>
    </section> <?php
} ?>

<!--TODO mODIF  articles diapo-->
<div class="diapo">

    <div class="elements">
        <!-- first slide-->
        <div class="element active">
            <img src="/assets/img/carouselImg/déménagement.jpg" alt="img1">
            <div class="caption">
                <p>
                    Vous avez accumulé trop de chose ? Pas assez de place pour tout déménager ?
                    Rédiger une annonce sur LocalTroc.
                </p>
            </div>
        </div>
        <!--slide two -->
        <div class="element">
            <img src="/assets/img/carouselImg/cuisine.jpg" alt="img2">
            <div class="caption">
                <p>
                    Vous avez beaucoup de connaissances en cuisine ? Envie de partager des recettes ?
                    LocalTroc est fait pour vous.
                </p>
            </div>
        </div>
        <!--slide three-->
        <div class="element">
            <img src="/assets/img/carouselImg/couture.jpg" alt="img3">
            <div class="caption">
                <p>
                    Trop de connaissances en couture, envie de partager sa passion ? LocalTroc est fait pour vous.
                </p>
            </div>
        </div>
        <!--slide four -->
        <div class="element">
            <img src="/assets/img/carouselImg/travel.webp" alt="img5">
            <div class="caption">
                <p>
                    Envie de s'évader dans votre région, besoin de vacances? Venez sur LocalTroc.
                </p>
            </div>
        </div>
        <!--slide five -->
        <div class="element">
            <img src="/assets/img/carouselImg/baby-sitter.jpg" alt="img8">
            <div class="caption">
                <p>
                    Besoin de faire garder vos enfants ? Envie de garder les enfants de vos voisins?
                    Pratiquer le troc.
                </p>
            </div>
        </div>
        <!--slide six -->
        <div class="element">
            <img src="/assets/img/carouselImg/jardinage.jpg" alt="img9">
            <div class="caption">
                <p>
                    Besoin d'aide en jardinerie? Trouver un troqueur/troqueuse.
                </p>
            </div>
        </div>
        <!--slide Seven -->
        <div class="element">
            <img src="/assets/img/carouselImg/dog-sitter.jpg" alt="img10">
            <div class="caption">
                <p>
                    Personne pour garder ou promener son chien ? Parcourir nos annonces.
                </p>
            </div>
        </div>
        <!--slide eight-->
        <div class="element">
            <img src="/assets/img/carouselImg/bricolage.jpg" alt="img11">
            <div class="caption">
                <p>
                    Vous êtes très bon bricoleur ? Vous chercher un bon bricoleur dans votre région ?
                    Pratiquer le troc.
                </p>
            </div>
        </div>
        <!--slide nine-->
        <div class="element">
            <img src="/assets/img/carouselImg/photographe.jpg" alt="img12">
            <div class="caption">
                <p>
                    Vous êtes bon photographe ? Vous chercher un bon photographe dans votre région? Venez sur LocalTroc.
                </p>
            </div>
        </div>
   </div>

</div>



<?php
// Discplay register button only if user is not connected.
if(!$connected) { ?>
    <section class="callToAction">
        <span>Envie d'essayer ? Devenir troqueur, troqueuse ? </span>
        <a class="btn" href="/index.php?controller=register">Inscription gratuite</a>
    </section> <?php
}
?>


<div class="containerLastService">
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



