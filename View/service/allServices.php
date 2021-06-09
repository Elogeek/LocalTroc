<?php
use App\Entity\UserService;
$services = $params['services']; ?>

<section class="container-last-services"><?php

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
