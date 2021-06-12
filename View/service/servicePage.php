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
            <div id="message-button"> <?php
                if($connected) { ?>
                    <a class="btn btn-primary" href="#message">
                        <i class="fas fa-envelope"></i>&nbsp;Contacter
                    </a> <?php
                } ?>
            </div>
        </div>
    </div>

    <div class="service-page-description">
        <p>
            <?= $service->getDescription() ?>
        </p>
    </div>
</section>

<section class="service-page">
        <h1>Envoyer un message</h1>
        <hr> <?php
        if($connected) { ?>
            <form action="/index.php?controller=service&action=message" method="POST">
                <div class="form-group">
                    <div>
                        <label for="descriptionService">Votre message</label>
                        <textarea name="message" id="message" cols="70" rows="12" required></textarea>

                        <input type="hidden" name="service-id" value="<?= $service->getId() ?>">
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <input class="btn btn-secondary" type="submit" name="submit" value="Envoyer">
                    </div>
                </div>
            </form>
        <?php
        }
        else { ?>
            <p class="text-center bold">Vous devez être connecté pour envoyer un message<p> <?php
        }
        ?>
</section>