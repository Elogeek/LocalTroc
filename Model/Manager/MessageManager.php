<?php

namespace App\Manager;

use App\Entity\User\Message;
use App\Entity\UserService;
use App\Model\Entity\UserManager;
use Model\DB;

class MessageManager {

    /** Return all messages
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
     * Return all message by subject
     */
    public function getMessage ($id, UserService $userService ) :?UserService {
        $message = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE id = :id AND subject = :subject");
        $request->bindValue(':id', $id);
        $request->bindValue(':subject', $userService);
        $result = $request->execute();
        if($result) {
            $data = $request->fetchAll();
            foreach($data as $datas) {
                $message = new UserService($datas ['id'], $datas ['subject']);
            }
        }
    return $message;
    }

    /** Send a message
     * @param string $messageContent
     * @param $userFk
     * @param $fromUser
     * @return bool
     */
    public function sendMessages(string $messageContent, $userFk, $fromUser): bool {
        // Creating a Mysql date.
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');

        $request = DB::getInstance()->prepare("INSERT INTO message (from_user_fk,user_service_fk,content,date) VALUES (:fromUser, :userFk, :content,:date)");
        $request->bindValue( ":fromUser", $fromUser);
        $request->bindValue(":user", $userFk);
        $request->bindValue(":content", $messageContent);
        $request->bindValue(":date", $date);
        return $request->execute();
    }

    /**
     * Return an message entre users
     */
    public function getMessageByUser($id, $fromUser) {
        $message = [];
        $request = DB::getInstance()->prepare("SELECT * FROM message WHERE id = :id AND from_user_fk = :fromUser");
        $request->bindValue( ':id', $id);
        $request->bindValue( ':fromUser', $fromUser);
        $result = $request->execute();
        if ($result) {
            $data = $request->fetchAll();
            foreach ($data as $datas) {
                $message = new Message( $datas['id'], $datas['fromUser']);
            }
        }
        return $message;
    }

    /**
     * Add a message
     */
    public function addMessage(Message &$message) : bool {
        $request =DB::getInstance()->prepare("INSERT INTO messag (from_user_fk,user_fk_service,content, date) 
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
     * Delete a message
     */
    public function deleteMessage($id) {
        $request = DB::getInstance()->prepare("DELETE FROM message WHERE id =:id");
        $request->bindValue(':id', $id);
        $request->execute();
        return $request;
    }
}