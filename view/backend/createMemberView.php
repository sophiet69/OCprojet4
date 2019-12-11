<?php 
$title = "Nouveau membre"; ?>

<?php ob_start(); ?>


<section id="createPost">
	<div class="container" id="bloc-page-newArticle">
		<h1 id="new-article-title" class="mt-3 mb-5">Ajouter un nouveau membre</h1>
			<div id="managerBlock">
				<p class="returnLink btn btn-warning mr-3 mb-2"><a href="index.php?action=admin">Retour au menu</a></p>
				
				<form action="index.php?action=submitMember" method="post">
					<label for="pseudo">Pseudo</label><br />
					<input type="text" name="pseudo" id="pseudo" required /><br />
					<label for="pass">Mot de passe</label><br />
					<input type="password" name="pass" id="pass" required /><br />
					
					
					<input type="submit" value="Ajouter" />
			
				</form>
					
			</div>
	</div>
</section>


<?php $content = ob_get_clean(); ?>

<?php require('templateBackend.php'); ?>