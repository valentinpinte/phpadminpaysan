<?php

?>

<link rel="stylesheet" href="style.css">

<div class="menu">
<ul>
<?php
ob_start();
if (isset($_SESSION['ndc'])) {
    echo "<p>Salut " . $_SESSION['ndc'] . "</p>";
    avatar();
} else {
    echo "<p>Pas connecté</p>";
}
if ($dossier = opendir('./')) {
    while (false !== ($fichier = readdir($dossier))) {
        if ($fichier != '.' && $fichier != '..' && $fichier != "classes" && $fichier != "commande.php" && $fichier != "gestion.php" && $fichier != "affichagetable.php" && $fichier != "style.css" && $fichier != "menu.php" ) {
            ?>
            
            <?php
            if((isset($_SESSION['ndc']) && $fichier != 'connexion.php' && $fichier != 'register.php')||(!isset($_SESSION['ndc']) && $fichier != 'deconnexion.php')){
                $nom = explode('.',$fichier);
                echo "<li><a href=$fichier>$nom[0]</a></li>";
            }
            ?>
           
            <?php

        }
    }
}
ob_end_flush();
?>
 </ul>
</div>
