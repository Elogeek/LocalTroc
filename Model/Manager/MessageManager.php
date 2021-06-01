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
}