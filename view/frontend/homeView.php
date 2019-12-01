<!--affiche la page/les informations :vue -->
<?php $title = 'Accueil | Blog de Jean Forteroche'; ?>

<?php ob_start(); ?>
        

<header id="home-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="main-title text-center text-white d-inline-block position-relative">Bienvenue sur le blog de Jean Forteroche</h1>
            </div>
        </div>
        <div class="row home-alaska">
            <div class="col-lg-8 offset-lg-2 title-alaska">
                <h2 class="text-center text-white">Découvrez le nouveau roman : Billet simple pour l'Alaska</h2>
            </div>
            <div class="col-lg-6 offset-lg-3 text-center">
                <a href="index.php?action=listPosts" class="d-block d-md-inline-block btn btn-lg btn-light mb-3" role="button">Découvrir les chapitres</a>
            </div>
        </div>
    </div>
</header>

<section id="home-project-alaska">
    <div class="container">
        <div class="row box-icone">
            <div class="col-xs-12 col-md-6 feature-box">
                <a>
                    <div class="icon" >
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h4 class="info-title" >Un roman en ligne</h4>
                </a>
                <p>Découvrez, au fur et à mesure de ses publication, les nouveaux chapitres du récit de Jean Forteroche</p>
            </div>
        
            <div class="col-xs-12 col-md-6 feature-box">
                <a>
                    <div class="icon" >
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <h4 class="info-title" >Commentez les chapitres</h4>
                </a>
                <p>Vous pouvez commenter chaque publication du roman "Billet simple pour l'Alaska" afin de donner votre avis sur ces écrits</p>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>