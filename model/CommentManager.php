<?php

// Gestionnaire de commentaires  :on y regroupe toutes nos fonction qui concerne les commentaires
//ANCIEN: récupere et traite les données :modele

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
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

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
     */
  
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
    }

    //pour signaler un commentaire en BD
    //
    public function report($commentId)

    {
        $db = $this->dbConnect();
    
        $com = $db->prepare("UPDATE `comments` SET `report`=1 WHERE id = ?");
        $com->execute(array($commentId));
        return $com;
   
    }
   

}


