<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/png" href="public/images/logo.png"/>
				
		<!-- Google Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Lemonada" rel="stylesheet">
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >

	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link href="public/css/styleBackend.css" rel="stylesheet" />
		<!--Tinymce-->
		<script src="public/js/tinymce/js/tinymce/tinymce.min.js" type="text/javascript"></script>
	    <script>
	        tinyMCE.init({
	            selector: 'textarea',
	            language: 'fr_FR',
	            content_css: ['//fonts.googleapis.com/css?family=Exo:300,400,700'],
	            content_style: "#tinymce {font-family: 'Exo', sans-serif !important; font-size: 18px}",
	            browser_spellcheck: true, //verif orthographe
	            contextmenu: false, // pour avoir le menu
	            
	            // update validation status on change : permet à tinymce de se valider à chaque changement
	            onchange_callback: function(editor) {
	                tinyMCE.triggerSave();
	                $("#" + editor.id).valid();
	            }
	        });
	    </script>
	    
	     
	</head>

	        
	<body>
		
			<!-- content -->
		    <?= $content ?>
	 
	</body>

	
</html>