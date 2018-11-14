
    
    <?php 
    session_start();
    require 'classes/BaseDD.php';
    require 'classes/table.php';

    $bdd = new BaseDD("localhost","5432","gestionBDD","root","root");
    
    if (isset($_POST['idbdd'])) {


        $info = $bdd->infoBase($_POST['idbdd']);
        $ip = $info[0];
        $port = $info[1];
        $nom = $info[2];
        $mdp = $info[3];

        $bddcmd = new baseDD($ip, $port, $nom, $_SESSION['ndc'], $mdp);

        //var_dump($bddcmd->commande($_POST['cmd']));
        //die();
        
        if ($bddcmd->commande($_POST['cmd']) != false) {
            
            header("Location: gestion.php?id={$_POST['idbdd']}&success=true");
            
        } else {
            
            header("Location: gestion.php?id={$_POST['idbdd']}&success=false");  
        }
        exit();
    } else {
        header("Location: index.php");
        exit();
    }
    
    
    ?>
 