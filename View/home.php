<div id="headerCarousel">
    <!--slider--->
    <div id="slider"></div>
</div>

<section>
    <h1 class="site-tite">Qu'est-ce-que LocalTroc ?</h1>
    <div class="site-description">
        <div class="site-description-item">
            <i class="fas fa-users"></i>
            <p>communauté</p>
        </div>
        <div class="site-description-item">
            <i class="fas fa-map"></i>
            <p>local</p>
        </div>
        <div class="site-description-item">
            <i class="fas fa-piggy-bank"></i>
            <p>gratuit</p>
        </div>
    </div>
</section>

<?php

use App\Entity\UserService;

if(!$connected) { ?>
    <section class="callToAction">
        <span>LocalTroc est 100% gratuit !</span>
        <span>Lancez - vous !</span><br>
        <a class="btn" href="/index.php?controller=register">Inscription gratuite</a>
    </section> <?php
} ?>


<?php
// Display register button only if user is not connected.
if(!$connected) { ?>
    <!-- Hidden on mobile version. -->
    <section class="callToAction mobile-hidden">
        <span>Envie d'essayer ?</span>
        <span>Devenir troqueur, troqueuse ? </span>
        <a class="btn" href="/index.php?controller=register">Inscription gratuite</a>
    </section> <?php
}
?>

<!-- Last users added services -->
<div class="container-last-services">
    <?php
    $lastServices = $params['services'];
    foreach($lastServices as $service) {
        /* @var UserService $service */
        $date = (DateTime::createFromFormat('Y-m-d H:i:s', $service->getServiceDate()));
        $date = $date->format('d / m / y à H:i'); ?>
        <div class="last-service">

            <div class="service-detail">
                <h2><?= $service->getSubject() ?></h2>
                <span><?= $date ?></span>
                <hr>
            </div>

            <div class="service-description">
                <div class="service-image"> <?php
                    if($service->getImage() === null) {
                        $imageSrc = '/assets/img/defaultImages/service.png';
                    }
                    else {
                        $imageSrc = '/assets/uploads/services/' . $service->getImage();
                    } ?>
                    <img src="<?= $imageSrc ?>" alt="Service image">
                </div>

                <div class="service-description-content">
                    <p>
                        <?= wordwrap($service->getDescription(), 150) ?>
                    </p>
                    <a class="btn btn-secondary" href="">Lire plus</a>
                </div>
            </div>

        </div> <?php
    }
    ?>
</div>
