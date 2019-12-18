<?php

// Gestionnaire de commentaires  :on y regroupe toutes nos fonction qui concerne les commentaires

namespace OpenClassrooms\Blog\Soso;

require_once("model/Manager.php");

class CommentManager extends Manager
{

    /**
     * Get all the comment for a post in the database
     * @param int $postId id of the post
     * @return list of comments
     */
    
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment,report DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    
    public function getAllComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT * FROM comments ORDER BY report DESC');
        $comments->execute();

        return $comments;
    }
    
    //pour ajouter un commentaire en BD
    /**
     * Add a comment in the database
     * @param int $postId id of the post
     * @param string $author author of the comment
     * @param string $comment comment of the comment
     * @return boolean
     */
    
    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO comments(post_id, author, comment, comment_date, report) VALUES(?, ?, ?, NOW(), 0)");
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }


    /**
     * Update a comment in database
     * @param int $commentId id of the comment
     * @param string $author author of the comment
     * @param string $comment comment of the comment
     * @return boolean
     
  
    public function updateComment($commentId, $author, $comment)
    {
        $db = $this->dbConnect();
        $data = [
            'author' => $author,
            'comment' => $comment,
            'id' => $commentId
        ];
        $com = $db->prepare('UPDATE comments SET author = :author, comment = :comment, comment_date = NOW() WHERE id = :id');
        $affectedLines = $com->execute($data);
        return $affectedLines;
    }*/
    
    
    //pour signaler un commentaire en BD
    
    public function report($commentId)

    {
        $db = $this->dbConnect();
    
        $com = $db->prepare("UPDATE `comments` SET `report`=1 WHERE id = ?");
        $com->execute(array($commentId));
        return $com;
   
    }
    public function reported()

    {
        $report=false;

        $db = $this->dbConnect();
    
        $com = $db->query("SELECT * FROM `comments` WHERE `report`= 1 ");
        
        $queryReport=$com->fetch();
       if($queryReport){
        $report=true;
       }

        return $report;
   
    }

    public function deleteComment($commentId) {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ?');
        $deletedComment = $req->execute(array($commentId));
        return $deletedComment;
    }
    
    /**
     * Update a comment in database
     * @param int $commentId id of the comment
     * @param report of the comment
     */
     
    public function acceptComment($commentId)
    {
        $db = $this->dbConnect();
        $query = $db->prepare("UPDATE comments SET report = 0 WHERE id = ?");
        $result = $query->execute(array($commentId));
        return $result;
    }
    
    
    /**
     * Delete all Comments in database when delete post
     * @param int $postId id of the post
     * @return boolean
     */
    
    public function deleteComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('DELETE FROM comments WHERE post_id= ?');
        $deleteComments = $comments->execute(array($postId));
        return $deleteComments;
    }


   

}


