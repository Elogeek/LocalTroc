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
                $date = (DateTime::createFromFormat('Y-m-d H:i:s', $service->getServiceDate()));
                $date = $date->format('d / m / Y à H:i:s');
                /* @var UserService $service */ ?>
                <div class="user-service-profile">
                    <h2>
                        <?= $service->getSubject() ?>
                        <p><span>Ajouté le:</span> <?= $date ?></p>
                    </h2>
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
                            <p><?= stripslashes($service->getDescription()) ?></p>
                        </div>
                    </div>
                    <div class="services-user-actions">
                        <?php
                        $id = $service->getId();
                        ?>
                        <a class="btn btn-primary" href="/index.php?controller=service&action=edit&id=<?= $id ?>" title="Editer mon annonce">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-secondary" href="/index.php?controller=service&action=user-service-delete&id=<?= $id ?>" title="Supprimer mon annonce">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            <?php
            } ?>
        </div>
    </div>
</div>
