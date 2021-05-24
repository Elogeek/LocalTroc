<?php

use App\Entity\User\Message;
use App\Manager\UserServiceManager;
use Model\DB;

class MessageManager {

    /**
     * Return all message by subject
     */

    /**
     * Return one a message by subject
     */

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