<?php
use App\Entity\UserService;
$service = $params['service'];
$userServiceProfile = $params['userProfile'];

$date = (DateTime::createFromFormat('Y-m-d H:i:s', $service->getServiceDate()));
$date = $date->format('d / m / y à H:i'); ?>

<section class="service-page">
    <h1><?= $service->getSubject() ?></h1>
    <hr>
    <div class="service-page-content">
        <!-- Service image -->
        <div class="service-page-left">
            <?php
            if($service->getImage() === null) {
                $serviceImage = '/assets/img/defaultImages/service.png';
            }
            else {
                $serviceImage = '/assets/uploads/services/' . $service->getImage();
            } ?>
            <img src="<?= $serviceImage ?>" alt="Service image">
        </div>

        <!-- Service user profile. -->
        <div class="service-page-right">
            <p class="service-line">Proposé par: <span><?= $userServiceProfile->getPseudo() ?></span></p>
            <p class="service-line">Mis en ligne le: <span><?= $date ?></span></p>
            <p class="service-line">Région: <span><?= $userServiceProfile->getCity() ?></span></p>
            <p class="service-line">Code postal: <span><?= $userServiceProfile->getCodeZip() ?></span></p>
            <div>
                <a class="btn btn-primary" href="">
                    <i class="fas fa-envelope"></i>&nbsp;Contacter
                </a>
            </div>
        </div>
    </div>

    <div class="service-page-description">
        <p>
            <?= $service->getDescription() ?>
        </p>
    </div>
</section>

<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . '/View/_partials/search.php';