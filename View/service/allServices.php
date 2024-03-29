<?php
use App\Entity\UserService;
$services = $params['services'];

require_once  $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/search.php';
?>

<section class="container-last-services"><?php

if(isset($params['search-title'])) { ?>
    <h1>Résulat de recherche pour: <span><?= $params['search-title'] ?></span></h1>
    <hr><?php
}
else { ?>
    <h1>Tous les services</h1>
    <hr><?php
}

if(count($services) === 0) { ?>
    <p class="no-search-result">Votre recherche n'a donné aucun résultat<p> <?php
}

foreach($services as $service) {
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
    </div>
    <?php
} ?>

</section>
