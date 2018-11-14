<?php
class BaseDD
{
    private $connexion;
    private $nom;

    function __construct(String $ip, String $port, String $dbname, String $user, String $mdp)
    {
        if ($this->connexion == null) {
            $this->nom = $dbname;
            try {
                $this->connexion = new PDO("pgsql:host=" . $ip . ";port=" . $port . ";dbname=" . $dbname . ";user=" . $user . ";password=" . $mdp);

            } catch (PDOException $e) {
                //print "Erreur !: " . $e->getMessage() . "<br/>";
                print "Accès refusé !<br/>";
                die();
            }
        }
    }

    /**
     * Get the value of connexion
     */
    public function getConnexion()
    {
        return $this->connexion;
    }

    public function commande(String $cmd)
    {
       
        return $valeur = $this->connexion->query($cmd);
        
    }

    public function getImg(String $ndc){
        $resu = $this->connexion->query("SELECT img FROM compte WHERE ndc like '" . $ndc . "'");
        $img = $resu->fetch();
        return $img[0];
        
    }

    public function checkConnexion(String $ndc, String $mdp)
    {
        $sql = "SELECT ndc ,mdp FROM compte where ndc like '" . $ndc . "'";
        $resultat = $this->connexion->query($sql);

        $mdp_hash = $resultat->fetch();

        return password_verify($mdp, $mdp_hash['mdp']);
    }

    public function getBase(){
        $sql = "SELECT id FROM compte where ndc like '" . $_SESSION['ndc'] . "'";
        $resultat = $this->connexion->query($sql);
        $iduser = $resultat->fetch();
        $sql = "select b.id,b.nom ,b.ip,b.port ,c.mdp from correspondance c join base b on c.base=b.id where compte =  $iduser[0]";
        $resultat = $this->connexion->query($sql);

        return $resultat;
    }

    public function infoBase(String $id){
       
        $sql = "SELECT * FROM base where id =  {$id} " ;
        $resultat = $this->connexion->query($sql);
        $donnees = $resultat->fetch();
       
        $sql = "SELECT id FROM compte where ndc like '" . $_SESSION['ndc'] . "'";
        $resultat = $this->connexion->query($sql);
        $iduser = $resultat->fetch();
        
        $sql = "select mdp from correspondance where compte =  $iduser[0]  and base = {$id}";
        $resultat = $this->connexion->query($sql);
        $mdp = $resultat->fetch();
        $retour = array($donnees['ip'],$donnees['port'],$donnees['nom'],$mdp[0]);

        return $retour;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    public function listeTable(){
        $sql = "select * from pg_tables where schemaname like 'public'";
        $resultat = $this->connexion->query($sql);
        return $resultat;
    }


}
?>