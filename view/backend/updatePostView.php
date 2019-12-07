<?php 
$title = "Modifier un article"; ?>

<?php ob_start(); ?>

<section id="adminPanel">
	<h1 id="update-article-title" class="mt-3 mb-5">Modifier un article</h1>
	<div id="managerBlock">

		<p class="returnLink btn btn-warning mr-3 mb-2"><a href="index.php?action=admin">Retour au menu</a></p>
		<div id="updateBlock">
			<div class="form-group">
				<form action="index.php?action=submitUpdate&amp;id=<?= $post['id']; ?>" method="post">
					<label for="title">Titre : <small id="pseudodHelpBlock" class="text-muted">(Choisissez un titre court et pertinent)</small></label>
					<input type="text" class="form-control "name="title" id="title" placeholder="Saisissez votre titre ici" value="<?= $post['title'];?>" /><br/>
					<textarea name="content" class="form-control" rows="20" placeholder="Saisissez votre texte ici"><?= nl2br($post['content']);?></textarea>
					<input type="submit" class="btn btn-primary mr-3 mb-2" value="Enregistrer les Modifications" />
				</form>
			</div>
		</div>
	</div>

</section>


<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>