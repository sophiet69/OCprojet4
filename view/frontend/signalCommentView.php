<!--affiche la page/les informations :vue -->
<?php $title = 'Accueil | Blog de Jean Forteroche'; ?>

<?php ob_start(); ?>
        

<header id="signal-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="main-title text-center d-inline-block position-relative">COMMENTAIRE SIGNALÉ</h2>
                <p>Merci pour votre signalement. Nous allons faire le nécessaire au plus vite.</p>
            </div>
            <div class="col-lg-6 offset-lg-3 text-center">
                <a href="index.php?action=listPosts" class="d-block d-md-inline-block btn btn-lg btn-light mb-3" role="button">Retour aux chapitres</a>
            </div>
        </div>
      
    </div>
</header>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>