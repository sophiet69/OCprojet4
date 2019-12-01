<?php

if($_GET)
{
    $request = $_GET['action'];
}
else
{
    $request = "";
}

require_once('controller/routeur.php');

$routeur = new Routeur($request);
$routeur->renderController();



//<!--routeur : appelle le bon controleur -->

/*
require('controller/frontend.php');

//entoure le routeur avec un bloc try/catch pour gerer les erreurs

/*try{ // on essaie de faire les choses

    if (isset($_GET['action'])) {
         if ($_GET['action'] == 'home') {
            home();
        }

        elseif ($_GET['action'] == 'listPosts') {
            listPosts();
            
        }

        elseif ($_GET['action'] == 'login') {
            login();
        }

        elseif ($_GET['action'] == 'signalComment') 
           
        {
            if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0 && isset($_GET['event']) && $_GET['event'] =='report') {
                report($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de billet, de commentaire  ou d\'evenement envoyé');
            }
        }

        //posts details and comment
        /*elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }*/
        //add a comment
       /* elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // autre exception
                    throw new Exception("Tous les champs ne sont pas remplis !");
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
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
    }
    else {
        home();
    }

}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}*/