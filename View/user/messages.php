<div class="internal-container">
    <div class="profile-content"> <?php
        use App\Entity\User;
        use App\Entity\User\Message;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/View/user/_partials/avatar-and-menu.php';
        $messagesData = $params['fromUserServices']; ?>

        <div class="profile-table">
            <h1>Messages relatifs à vos services</h1>
            <hr> <?php
                foreach ($messagesData as $messageData) {
                    $service = $messageData['service'];
                    $messages = $messageData['messages']; ?>
                    <div class="messages-service-box">
                        <h3><i class="fas fa-briefcase"></i>&nbsp;<?= $service->getSubject() ?></h3>
                        <div class="messages-box"> <?php
                            foreach($messages as $conversation) { ?>
                                <div class="conversation"> <?php

                                    $userFrom = $messages[array_keys($messages)[0]][0]->getUserFrom();
                                    if($userFrom->getId() === $user->getId()) {
                                        $userTo =  $messages[array_keys($messages)[0]][0]->getUserTo();
                                    }
                                    else {
                                        $userTo = $messages[array_keys($messages)[0]][0]->getUserFrom();
                                        $userFrom = $user;
                                    }

                                    foreach($conversation as $message) {
                                        $class = $user->getId() === $message->getUserFrom()->getId() ? 'bubble-bottom-right from' : 'bubble-bottom-left to';
                                        ?>

                                        <div class="bubble <?= $class ?>">
                                            <?php
                                            if($message->getUserFrom()->getId() === $user->getId())
                                                $from = 'Moi';
                                            else
                                                $from = $message->getUserFrom()->getFirstName() . ' ' . $message->getUserFrom()->getLastName();
                                                $date = (DateTime::createFromFormat('Y-m-d H:i:s', $message->getDate()));
                                                $date = $date->format('d-m-y à H:i');
                                            ?>
                                            <small>De: <?= $from ?>, <span class="message-date"><?= $date ?></span></small>
                                            <p><?= $message->getContent() ?></p>
                                        </div><?php
                                    }
                                    ?>
                                    <form action="/index.php?controller=user&action=messages&sid=<?= $service->getId() ?>" method="post">
                                        <hr>
                                        <label for="response">Répondre</label>
                                        <textarea name="message" id="response" rows="4"></textarea>
                                        <input type="hidden" name="user-from" value="<?= $userFrom->getId() ?>">
                                        <input type="hidden" name="user-to" value="<?= $userTo->getId() ?>">
                                        <div class="form-group">
                                            <div>
                                                <input class="btn btn-secondary" type="submit" name="submit" value="Répondre">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr> <?php
                            } ?>

                        </div>
                    </div> <?php
                } ?>
        </div>
    </div>
</div>