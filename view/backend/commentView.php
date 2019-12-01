<?php $title = 'Mon blog'; ?>
 
<?php ob_start(); ?>
<h1>Mon super blog !</h1>
<p><a href="index.php?action=post&amp;id=<?= $postId ?>">Retour à la liste des billets</a></p>
 
 
 
<h2>Modifier un commentaire</h2>
 
<form action="index.php?action=updateComment&amp;id=<?= $commentId ?>&amp;post_id=<?= $postId ?>" method="post">
    <div>
        <label for="author">Auteur</label>
         <input type="text" id="author" name="author" value="<?= $author ?>"/>
        <label for="comment">Commentaire</label><input type="text" class="form-control" id="comment" name="comment" value="<?= $comment ?>"/>
    </div>
    <div>
        <input type="submit" value="Modifier" />
    </div>
</form>
 
 
<?php $content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>