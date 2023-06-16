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


?>

</body>
</html>