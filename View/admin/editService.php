<div class="internal-container">
    <div class="profile-content">

        <?php

        use App\Entity\UserService;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $service = $params['service'];
        /* @var UserService $service */
        ?>

        <div class="profile-table">
            <h1>Ajouter un service</h1>
            <hr>

            <form action="/index.php?controller=admin&action=service-edit&id=<?= $service->getId() ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div>
                        <label for="subject">Titre</label>
                        <input type="text" name="subject" id="subject" value="<?= $service->getSubject() ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <label for="serviceImage">Image du service</label>
                        <input type="file" name="serviceImage" id="serviceImage" accept="image/png, image/jpeg">
                        <small class="form-control-info">Optionnel</small>
                    </div>
                </div>

                <div class="form-group">
                    <div>
                        <label for="descriptionService">Description du service</label>
                        <textarea name="descriptionService" id="descriptionService" cols="70" rows="12" required><?= $service->getDescription() ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group-item">
                        <input class="btn btn-secondary" type="submit" name="submit" value="Sauvegarder">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>