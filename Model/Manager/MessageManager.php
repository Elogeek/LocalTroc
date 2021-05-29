<?php

namespace App\Manager;

use App\Entity\User\Message;
use App\Entity\UserService;
use App\Model\Entity\UserManager;
use Model\DB;

class MessageManager {

    /**
     * Return all messages
     * @return array
     */
    public function getMessages(): array {
        $request = DB::getInstance()->prepare("SELECT * FROM message");
        $request->execute();
        $message = [];
        if($data = $request->fetchAll()) {
            foreach($data as $datas) {
                $message[] = new Message($datas['id'], $datas['from_user_fk'], $datas['user_service_fk'], $datas
                ['content'], $data['date']);
            }
        }

        return $message;
    }


    /**
     * Send a message
     * @param string $messageContent
     * @param $userFk
     * @param $fromUser
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
     */
    public function addMessage(Message &$message) : bool {
        $request = DB::getInstance()->prepare("INSERT INTO messag (from_user_fk,user_fk_service,content, date) 
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
     */
    public function deleteMessage($id) {
        $request = DB::getInstance()->prepare("DELETE FROM message WHERE id =:id");
        $request->bindValue(':id', $id);
        $request->execute();
        return $request;
    }
}