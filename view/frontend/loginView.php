<!--affiche la page/les informations :vue -->
<?php $title = 'Se connecter | Blog de Jean Forteroche'; ?>

<?php ob_start(); ?>
        

<section id="connect">
    <div class="container">
        <div class="row" >
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3 login-content pb-5 px-5">
                <form id="form-login" action="index.php?action=login" method="post">

                    <div class="form-group mt-5">
                       <?php if($error) { ?>
                            <p class="ext-center text-danger mt-3">Mauvais identifiant ou mot de passe. Merci de réessayer.</p>
                        <?php } ?>

                        <label for="pseudo" >Votre identifiant</label><br>
                        <input type="text" value="" class="form-control" name="pseudo" id="pseudo" placeholder="Veuillez saisir votre identifiant" required="">
                    </div>
                    <div class="form-group">
                        <label for="password" >Mot de passe</label>
                        <input type="password" value="" class="form-control" name="pass" id="pass" placeholder="Veuillez saisir votre mot de passe" required="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3 float-none float-md-right">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script src="public/js/login.js"></script>



<?php require('template.php'); ?>
