<html>
   

    <?php require 'classes/util.php';
   
    if(isset($_GET['id']) && isset($_GET['table']) && isset($_SESSION['connect'])){


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
            $maTable = new table($_GET['table'],$mabdd->getConnexion());
            $maTable->affichage();
           }else{
               header("Location: index.php");
               exit();
           }

        ?>
        <footer> </footer >
    </body >
    
</html >