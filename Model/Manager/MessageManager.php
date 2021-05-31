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
     * Return all messages
     * @param User $user
     * @return array
     */
    public function getMessages(User $user): array {
        // Obtention des messages envoyés par l'utilisateur.
        $request = DB::getInstance()->prepare("SELECT * FROM message WHERE from_user_fk = :id");
        $request->bindValue(':id', $user->getId());
        $request->execute();
        $message = [];
        if($datas = $request->fetchAll()) {
            foreach($datas as $data) {
                $message["sent"][] = new Message($data['id'], $data['from_user_fk'], $data['user_service_fk'], $data['content'], $data['date']);
            }
        }

        // Récupérer les messages envoyés à l'utilisateur.
        $services = (new UserServiceManager())->getServicesByUser($user);
        foreach ($services as $service) {
            /* @var UserService $service */

        }

        return $message;
    }


    /**
     * Send a message
     * @param string $messageContent
     * @param int $userFk
     * @param int $fromUser
     * @return bool
     */
    public function sendMessages(string $messageContent, int $userFk, int $fromUser): bool {
        // Creating a Mysql date.
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');

        $request = DB::getInstance()->prepare("
            INSERT INTO message (from_user_fk, user_service_fk, content, date) 
                VALUES (:fromUser, :userFk, :content,:date)
        ");
        $request->bindValue( ":fromUser", $fromUser);
        $request->bindValue(":user", $userFk);
        $request->bindValue(":content", $messageContent);
        $request->bindValue(":date", $date);
        return $request->execute();
    }

    /**
     * Add a message into the BDD
     * @param Message $message
     * @return bool
     */
    public function addMessage(Message &$message) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO message (from_user_fk, user_fk_service, content, date) 
                VALUES (:fromUser, :userServiceFk, :content, :date)
        ");

        $request->bindValue(':fromUser', $message->getUserFrom());
        $request->bindValue(':userServiceFk',$message->getUserService());
        $request->bindValue(':content', $message->getContent());
        $request->bindValue(':date', $message->getDate());

        $request->execute();
        $message->setId(DB::getInstance()->lastInsertId());
        return $message->getId() !== null && $message->getId() > 0;

    }

    /**
     * Return an message entre users
     * @param int $fromUser
     * @return Message|array
     */
    public function getMessageByUser(int $fromUser) {
        $userManager = new UserManager();
        $userServiceManager = new UserServiceManager();

        $message = [];
        $request = DB::getInstance()->prepare("SELECT * FROM message WHERE from_user_fk = :fromUser");
        $request->bindValue( ':fromUser', $fromUser);
        $result = $request->execute();
        if ($result) {
            $datas = $request->fetchAll();
            foreach ($datas as $data) {
                $message = new Message();
                $message->setId($data['id']);
                $message->setContent($data['content']);
                $message->setDate($data['date']);

                // Getting message from user.
                $user = $userManager->getById($data['from_user_fk']);
                $message->setUserFrom($user);

                // Getting user service.
                $service = $userServiceManager->getService($data['user_service_fk']);
                $message->setUserService($service);
            }
        }
        return $message;
    }

    /**
     * Delete a message in the BDD
     * @param $id
     * @return bool
     */
    public function deleteMessage($id) : bool {
        $request = DB::getInstance()->prepare("DELETE FROM message WHERE id =:id");
        $request->bindValue(':id', $id);
        $request->execute();
        return $request;
    }
}