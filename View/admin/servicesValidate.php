<div class="internal-container">
    <div class="profile-content">

        <?php

        use App\Entity\UserService;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $services = $params['services'];
        ?>
        <p>

        </p>
        <div class="profile-table">
            <h1>Services non validés</h1>
            <hr>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="mobile-hidden">ID</th>
                        <th class="mobile-hidden">User</th>
                        <th>Sujet</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($services as $service) { ?>
                    <tr>
                        <td class="mobile-hidden"><?= $service->getId() ?></td>
                        <td class="mobile-hidden"><?= $service->getUser()->getId() ?></td>
                        <td><?= $service->getSubject() ?></td>

                        <!-- Service validation button. -->
                        <td>
                            <a class="red" href="/index.php?controller=admin&action=validate&id=<?= $service->getId() ?>">
                                <i class="fas fa-check-square"></i>
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