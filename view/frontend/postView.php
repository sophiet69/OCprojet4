<?php $title = htmlspecialchars($post['title']) ?>

<?php ob_start(); ?>

<header id="billet-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-8 offset-lg-2 title-alaska">
                <h2 class="text-center text-white"> <?= htmlspecialchars($post['title']) ?></h2>

                <div class="col-lg-6 offset-lg-3 text-center">
                    <a href="index.php?action=listPosts" class="d-block d-md-inline-block btn btn-lg btn-light mb-3" role="button">Retour aux chapitres</a>
                </div>

            </div>
            
        </div>
    </div>
</header>

<section id="chapitre">
<div class="news">
    <h4>
        
        <br>publié le <?= $post['creation_date_fr'] ?></em>
    </h4>
            
    <p>
        <?= nl2br(($post['content'])) ?>
    </p>
</div>
</section>

<section id="comments">
    <h2>Les commentaires</h2>
<?php
while ($comment = $comments->fetch())
{
?>  <div id="text-comments">
        <h5><strong><?= htmlspecialchars($comment['author']) ?></strong><br> le <?= $comment['comment_date_fr'] ?></h5>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <a href="index.php?action=signalComment&amp;id=<?= $comment['id'] ?>&amp;post_id=<?= $post['id'] ?>&amp;event=report" class="d-block d-md-inline-block btn btn-lg btn-danger" role="button">Signaler</a>

        <!--<a href="index.php?action=editComment&amp;id=<?= $comment['id'] ?>&amp;post_id=<?= $post['id'] ?>&amp;author=<?= htmlspecialchars($comment['author']) ?>&amp;comment=<?= htmlspecialchars($comment['comment']) ?>"> (modifier le commentaire)</a>-->

    </div>
<?php
}
?>

</section>

<section id="make-comment">
<h2 class="text-white">Laisser un commentaire</h2>

<form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>#comments" method="post">
    <div>
        <label for="author">Votre pseudo</label><br />
        <input class="form-control" type="text" id="author" name="author" placeholder="Pseudo" />
    </div>
    <div>
        <label for="comment">Votre commentaire</label><br />
        <textarea class="form-control" id="comment" name="comment" placeholder="Ecrivez votre commentaire ici"></textarea>
    </div>
    <div>
        <input type="submit" class="btn btn-info" />
    </div>
</form>

</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
