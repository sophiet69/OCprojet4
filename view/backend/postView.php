<?php $title = htmlspecialchars($post['title']) ?>

<?php ob_start(); ?>

<header>
    <div class="container" id="bloc-page-viewArticle">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                    <a href="index.php?action=admin" class="d-block d-md-inline-block btn btn-lg btn-secondary mb-3" role="button">Retour aux panneau d'administration</a>
            </div>
            <div class="col-lg-12 text-center">
                <h1 class="main-title text-center d-inline-block position-relative">Billet simple pour l'Alaska</h1>
            </div>
            
        </div>
        <div class="row ">
            <div class="col-lg-8 offset-lg-2 title-alaska">
               
            </div>   
        </div>
    </div>
</header>

<section id="chapitre">
    <div class="news">
        <h2 class="text-center "> <?= htmlspecialchars($post['title']) ?></h2>
        <h4> publié le <?= $post['creation_date_fr'] ?></h4>
        <div class="content">
           <p><?= nl2br($post['content']) ?></p> 
        </div>        
        
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>
