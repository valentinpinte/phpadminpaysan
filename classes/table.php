<?php
class table
{
    private $nom;
    private $connexion;

    function __construct(String $nom, PDO $connexion)
    {
        $this->nom = $nom;
        $this->connexion = $connexion;
    }
    public function affichage()
    {
        $sql = "select * from " . $this->nom;
        $resultat = $this->connexion->query($sql);

       
        if ($resultat != null) {
            echo "<table>";
            while ($donnees = $resultat->fetch()) {
                $tailleTab = (count($donnees)) / 2;

                echo "<tr>";


                for ($x = 0; $x < $tailleTab; $x++) {
                    echo "<td>" . $donnees[$x] . "</td>";
                }



                echo "</tr>";
               
            }
            echo "</table>";

        }else{
            header("Location: index.php");
            exit();
        }
    }
}
?>      