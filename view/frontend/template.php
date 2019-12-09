
<?php

if (empty($_SESSION['id'])){

	$connected = false;
}else{
	$connected = true;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="public/images/logo.png"/>
		<!--SEO A FAIRE-->
		<!-- Metadescription 
		<meta name="description" content="Location de vélos à Lyon : sélectionnez votre station et reservez votre vélo dans la région lyonnaise. ">
		<meta name="keywords" content="vélo, vélos, location vélos, lyon, se déplacer à vélo" />-->
		<!-- Opengraph RESEAUX SOCIAUX Facebook
		<meta property="og:title" content="Location de vélos à Lyon" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="https://locationvelo.000webhostapp.com/" />
		<meta property="og:image" content="https://locationvelo.000webhostapp.com/images/logoVelo70x70.png" />
		<meta property="og:description" content="Location de vélos à Lyon : sélectionnez votre station et reservez votre vélo dans la région lyonnaise." />-->
		<!-- Twitter card 
		<meta name='twitter:card' content='summary' />
		<meta name='twitter:site' content='@locationvelo' />
		<meta name='twitter:title' content='Location de vélos à Lyon' />
		<meta name='twitter:description' content='Location de vélos à Lyon : sélectionnez votre station et reservez votre vélo dans la région lyonnaise.'/>
		<meta name='twitter:image' content='https://locationvelo.000webhostapp.com/images/logoVelo70x70.png' />-->

		
		<!-- Google Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Lemonada" rel="stylesheet">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="public/css/style.css" rel="stylesheet" />
	    

	     
	</head>

	        
	<body>
		<div id="bloc-page">
			<nav class="navbar navbar-expand-md navbar-light fixed-top">
	      		<!-- LOGO -->
	      		<a class="navbar-brand" href="#">
	        		<img src="public/images/logo.png" class="logo" alt="Blog d'un écrivain" title="Blog d'un écrivain"/>
	      		</a>
	      		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
	        		<i class="fas fa-bars fa-lg"></i>
	      		</button>
	      		<!-- NAV -->
	      		<div class="collapse navbar-collapse justify-content-center" id="myNavbar">
			        <ul class="nav nav-pills navbar-nav ">
			          <li class="nav-item ">
			            <a class="nav-link" href="index.php?action=home">ACCUEIL</a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link" href="index.php?action=listPosts">CHAPITRES</a>
			          </li>
			          <li class="nav-item">
			            <a class="nav-link " href="index.php?action=login">SE CONNECTER</a><!-- A FAIRE-->
			          </li>
			        </ul>
	      		</div>
	    	</nav>
			<!-- content -->
		    <?= $content ?>
	    </div>
	</body>

	<footer class="text-center">
		<a href="#">
      		<span class="fas fa-chevron-up"></span>
    	</a>
    	<p>Copyright © 2019. Tous droits réservés. Réalisé par Sophie TORRESAN. <br>Les chapitres utilisés sont largement inspirés du Roman de Paul Bourget: VOYAGEUSES (1897) - texte libre de droit</p>
	</footer>
</html>
