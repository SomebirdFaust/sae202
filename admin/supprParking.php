<!DOCTYPE html>
<html>
<head>
<title>Suppression d'un parking</title>
</head>
<body>
<a href="gestion.php">retour</a> 	
<hr> <h1>Suppression d'un parking</h1> <hr>

<?php
// recupérer dans l'url l'id du parking à supprimer
$num=$_GET['num'];
$park_nom=$_GET['park_nom'];

$mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
$mabd->query('SET NAMES utf8;');

// tapez ici la requete de suppression du parking dont l'id est passé dans l'url
$req = 'DELETE FROM parkings WHERE park_id='. $num; 

// cette ligne sert juste pour le debug. à supprimer quand tout marche correctement  

//echo $req;

echo '<h2>Vous venez de supprimer le '.$park_nom.'.</h2>';

$resultat = $mabd->query($req);
?>

</body>
</html>