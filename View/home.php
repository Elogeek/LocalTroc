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

/* First call to register */
if(!$connected) { ?>
    <section class="callToAction">
        <span>LocalTroc est 100% gratuit !</span>
        <span>Lancez - vous !</span><br>
        <a title="Inscription" class="btn" href="/index.php?controller=register">Inscription gratuite</a>
    </section> <?php
} ?>

<!-- Search form -->
<h2>Recherche de services</h2>

<div class="search">
    <form class="form-wrapper">
        <select name="" id="">
            <option value="">Par ville</option>
            <option value="">Par titre</option>
            <option value="">Par utilisateur</option>
        </select>
        <input type="text" id="search" placeholder="Recherche par ville" required>
        <input type="submit" value="go" id="submit">
    </form>
</div>

<section class="search-container">
    <!-- Search by country -->
    <div class="search">
        <label for="by-country">Par ville</label>
        <input type="text" name="by-country" id="by-country" class="no-margin">
        <input type="submit" class="btn btn-primary">
    </div>

    <!-- Search by title -->
    <div class="search">
        <label for="by-title">Par titre</label>
        <input type="text" name="by-title" id="by-title" class="no-margin">
        <input type="submit" class="btn btn-secondary">
    </div>

    <!-- Search by user -->
    <div class="search">
        <label for="by-user">Par utilisateur</label>
        <input type="text" name="by-user" id="by-user" class="no-margin">
        <input type="submit" class="btn btn-secondary">
    </div>
</section>

<?php
// Second call to register, Display register button only if user is not connected.
if(!$connected) { ?>
    <!-- Hidden on mobile version. -->
    <section class="callToAction mobile-hidden">
        <span>Envie d'essayer ?</span>
        <span>Devenir troqueur, troqueuse ? </span>
        <a title="Inscription" class="btn" href="/index.php?controller=register">Inscription gratuite</a>
    </section> <?php
}
?>

<!-- Last users added services -->
<h2>Nos derniers services</h2>
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
                        <?php
                        $description = $service->getDescription();
                        if(strlen($description) > 200) {
                            $description = substr($description, 0, 200) . '...';
                        }
                        echo $description;
                        ?>
                    </p>
                    <a title="Lire plus" class="btn btn-secondary" href="/index.php?controller=service&action=read&id=<?= $service->getId() ?>">
                        Lire plus
                    </a>
                </div>
            </div>

        </div> <?php
    }
    ?>
</div>
