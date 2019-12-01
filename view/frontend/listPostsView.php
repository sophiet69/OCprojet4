<!--affiche la page/les informations :vue -->
<?php $title = 'Les chapitres de Billet simple pour l\'alaska'; ?>

<?php ob_start(); ?>
        

<header id="billet-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="main-title text-center text-white d-inline-block position-relative">Billet simple pour l'Alaska</h1>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-8 offset-lg-2 title-alaska">
                <h2 class="text-center text-white">Découvrez les chapitres :</h2>
            </div>
            
        </div>
    </div>
</header>

            
 
<section id="chapitres">
<p>Voici les chapitres qui compose le nouveau roman de Jean Forteroche, "Billet simple pour l'Alaska".</p>        
<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
<!--short open tags -->
            <?= htmlspecialchars($data['title']) ?> 
<!-- au lieu de     < ? php echo htmlspecialchars($data['title']); ? > -->
            <br>publié le <?= $data['creation_date_fr'] ?>
        </h3>
            
        <p>
           
           <?= substr($data['content'], 0, 200)  ?>...
            <br />
            <em><a href="index.php?action=post&amp;id=<?=htmlspecialchars($data['id']) ?>" class="d-block d-md-inline-block btn btn-lg btn-primary mb-3" role="button">Lire la suite</a></em>
        </p>
    </div>
    
    
<?php
}

$posts->closeCursor();

    if ($nbPage>=2){

?>

<div id="pageFrame">
   <!--
        <ul class="pagination pagination-sm"> </ul>
-->

<?php
        for ($i = 1; $i <= $nbPage; $i++) {
            if ((!isset($_GET['page']) && $i == 1) || (isset($_GET['page']) && $_GET['page'] == $i)) {
                echo "<span class='cPageFrame'>$i</span>";
            } else {
                echo "<a class='pageBlock' href=\"index.php?action=listPosts&amp;page=$i\">$i</a>";
            }
        }
    }
?>
</div>



</section>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>