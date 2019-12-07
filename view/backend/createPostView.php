<?php 
$title = "Nouvel article"; ?>

<?php ob_start(); ?>

<section id="createPost">
	<div class="container" id="bloc-page-newArticle">
		<h1 id="new-article-title" class="mt-3 mb-5">Ajouter un nouvel article</h1>
			<div id="managerBlock">
				<p class="returnLink btn btn-warning mr-3 mb-2"><a href="index.php?action=admin">Retour au menu</a></p>
					<div class="form-group">
						<form id="form-article" action="index.php?action=submitPost" method="post">
							<label for="title">Titre : <small id="pseudodHelpBlock" class="text-muted">(Privilégiez un titre court et pertinent)</small></label>
							<input type="text" name="title" id="title" placeholder="Saisissez votre titre ici" required  /><br/>
							<textarea name="content" rows="10" placeholder="Saisissez votre texte ici"  ></textarea>
							<input type="submit" class="btn btn-primary mr-3 mb-2" value="Publier" />
						</form>
					</div>
			</div>
	</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>