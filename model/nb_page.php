<?php
namespace OpenClassrooms\Blog\Soso;

require_once("model/Manager.php");

class Pagination extends Manager
{ 
    public function getPostsPagination() {
        $db = $this->dbConnect();
        $totalPosts = $db->query('SELECT COUNT(*) AS nbPosts FROM posts');
   
        return $totalPosts->fetch()['nbPosts'];// on recupere le total 

    }

    public function getPostsPages($nbPosts, $postsPerPage) {  
        $nbPage = ceil($nbPosts/$postsPerPage);//on compte le nombre de page (ceil: nombre entier)
        return $nbPage;
    }
}
