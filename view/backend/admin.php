<?php

$title = 'Panneau d\'administration';
$metaDescription = "Bienvenue sur le tableau de bord du blog de Jean Forteroche, où vous pourrez gérer vos articles et les commentaires associés.";

ob_start();
?>

<div class="container">
    <div class="jumbotron">
        <div class="d-flex flex-column flex-xl-row flex-wrap justify-content-between align-items-xl-center">
            <div class="d-flex flex-row justify-content-center justify-content-lg-start order-lg-1 order-xl-2 mb-4 mb-xl-0 flex-end">
                <button type="button" title="Déconnexion" class="btn btn-secondary d-inline-block mr-2" data-toggle="modal" data-target="#end-session"><span class="fas fa-power-off"></button></a>
                

                <!-- Modal du bouton déconnexion -->
                <div class="modal fade" id="end-session" tabindex="-1" role="dialog" aria-labelledby="se déconnecter de la session" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEndSession">Souhaitez-vous vous déconnecter ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                
                                <a href="index.php?action=destroy" class="btn btn-danger">Se déconnecter</a>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="modal fade " id="after-event" tabindex="-1" role="dialog" aria-labelledby="votre action a été enregistrée" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAlertEvent"></h5>
                                

                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="h1 order-lg-2 order-xl-1 text-center text-lg-left">Bienvenue sur votre tableau de bord ! </h1>
        </div>

        <hr class="my-4" />
        <p class="lead text-justify">Vous retrouverez ici l'ensemble de vos articles et commentaires.</p>
        <?php if ($reported) { ?><p class="lead text-danger text-justify"><span class="fas fa-exclamation-circle"></span> Vous avez un ou plusieurs commentaires signalés. Pour les traiter, rendez-vous dans votre section "Commentaires"</p><?php } ?> 
    </div>

    <?php 
    if (isset($_GET['remove-comment']) &&  $_GET['remove-comment'] == 'success') {
        echo '<p id="success">Le commentaire a bien été supprimé !</p>';
    }
    ?>

    <h2 id="admin-title-article" class="mb-4 mr-4 d-inline-block">Vos articles</h2><a href="index.php?action=createPost" class="d-inline-block btn btn-primary mb-2" role="button">Ajouter</a>
    <div class="table-responsive">
        <table id="table-blogspots" class="table table-striped table-admin">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Date de publication</th>
                    <th scope="col">Voir</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <div id="postManage">
                    <?php
                        if (isset($_GET['update-status']) &&  $_GET['update-status'] == 'success') {
                            echo '<p id="success">L\'article a bien été modifié !<p>';
                        }
                        elseif (isset($_GET['new-post']) &&  $_GET['new-post'] == 'success') {
                            echo '<p id="success">L\'article a bien été publié !<p>';
                        }
                        elseif (isset($_GET['remove-post']) &&  $_GET['remove-post'] == 'success') {
                            echo '<p id="success">L\'article a bien été supprimé !</p>';
                        }   
                        /*$countPost = 0;*/
                        while ($data = $posts->fetch()) {
                            if (!empty($data)) {
                    ?>
                    <div class="listPanel">
                        <tr>
                            <th>
                                <p><a class="linkAdmin" href="index.php?action=updatePost&amp;id=<?= $data['id']; ?>"><?= $data['title']; ?></a></p>
                                <td><p><em>Publié le <?= $data['creation_date_fr']; ?></em></p></td>
                                <td><a href="index.php?action=postB&amp;id=<?=htmlspecialchars($data['id']) ?>" title="Voir l'article" class="btn btn-secondary"><span class="far fa-eye" role="button"></span></a></td>
                                <td><a class="report" href="index.php?action=updatePost&amp;id=<?= $data['id']; ?>"><i class="fas fa-edit" ></i></a> </td>
                                <td>
                                <button type="button" title="Supprimer l'article" class="btn btn-danger mb-2" data-toggle="modal" data-target="#article<?=$data['id']; ?>"><span class="fas fa-trash-alt"></span></button> </td>
    

                                <div class="modal fade" id="article<?=$data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="supprimer un article" aria-hidden="true"> 
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDeleteArticle">Êtes-vous certain(e) de supprimer cet article ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="index.php?action=deletePost&amp;id=<?= $data['id']; ?>" class="btn btn-danger">Supprimer</a>
                                        </div>
                                    </div>
                                </div>                    
                            </th>
                    
                        </tr>
                
                
                        <!--                
                        <?php 
                            if ($data['creation_date_fr'] < $data['update_date_fr']) {
                                echo '<p><em>modifié le ' . $data['update_date_fr'] . '</em></p>';
                            }
                        ?>  -->
                    </div>
                    <?php
                            } else {
                                echo "<p>Pas d'articles !</p>";
                            }
                    }

                    $posts->closeCursor();

                    if ($nbPage >= 2) {
                    ?>
                        <div id="pageFrame">
                        <?php
                        for ($i = 1; $i <= $nbPage; $i++) {
                            if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                                echo "<span class='cPageFrame'>$i</span>";
                            } else {
                                echo "<a class='pageBlock' href=\"index.php?action=admin&amp;page=$i\">$i</a>";
                             }
                        }
                        ?> 

                        </div>

                    <?php
                        }
                    ?>
 
                </div>

            </tbody>
        </table>
    </div>

    <h2 id="admin-title-comment" class="mb-4">Commentaires</h2>
    
    <div class="table-responsive">
        <table id="table-comments" class="table table-striped table-admin">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Date</th>
                    <th scope="col">Commentaire</th>
                    <th scope="col">N° du chapitre</th>
                    <th scope="col">Etat du commentaire</th>
                    <th scope="col">Supprimer</th>
                </tr>
            </thead>
            
               
            <tbody>

                <?php
                while ($comment = $comments->fetch())
                {
                ?>
                <div>
                    <tr<?php if ($comment['report'] == 1){ ?> class="bg-warning" <?php } ?>>
                        <td><p><strong><?= htmlspecialchars($comment['author']) ?></strong></p></td>
                        <td><p><em>Publié le <?= date_format(date_create($comment['comment_date']), 'd/m/Y à H:i') ?></em></p></td>
                        
                        <td><p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p></td>
                        
                        <td><?= $comment['post_id'] ?></td>
                        <td>
                        <?php if ($comment['report'] == 1){
                            echo '<p >Signalé</p>';}
                            else{
                                echo '<p > </p>';
                            }?>
                                
                        </td>
                    
                        <td>
                        <button type="button" title="Supprimer le commentaire" class="btn btn-danger mb-2" data-toggle="modal" data-target="#commentaire<?=$comment['id']; ?>"><span class="fas fa-trash-alt"></span></button>
                        </td>
    

                        <div class="modal fade" id="commentaire<?=$comment['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="supprimer un commentaire" aria-hidden="true"> 
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteComment">Êtes-vous certain(e) de supprimer ce commentaire ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="index.php?action=deleteComment&amp;id=<?= $comment['id']; ?>" class="btn btn-danger">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </tr>
    
                </div>
                <?php
                }
                $comments->closeCursor();
                ?>  
        
                <!--
               
                <?php
                // on affiche chaque entrée dans une boucle, avec du htmlspecialchars sur les données publiées
                // 
                // 
                foreach ($comments as $comment) {
                   
                    ?>-->
                
                    <!-- on ferme PHP pour la clarté du code -->
         
                 <!--   <tr <?php if ($reported) { ?> class="bg-warning" <?php } ?>>
                        <th scope="row"><?= $comment->$_GET['pseudo']; ?></th>
                        <td>Publié le <?= date_format(date_create($comment->$_GET['comment_date']), 'd/m/Y à H:i:s') ?></td>
                        <td><?= substr($comment->$_GET['comment'], 0, 50) ?><span class="text-muted">[...]</span></td>
                        <td><?= $comment->$_GET['title'] ;?></td>
                        <td><a href="index.php?action=view&id=<?= $comment->$_GET['post_id'] ; ?>#comment<?= $comment->$_GET['id'] ; ?>" title="Voir le commentaire" class="btn btn-secondary" role="button"><span class="far fa-eye"></span></a></td>
                        <td><?php if ($reported) { ?><a href="index.php?action=admin&comment=<?= $comment->$_GET['id'] ; ?>&event=accept" title="Accepter le commentaire" class="btn btn-success mb-2" role="button"><span class="fas fa-check"></span></a> <?php } ?><button type="button" title="Supprimer le commentaire" class="btn btn-danger mb-2" data-toggle="modal" data-target="#comment<?= $comment->$_GET['id'] ; ?>"><span class="fas fa-trash-alt"></span></a></td>
                    </tr>
                -->

                    <!-- Modal du bouton supprimer -->

                    <!--
                    <div class="modal fade" id="comment<?= $comment->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="supprimer un commentaire" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDeleteComment">Êtes-vous certain(e) de supprimer ce commentaire ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <a href="index.php?action=admin&comment=<?= $comment->getId() ?>&event=delete" class="btn btn-danger">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                <?php // on réouvre PHP avant de finir la boucle
                }
                ?>

       
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>