<html>


    <head>
        
    </head>
<?php
require "classes/util.php";
if (isset($_GET['success'])) {
    if ($_GET['success'] == "true") {
        echo "<h1>Compte crée</h1>";
    } else {
        echo "<h1>Erreur création</h1>";
    }
} elseif (isset($_POST['ndc']) && (isset($_POST['mdp']))) {
    if (isset($_FILES['image'])) {

        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(end(explode('.', $file_name)));

        $file_tmp = $_FILES['image']['tmp_name'];

        $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
        $data = file_get_contents($file_tmp);
        $base64 = base64_encode($data);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    $hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $requete = $bdd->getConnexion()->prepare("INSERT INTO compte(ndc,mdp,img) VALUES (:nom,:mdp,:img)");
    $requete->bindParam(":nom", $_POST['ndc']);
    $requete->bindParam(":mdp", $hash);
    $requete->bindParam(":img", $base64);
    $val = $requete->execute();
    if ($val) {
        header("Location:register.php?success=true");
    } else {
        header("Location:register.php?success=false");
    }

    exit();
} else {

}
?>
<form method="post" action="register.php" enctype="multipart/form-data">
<h1>Création de compte</h1>
<p>Nom de compte
<input type="text" name="ndc" required /></p>

<p>Mot de passe
<input type="password" name="mdp" required></p>
<p>Image
<input type="file" name="image" id="image" accept="image/png"></p>
<input type="submit" />
 

</form>