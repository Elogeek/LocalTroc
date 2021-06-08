<div class="internal-container">
    <div class="profile-content">

        <?php

        use App\Entity\UserService;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $services = $params['services'];
        ?>

        <div class="profile-table">
            <table class="admin-table">
                <thead>
                <tr>
                    <th class="mobile-hidden">ID</th>
                    <th class="mobile-hidden">Image</th>
                    <th class="mobile-hidden">User</th>
                    <th>Date</th>
                    <th>Sujet</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($services as $service) {
                    /* @var UserService $service */
                    $date = (DateTime::createFromFormat('Y-m-d H:i:s', $service->getServiceDate()));
                    $date = $date->format('d-m-y à H:i'); ?>
                    <tr>
                        <td class="mobile-hidden"><?= $service->getId() ?></td>
                        <td class="mobile-hidden">
                            <?php
                            if($service->getImage() === null) {
                                $imageSrc = '/assets/img/defaultImages/service.png';
                            }
                            else {
                                $imageSrc = '/assets/uploads/services/' . $service->getImage();
                            }
                            ?>
                            <img src="<?= $imageSrc ?>" alt="Service image">
                        </td>
                        <td class="mobile-hidden"><?= $service->getUser()->getId() ?></td>
                        <td><?= $date ?></td>
                        <td><?= $service->getSubject() ?></td>
                        <!-- User delete button. -->
                        <td>
                            <a class="admin-delete-service red" href="/index.php?controller=admin&action=service-delete&id=<?= $service->getId() ?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr><?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>