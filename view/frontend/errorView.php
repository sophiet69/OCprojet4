<!--affiche la page/les informations :vue -->
<?php $title = 'Page Introuvable'; ?>

<?php ob_start(); ?>
        

<section id="connect">
    <div class="container">
        <div class="row" >
            <div class="col-lg-12 text-center text-white">

                <h2>Oups ! La page que vous cherchez n'existe pas.</h2>
                
            </div>
			<div class="col-lg-8 offset-lg-2 text-error text-center text-white">
				<p id="text-form">Vous trouverez probablement ce que vous cherchez sur la <a href="index.php?action=home" title="Revenir à la page d'accueil">page d'Accueil</a></p>
				

			</div>

        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>