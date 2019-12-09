<?php


namespace OpenClassrooms\Blog\Soso;

require_once("model/Manager.php");


class UserManager extends Manager
{
    
    public function get($pseudo)
   {
      $db = $this->dbConnect();
    //recuperation des donnees
      $requete = $db->prepare('SELECT id, pass FROM membres WHERE pseudo = ? ');
      $requete-> execute(array($pseudo));
    return $requete->fetch();
   }

}
  /*
    public function exists($pseudo)
    {
        $db = $this->dbConnect();
        // on passe en lowercase le pseudo rentré et la recherche de pseudo correspondant pour éviter les doublons
        $query = $db->prepare('SELECT pseudo FROM users WHERE LOWER(pseudo) = ?');
        $query->execute([
            strtolower($pseudo)
        ]);
        return $query->fetch();
    }*/


    
    /**
     * Get all the comment for a post in the database
     * @param int $postId id of the post
     * @return list of comments
     */
    
  /*  public function getComments($postId)
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
    
  /*  public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO comments(post_id, author, comment, comment_date, report) VALUES(?, ?, ?, NOW(), 0)");
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }


}*/


