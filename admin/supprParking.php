<!DOCTYPE html>
<html>
<head>
<title>Suppression d'un parking</title>
</head>
<body>
<a href="gestion.php">retour</a> 	
<hr> <h1>Suppression d'un parking</h1> <hr>

<?php 
require 'lib.inc.php';
?>

<?php
$num=$_GET['num'];
$park_nom=$_GET['park_nom'];

$mabd = connexionBD();
$mabd->query('SET NAMES utf8;');

$req = 'DELETE FROM parkings WHERE park_id='. $num; 

echo '<h2>Vous venez de supprimer le '.$park_nom.'.</h2>';

$resultat = $mabd->query($req);

try {
    $mabd = connexionBD();
    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_id = :user_id');
    $req->execute(array(':user_id' => $user_id));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $req = $mabd->prepare('DELETE FROM utilisateurs WHERE user_id = :user_id');
        $req->execute(array(':user_id' => $user_id));

        header('location: ../index.php?deleted=1');
        exit();
    } else {
        echo "Utilisateur non trouvé !";
        header('location: ../modifProfil.php?erreur=1');
        exit();
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}


?>

</body>
</html>