<?php

//<!--fait le lien entre modele et affichage :controleur -->

//chargement des classes
/*
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
require_once('model/nb_page.php');*/

// namespaces utilisés
use \OpenClassrooms\Blog\Soso\Autoloader;
use \OpenClassrooms\Blog\Soso\PostManager;
use \OpenClassrooms\Blog\Soso\Pagination;
use \OpenClassrooms\Blog\Soso\CommentManager;
use \OpenClassrooms\Blog\Soso\UserManager;

require_once 'Autoloader.php';
Autoloader::register();



class Backend{

   
    public function admin(){
    	$postManager= new PostManager();
        $commentManager = new CommentManager();
	$memberManager = new UserManager();
        $reported=$commentManager->reported(); //commentaire signalé

        $pagination = new Pagination();
			$postsPerPage = 6;
			$nbPosts = $pagination->getPostsPagination();
			$nbPage = $pagination->getPostsPages($nbPosts, $postsPerPage);
			if (!isset($_GET['page'])) {
				$cPage = 0;
			} else {
				if (isset($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $nbPage) {
					$cPage = (intval($_GET['page']) - 1) * $postsPerPage;
				}
			}

        $posts = $postManager->getPosts($cPage, $postsPerPage);
        $comments = $commentManager->getAllComments();
	    $members = $memberManager->getMembers();
		

        require('view/backend/admin.php');

          
    }

    public function postB() {
        if (isset($_GET['id']) && $_GET['id'] > 0){
        	$postManager = new PostManager();
            $post = $postManager->getPost($_GET['id']);
            
        
            require('view/backend/postView.php');
        }
        else {
            throw new Exception('Aucun Id de chaptire');
        }

    }


    public function displayUpdate() {
		$postManager = new PostManager();
		$post = $postManager->getPost($_GET['id']);
		require('view/backend/updatePostView.php');
	}

	public function displayCreatePost() {
	require('view/backend/createPostView.php');
	}

	public function submitUpdate() {
		if (isset($_GET['id']) && $_GET['id'] > 0) {

			$postManager = new PostManager();
			
			$updated = $postManager->updatePost($_POST['title'], $_POST['content'], $_GET['id']);
			Header('Location: index.php?action=admin&update-status=success');
		}
		else {
				throw new Exception('Administrateur non identifié');
			}
	}

	public function newPost() {
		$postManager = new PostManager();
		$newPost = $postManager->createPost($_POST['title'], $_POST['content']);
		Header('Location: index.php?action=admin&new-post=success');
	}
	/*
	public function removePost() {
		$postManager = new PostManager();
		$deletedPost = $postManager->deletePost($_GET['id']);
		Header('Location: index.php?action=admin&remove-post=success');
	}
	*/
	
	public function removePost() {
        $postManager = new PostManager();
        $commentManager = new CommentManager();

        $deletedPost = $postManager->deletePost($_GET['id']);
        $deleteComments = $commentManager->deleteComments($_GET['id']);

		if($deletedPost === false)
		{
		    throw new Exception('Impossible de supprimer le chapitre' );
		}
		elseif ($deleteComments === false)
		{
		    throw new Exception('Impossible de supprimer les commentaire du chapitre' );
		}
		else
		{
		    Header('Location: index.php?action=admin&remove-post=success');
		}
        
    	}

    public function removeComment() {
        $commentManager = new CommentManager();
        $deletedComment = $commentManager->deleteComment($_GET['id']);
        Header('Location: index.php?action=admin&remove-comment=success');
    }
	
	public function acceptComment(){
        $commentManager = new CommentManager();
        $acceptedComment = $commentManager->acceptComment($_GET['id']);
        Header('Location: index.php?action=admin&accept-comment=success');
    }
	public function displayCreateMember() {
    require('view/backend/createMemberView.php');
    }

    public function removeMember() {
    $memberManager = new UserManager();
    $deletedMember = $memberManager->deleteMember($_GET['id']);
    Header('Location: index.php?action=admin&remove-member=success');   
    }

    
    public function addMember() {
    $memberManager = new UserManager();

    $pass = htmlspecialchars($_POST['pass']);
    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);// Hachage du mot de passe
    
    $newMember = $memberManager->createMember($_POST['pseudo'], $_POST['pass']);
    
    // redirige vers page d'accueil avec le nouveau paramètre
    Header('Location: index.php?action=admin&add-member=success');
    } 



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



    public function editComment() {
        require('view/frontend/commentView.php');//pour modifier un commentaire
    }


    public function updateComment() {
    	/*if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) 
            {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) 
                {
        			$commentManager = new \OpenClassrooms\Blog\Soso\CommentManager();
        			$affectedLines = $commentManager->updateComment($_GET['id'], $_GET['id'], $_POST['author'], $_POST['comment']);

        			if ($affectedLines === false) {
		            // Erreur gérée. Elle sera remontée jusqu'au bloc try du routeur !
		            throw new Exception('Impossible de modifier le commentaire !');
		        	}
		        	else {
		            	header('Location: index.php?action=post&id=' . $_GET['id']);
		        	}
		        }
		    }
    }
*/
    
}
