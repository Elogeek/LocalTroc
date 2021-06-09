

<div class="internal-container">
    <div class="profile-content">

        <?php

        use App\Entity\User;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $users = $params['users'];
        ?>

        <div class="profile-table">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th class="mobile-hidden">ID</th>
                        <th class="mobile-hidden">Role</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Mail</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $user) {
                    /* @var User $user */ ?>
                    <tr>
                        <td class="mobile-hidden"><?= $user->getId() ?></td>
                        <td class="mobile-hidden"><?= $user->getRole()->getName() ?></td>
                        <td><?= $user->getFirstname() ?></td>
                        <td><?= $user->getLastName() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <!-- User edition button -->
                        <td>
                            <a class="admin-edit-user green" href="/index.php?controller=admin&action=user-edit&id=<?= $user->getId() ?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <!-- User delete button. -->
                        <td>
                            <a class="admin-delete-user red" href="/index.php?controller=admin&action=user-delete&id=<?= $user->getId() ?>">
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