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
    
    
    public function updatePost($title, $content, $postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE posts SET title = ?, content = ?, update_date = NOW() WHERE id = ?');
        $updated = $req->execute(array($title, $content, $postId));
        return $updated;
    }
    public function createPost($title, $content) {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO posts(title, content, creation_date, update_date) VALUES (?, ?, NOW(), NOW())');
        $newPost = $req->execute(array($title, $content));
        return $newPost;
    }
    public function deletePost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE id = ?');
        $deletedPost = $req->execute(array($postId));
        return $deletedPost;
    }


 
}



    
