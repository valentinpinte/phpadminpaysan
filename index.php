<html>
    
    <?php require 'classes/util.php'; ?>
    <head>
        
    </head>
    <body>
        <header></header>
        <?php 
        if (!isset($_SESSION['connect']) && !isset($_POST['ndc'])) {
            ?>
                
                    <form action="index.php" method="post">
                    <h1>Connexion</h1>
                        <p>Nom du compte</p>
                        <input type="text" name="ndc" id="ndc" required>
                        <p>Mot de passe</p>
                        <input type="password" name="mdp" id="mdp" required>
                        <p>Avatar</p>
                       
                        <input type="submit" value="Se connecter">
                    </form>
                    <a href="register.php">Se créer un compte </a>
                <?php

            } else if (!isset($_SESSION['connect']) && isset($_POST['ndc'])) {
                if ($bdd->checkConnexion($_POST['ndc'], $_POST['mdp'])) {
                    $_SESSION['ndc'] = $_POST['ndc'];
                    $_SESSION['connect'] = true;
                    header("Location:index.php");
                    exit();
                } else {
                }
            } else {
                $resultat = $bdd->getBase();

                while ($donnees = $resultat->fetch()) {
                    ?>
                <div class="listebdd">
                    <h1><a href="gestion.php?id=<?php echo $donnees['id']; ?>"> <?php echo $donnees['nom']; ?><a/></h1>
                    <p>Ip : <?php echo $donnees['ip']; ?></p>
                    <p>Port : <?php echo $donnees['port']; ?></p>
                    <p>Mdp : <?php echo $donnees['mdp']; ?></p>
                    <p><a href="suppression.php?id=<?php echo $donnees['id']; ?>">Supprimer</a></p>
                </div>
                <?php
                
                

            }
            ?>
             <a href="ajout.php" >Ajouter une base </a>
            <?php
        }
            ?>
       
        <footer>

        
        </footer>
    </body>
    <?php  require 'menu.php'; ?>
</html>