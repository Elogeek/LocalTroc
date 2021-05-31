
<?php

use App\Entity\User;
use App\Entity\User\OpinionService;
use Model\DB;

class OpinionServiceManager {

    /**
     * Return an opinion by user via an service
     * @param User $user
     * @return OpinionService|null
     */
    public function getOpinion(User $user):?OpinionService {
        $opinion = null;
        $request = DB::getInstance()->prepare("SELECT * FROM opinion_service WHERE id = :id AND author_fk = :author");
        $request->bindValue(':id', $);
        $request->bindValue(':user', $user->getId());
        $request->bindValue(':author', $user);
        $request->bindValue(':content', $);
        $request->bindValue(':date',$);
        $result = $request->execute();

        if ($result) {
            $opinionData = $request->fetch();
            if ($opinion) {
                $opinion = new OpinionService($opinionData['id'], $opinionData['user'], $opinionData['author'], $opinionData['content'], $opinionData['date']);
            }
        }

        return $opinion;
    }

    /**
     * Return all opinions by user
     * @param $id
     * @param $author
     * @param $content
     * @return OpinionService|null
     */
    public function getOpinions($id, $author, $content) :?OpinionService {
        $opinion = null;
        $request = DB::getInstance()->prepare("SELECT * FROM opinion_service WHERE id = :id AND author_fk = :author");
        $request->bindValue( ':id', $id);
        $request->bindValue(':user', $));
        $request->bindValue(':author', $);
        $request->bindValue(':content', $);
        $request->bindValue(':date',$);
        $result = $request->execute();

        if($result) {
            $opinionData = $request->fetchAll();
            if($opinion) {
                $opinion = new OpinionService($opinionData['id'], $opinionData['user'], $opinionData['author'], $opinionData['content'], $opinionData['date']);
            }
        }
        return $opinion;
    }

    /**
     * Return an opinion via subjet(service)
     * @param $subject
     * @param OpinionService $id
     * @return array
     */
    public function getSubjectOpinion($subject, OpinionService $id): array {
        $opinion = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE subject = :subject");
        $request->bindValue(":subject" , $subject);
        $request->bindValue(":id" , $id);
        $request->execute();
        return $opinion;
    }

    /** Add an opinion in the BDD
     * @param OpinionServiceManager $opinionServiceManager
     * @return bool
     */
   public function addOpinion(OpinionServiceManager $opinionServiceManager)  : bool {
       $request = DB::getInstance()->prepare("
            INSERT INTO opinion_service (id,userk_service_fk,author_fk, content,date)
                VALUES (:id, :user, :service, :author, :content, :date)
       ");

       $request->bindValue(':id', $opinionServiceManager->getId());
       $request->bindValue(':user', $opinionServiceManager->getUser());
       $request->bindValue(':author', $opinionServiceManager->getAuthor());
       $request->bindValue(':content', $opinionServiceManager->getContent());
       $request->bindValue(':date', $opinionServiceManager->getDate());
       $request->execute();
       $opinionServiceManager->setId(DB::getInstance()->lastInsertId());
       return $request->execute() && DB::encodePassword($request) && DB::getInstance()->lastInsertId() != 0;
   }

}