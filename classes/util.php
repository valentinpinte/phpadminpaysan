<?php
    session_start();
    
    require 'BaseDD.php';
    require 'menu.php';
    require 'table.php';
    $bdd = new BaseDD("localhost","5432","gestionBDD","root","root");
   

    function ajoutBase(String $ip,String $port,String $nom,String $mdp){
        
        $bdd = new BaseDD("localhost","5432","gestionBDD","root","root");
        $requete = $bdd->getConnexion()->prepare("INSERT INTO base(ip,port,nom) VALUES (:ip,:port,:nom)");
        $requete->bindParam(":ip", $ip);
        $requete->bindParam(":port", $port);
        $requete->bindParam(":nom", $nom);
        $requete->execute();

    

        $sql = "SELECT id FROM base where ip like '" . $ip . "' and nom like '" . $nom . "' and port like '" . $port . "'";
        $resultat = $bdd->getConnexion()->query($sql);
        $idbase = $resultat->fetch();
     

        $sql = "SELECT id FROM compte where ndc like '" . $_SESSION['ndc'] . "'";
        $resultat = $bdd->getConnexion()->query($sql);
        $iduser = $resultat->fetch();
      
       
        $requete = $bdd->getConnexion()->prepare("INSERT INTO correspondance(compte,base,mdp) VALUES (:idU,:idB,:mdp)  ");
        $requete->bindParam(":idU", $iduser[0]);
        $requete->bindParam(":idB", $idbase[0]);
        $requete->bindParam(":mdp", $mdp);
        $requete->execute();
       
        header("Location:index.php");
        
    exit();
    }

    function suppressionBase(int $idbase){
        $bdd = new BaseDD("localhost","5432","gestionBDD","root","root");
        $sql = "SELECT id FROM compte where ndc like '" . $_SESSION['ndc'] . "'";
        $resultat = $bdd->getConnexion()->query($sql);
        $iduser = $resultat->fetch();

        $requete = $bdd->getConnexion()->prepare("delete from correspondance where compte = :ndc and base = :idbase  ");
        $requete->bindParam(":ndc", $iduser[0]);
        $requete->bindParam(":idbase", $idbase);
        $requete->execute();
        

    }

    function avatar(){
        
        $bdd = new BaseDD("localhost","5432","gestionBDD","root","root");
        $image = $bdd->getImg($_SESSION['ndc']);
        if($image != NULL){
            //echo "<img src=data:image/jpg;base64,$image>";
            ?>
                <img src="<?php echo $image ?>"/>
            <?php
        }
        
     
    }
?>



