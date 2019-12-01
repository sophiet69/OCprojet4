<?php

//Gestionnaire de post : on y regroupe toutes nos fonctions qui concerne les posts/chapitres
//ANCIEN: récupere et traite les données :modele

namespace OpenClassrooms\Blog\Soso;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts($cPage, $postsPerPage)
    {
        $db = $this->dbConnect();


        $req = $db->query('SELECT * , DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT '.$cPage.','.$postsPerPage.'');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

 
}



    