<?php

use App\Entity\User\Message;
use App\Entity\UserService;
use Model\DB;

class MessageManager {

    /** Return all messages
     *
     */
    public function getMessages(): array {
        $request = DB::getInstance()->prepare("SELECT * FROM message");
        $request->execute();
        $message = [];
        if($data = $request->fetchAll()) {
            foreach($data as $datas) {
                $message[] = new Message($datas['id'], $datas['from_user_fk'], $datas['user_service_fk'], $datas
                ['content'],$datas['date']);
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
        $request->bindValue(":user_fk", $userFk);
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

}