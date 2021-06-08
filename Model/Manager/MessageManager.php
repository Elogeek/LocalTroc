<?php

namespace App\Manager;

use App\Entity\User;
use App\Entity\User\Message;
use App\Entity\UserService;
use App\Model\Entity\UserManager;
use Model\DB;
use PDOStatement;

class MessageManager {

    /**
     * Return all messages sent by user if service is not owned by user
     * @param User $user
     * @return array
     */
    public function getSentMessages(User $user): array {
        // Obtention des messages envoyés par l'utilisateur.
        $request = DB::getInstance()->prepare("SELECT * FROM message WHERE from_user_fk = :id");
        $request->bindValue(':id', $user->getId());
        $request->execute();
        $message = [];
        if($datas = $request->fetchAll()) {
            $serviceManager = new UserServiceManager();
            foreach($datas as $data) {
                $userService = $serviceManager->getService($data['user_service_fk']);
                $message[] = new Message($data['id'], $user, $userService , $data['content'], $data['date']);
            }
        }

        return $message;
    }


    /**
     * Send a message
     * @param string $messageContent
     * @param UserService $service
     * @param User $fromUser
     * @return bool
     */
    public function sendMessages(string $messageContent, UserService $service, User $fromUser): bool {
        // Creating a Mysql date.
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');

        $request = DB::getInstance()->prepare("
            INSERT INTO message (from_user_fk, user_service_fk, content, date) 
                VALUES (:fromUser, :user_service, :content, :date)
        ");
        $request->bindValue( ":fromUser", $fromUser->getId());
        $request->bindValue(":user_service", $service->getId());
        $request->bindValue(":content", $messageContent);
        $request->bindValue(":date", (new \DateTime())->format('Y-m-d H:i:s'));
        return $request->execute();
    }


    /**
     * Delete a message in the BDD
     * @param Message $message
     * @return bool
     */
    public function deleteMessage(Message $message) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM message WHERE id = :id");
        $request->bindValue(':id', $message->getId());
        return $request->execute();
    }

    /**
     * Return messages by service.
     * @param UserService $userService
     * @return array
     */
    public function getMessagesByUserService(UserService $userService): array {
        $request = DB::getInstance()->prepare("SELECT * FROM message where user_service_fk = :service_id");
        $request->bindValue(':service_id', $userService->getId());
        $messages = [];
        if($request->execute() && $data = $request->fetchAll()) {
            foreach($data as $mdata) {
                $message = new Message();
                $user = (new UserManager())->getById($mdata['user_service_fk']);
                if(!is_null($user)) {
                    $message->setId($mdata['id']);
                    $message->setContent($mdata['content']);
                    $message->setDate($mdata['date']);
                    $message->setUserFrom($user);
                    $message->setUserService($userService);
                    $messages[] = $message;
                }
            }
        }
        return $messages;
    }
}