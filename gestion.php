<html>
    
    <?php require 'classes/util.php';
    if (isset($_GET['id']) && isset($_SESSION['connect'])) {

        $tables = array();
        $info = $bdd->infoBase($_GET['id']);
        $ip = $info[0];
        $port = $info[1];
        $nom = $info[2];
        $mdp = $info[3];

        $mabdd = new baseDD($ip, $port, $nom, $_SESSION['ndc'], $mdp);
        ?>
    <head>
        
    </head>
    <body>
        <header></header>
        <?php
        $resultat = $mabdd->listeTable();

        while ($donnees = $resultat->fetch()) {
            array_push($tables,new table($donnees['tablename'],$mabdd->getConnexion()));
            ?>
            <div class="listeTable">
            <h1><a href="affichagetable.php?id=<?php echo $_GET['id']; ?>&table=<?php echo $donnees['tablename']; ?>"><?php echo $donnees['tablename']; ?></a></h1>
            </div>
            <?php

        }
        if (isset($_GET['success'])) {
                if ($_GET['success'] == 'true') {
                    echo "<h1>Commande réussite</h1>";
                } else {
                    echo "<h1>Commande non valide</h1>";
                }
            
        }
        ?>
            
            <form action="commande.php" method="post">
                    <h1>Execution de commande</h1>
                        <input type="text" name="cmd" id="cmd" required>
                        <input type="hidden" name="idbdd" id="idbdd" value="<?php echo $_GET['id']; ?>">
                        <input type="submit" value="Executer">
                    </form>
            <?php

        } else {
            header("Location: index.php");
            exit();
        }
        ?>
        <footer> </footer >
    </body >
</html >