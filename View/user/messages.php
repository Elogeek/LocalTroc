<div class="internal-container">
    <div class="profile-content"> <?php
        use App\Entity\User;
        use App\Entity\User\Message;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $messagesData = $params['fromUserServices']; ?>

        <div class="profile-table">
            <h1>Messages relatifs à vos services</h1>
            <hr>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> <?php
                foreach ($messagesData as $messageData) {
                    $service = $messageData['service'];
                    $messages = $messageData['messages']; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <!-- Message delete button. -->
                        <td>
                            <a title="Supprimer" class="admin-delete-user red" href="/index.php?controller=admin&action=user-delete&id=">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr> <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>