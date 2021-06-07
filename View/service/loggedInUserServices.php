<div class="internal-container">
    <div class="profile-content">

        <?php use App\Entity\UserService;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php' ?>

        <div class="profile-table">
            <h1>Mes services proposés</h1>
            <hr>
            <?php
            $services = $params['services'];
            foreach($services as $service) {
                /* @var UserService $service */ ?>
                <div class="user-service-profile">
                    <h2><?= $service->getSubject() ?></h2>
                    <div class="user-service-profile-content">
                        <div> <?php
                            if($service->getImage() !== null) { ?>
                                <img src="<?= '/assets/uploads/services/' . $service->getImage() ?>" alt="Image du service proposé"> <?php
                            }
                            // Load default image if no user service image was specified.
                            else { ?>
                                <img src="/assets/img/defaultImages/service.png" alt="Image du service proposé"> <?php
                            } ?>
                        </div>
                        <div>
                            <p class="user-service-date">
                                <?= $service->getServiceDate() ?>
                            </p>
                            <p><?= $service->getDescription() ?></p>
                        </div>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
