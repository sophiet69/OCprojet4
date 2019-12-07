
<?php

//<!--fait le lien entre modele et affichage :controleur -->

//chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UserManager.php');
require_once('model/nb_page.php');



class Backend{

   
    public function admin(){
    	$postManager= new \OpenClassrooms\Blog\Soso\PostManager();
        $commentManager = new \OpenClassrooms\Blog\Soso\CommentManager();
        $reported=$commentManager->reported(); //commentaire signalé

        $pagination = new \OpenClassrooms\Blog\Soso\Pagination();
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
		

        require('view/backend/admin.php');

          
    }

    public function postB() {
        if (isset($_GET['id']) && $_GET['id'] > 0){
        	$postManager = new \OpenClassrooms\Blog\Soso\PostManager();
            $post = $postManager->getPost($_GET['id']);
            
        
            require('view/backend/postView.php');
        }
        else {
            throw new Exception('Aucun Id de chaptire');
        }

    }


    public function displayUpdate() {
		$postManager = new \OpenClassrooms\Blog\Soso\PostManager();
		$post = $postManager->getPost($_GET['id']);
		require('view/backend/updatePostView.php');
	}

	public function displayCreatePost() {
	require('view/backend/createPostView.php');
	}

	public function submitUpdate() {
		if (isset($_GET['id']) && $_GET['id'] > 0) {

			$postManager = new \OpenClassrooms\Blog\Soso\PostManager();
			
			$updated = $postManager->updatePost($_POST['title'], $_POST['content'], $_GET['id']);
			Header('Location: index.php?action=admin&update-status=success');
		}
		else {
				throw new Exception('Administrateur non identifié');
			}
	}

	public function newPost() {
		$postManager = new \OpenClassrooms\Blog\Soso\PostManager();
		$newPost = $postManager->createPost($_POST['title'], $_POST['content']);
		Header('Location: index.php?action=admin&new-post=success');
	}
	public function removePost() {
		$postManager = new \OpenClassrooms\Blog\Soso\PostManager();
		$deletedPost = $postManager->deletePost($_GET['id']);
		Header('Location: index.php?action=admin&remove-post=success');
	}

    public function removeComment() {
        $commentManager = new \OpenClassrooms\Blog\Soso\CommentManager();
        $deletedComment = $commentManager->deleteComment($_GET['id']);
        Header('Location: index.php?action=admin&remove-comment=success');
    }


/*
public function newArticle()
    {
        $this->sessionExists();
        $error = null;
        if (!empty($_POST)) // on rentre dans la condition si POST n'est pas vide
        {
            $validation = true;
            if (empty($_POST['title']) && empty($_POST['text'])) {
                $error = 1; // message vide
                $validation = false;
            }
            if (strlen($_POST['title']) > 255) {
                $error = 2; // titre trop long
                $validation = false;
            }
            if ($validation) // si pas d'erreurs
            {
                // définit la variable qui indique si le billet est publié en ligne ou enregistré en brouillon
                if (isset($_POST['submit'])) {
                    $online = 1;
                } else if (isset($_POST['draft'])) {
                    $online = 0;
                }
                // crée l'objet Article et ses valeurs
                $article = new Article([
                    'title' => $_POST['title'],
                    'content' => $_POST['text'],
                    'on_line' => $online
                ]);
                // instanciation de la classe ArticleManager, qui lance la connexion à la BDD
                $articleManager = new ArticleManager();
                $articleManager->add($article); // ajout de l'article à la BDD
                // redirection vers la page d'administration
                header('Location: index.php?action=admin&success=newArticle');
            }
            
        }
        switch ($error) {
            case 1:
                $error = '<p class="text-danger">Message vide !</p>';
                break;
            case 2:
                $error = '<p class="text-danger">Titre trop long !</p>';
                break;
        }
        
        require('view/backend/newArticle.php');
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
