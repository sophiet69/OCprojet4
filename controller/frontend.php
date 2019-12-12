
<?php


//<!--fait le lien entre modele et affichage :controleur -->

//chargement des classes
/*
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
require_once('model/nb_page.php');*/

use \OpenClassrooms\Blog\Soso\Autoloader;
use \OpenClassrooms\Blog\Soso\PostManager;
use \OpenClassrooms\Blog\Soso\Pagination;
use \OpenClassrooms\Blog\Soso\CommentManager;
use \OpenClassrooms\Blog\Soso\UserManager;

require_once 'Autoloader.php';
Autoloader::register();


class Frontend{

    public function home(){
        require('view/frontend/homeView.php');

    }
  

    public function listPosts(){
        $pagination = new Pagination();
    	$postManager = new PostManager(); //création d'un objet

        $postsPerPage = 2;
        $nbPosts = $pagination ->getPostsPagination();

        $nbPage = $pagination->getPostsPages($nbPosts, $postsPerPage);
    
        if (!isset($_GET['page'])) {
            $cPage = 0;
        } else {
                if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
                $cPage = (intval($_GET['page']) - 1) * $postsPerPage;
            }
        }


    	$posts = $postManager->getPosts($cPage, $postsPerPage);// Appel d'une fonction de cet objet

    	require('view/frontend/listPostsView.php');
    }

    public function post() {
        if (isset($_GET['id']) && $_GET['id'] > 0){
        	$postManager = new PostManager();
        	$commentManager = new CommentManager();
            $reported=$commentManager->report($_GET['id']); //commentaire signalé
            
            $post = $postManager->getPost($_GET['id']);
            $comments = $commentManager->getComments($_GET['id']);
        
            require('view/frontend/postView.php');
        }
        else {
            throw new Exception('Aucun Id de chaptire');
        }

    }

    public function addComment() {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                $commentManager = new CommentManager();
                $affectedLines = $commentManager->postComment($_GET['id'], htmlspecialchars($_POST['author']), nl2br(htmlspecialchars($_POST['comment'])));
                if ($affectedLines === false) {
                        throw new Exception('Impossible d\'ajouter le commentaire !');
                }
                else {
                header('Location: index.php?action=post&id=' . $_GET['id']);
                }
            }
        }
    }  

    public function signalComment(){
        if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0 && isset($_GET['event']) && $_GET['event'] =='report'){

            $commentManager = new CommentManager(); 
            $comments = $commentManager->report($_GET['id']);

            require('view/frontend/signalCommentView.php');

        }
        else{
            throw new Exception('Aucun identifiant de chapitre');
        }
    }

    public function error($e){
      $messageError = $e->getMessage();

      require ('view/frontend/errorView.php');
    }

    
    public function login()
    {
        $error = null;
        if (isset($_POST['pseudo']) AND isset($_POST['pass']))
        {
            $userManager = new UserManager();
            $user = $userManager->get($_POST['pseudo']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
                     
            // Comparaison du pass envoyé via le formulaire avec la base
            $isPasswordCorrect = ($_POST['pass'] = $user['pass']);
               
                if (!$user ) {
                $error = 1;
                }
                else {
                    if($isPasswordCorrect)
                    {
                       //session_start();
                       $_SESSION['id'] = $user['id'];
                       $_SESSION['pseudo'] = $pseudo;
                      header('Location: index.php?action=admin');

                      /*if(isset($_POST['cookie']) && $_POST['cookie'] == 'on')
                        {
                        $navigateur = (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
                        $mot_de_passe = $resultat['pass'];
                        //sha1('aaa'.$nom_utilisateur.'bbb'.$mot_de_passe.'ccc'.$navigateur.'ddd');
                        $cookie_hache = sha1('aaa'.$_SESSION['pseudo'].'bbb'.$mot_de_passe.'ccc'.$navigateur.'ddd');;
                        
                        setcookie('pseudo', $_SESSION['pseudo'], time()+365*24*3600, '/');
                        setcookie('cookie', $cookie_hache, time()+365*24*3600, '/');
                        }*/
                    }
                    else{
                    $error = 1;
                    }    
                }
        }
            
        require('view/frontend/loginView.php');
    }

/*
    public function connectProcess()
    {
        if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
            $connectManager = new ConnectManager();
            $login          = $connectManager->connect($_POST['pseudo'], sha1($_POST['password']));

            if (!empty($login)) {
                session_start();
                $_SESSION['login'] = $login['id'];
                header('location: index.php?action=admin');
            } else {
                throw new Exception(' membre non reconnu');
            }
        } else {
            throw new Exception(' tous les champs ne sont pas remplis !');
        }
    }
*/




/* recup de index.php

     // EDIT A COMMENT ON A POST
        elseif ($_GET['action'] == 'editComment')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) 
            {
                if (!empty($_GET['author']) && !empty($_GET['comment'])) 
                {
                    editComment($_GET['post_id'], $_GET['id'], $_GET['author'], $_GET['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet et de commentaire envoyé');
            }
        }
        //UPDATE A COMMENT ON A POST
        elseif ($_GET['action'] == 'updateComment')
        {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) 
            {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) 
                {
                    updateComment($_GET['post_id'], $_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet et de commentaire envoyé');
            }
        }



    public function editComment($postId, $commentId, $author, $comment) {
        require('view/frontend/commentView.php');//pour modifier un commentaire
    }


    public function updateComment($postId, $commentId, $author, $comment) {
        $commentManager = new \OpenClassrooms\Blog\Soso\CommentManager();
        $affectedLines = $commentManager->updateComment($commentId, $author, $comment);

        if ($affectedLines === false) {
            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
            throw new Exception('Impossible de modifier le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }
    }*/

}

//on retire la balise fermante (? >) si le fichier ne contient que du PHP
