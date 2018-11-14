<html>
    
    <?php require 'classes/util.php'; ?>
    <head>
        
    </head>
    <body>
        <header></header>
        <?php 
           if(!isset($_SESSION['ndc'])){
            header("Location:index.php");
            exit();
           }else if(!isset($_POST['ip'])){
               ?>
                    <form action="ajout.php" method="post">
                        <p>Ip bdd</p>
                        <input type="text" name="ip" id="ip">
                        <p>Port</p>
                        <input type="text" name="port" id="port">
                        <p>Nom</p>
                        <input type="text" name="nom" id="nom">
                        <p>Mot de passe</p>
                        <input type="password" name="mdpbdd" id="mdpbdd">
                        <input type="submit" value="Enregistrer">
                    </form>
               <?php
           }else if(isset($_POST['ip'])){
               ajoutBase($_POST['ip'],$_POST['port'],$_POST['nom'],$_POST['mdpbdd']);
               header("Location:index.php");
               exit();
           }
        ?>
        <footer></footer>
    </body>
</html>