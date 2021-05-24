
<?php

use App\Entity\UserService\OpinionService;
use Model\DB;

class OpinionServiceManager {

    /**
     * Return an opinion by user via an service
     */
    public function getOpinion($id, $author, $content):?OpinionService {
        $opinion = null;
        $request = DB::getInstance()->prepare("SELECT * FROM opinion_service WHERE id = :id AND author_fk = :author");
        $request->bindValue(':id', $id);
        $request->bindValue(':content', $content);
        $request->bindValue(':author', $author);
        $result = $request->execute();

        if ($result) {
            $opinionData = $request->fetch();
            if ($opinion) {
                $opinion = new OpinionService($opinionData['id'], $opinionData['content'], $opinionData['author_fk']);
            }
        }

        return $opinion;
    }

    /**
     * Return all opinions by user
     */
    public function getOpinions($id, $author, $content) :?OpinionService {
        $opinion = null;
        $request = DB::getInstance()->prepare("SELECT * FROM opinion_service WHERE id = :id AND author_fk = :author");
        $request->bindValue( ':id', $id);
        $request->bindValue(':content', $content);
        $request->bindValue( ':author', $author);
        $result = $request->execute();

        if($result) {
            $opinionData = $request->fetchAll();
            if($opinion) {
                $opinion = new OpinionService($opinionData['id'], $opinionData['content'], $opinionData['author_fk']);
            }
        }
        return $opinion;
    }

    /**
     * Return an opinion via subjet(service)
     */
    public function getSubjectOpinion($subject,$id): array{
        $opinion = [];
        $request = DB::getInstance()->prepare("SELECT * FROM user_service WHERE subject = :subject AND SELECT * FROM opinion_service WHERE id = :id");
        return $opinion;
    }


}