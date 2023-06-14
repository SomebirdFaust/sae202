<?php 
require 'lib.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation d'ajout</title>
</head>
<body>
    <a href="gestion.php">retour</a> 	
    <hr> <h1>Confirmation d'ajout</h1> <hr>
    <h2>Vous venez d'ajouter un parking</h2>
    <hr>
    
    <?php
    $num=$_POST['num'];
    $nom=$_POST['nom'];
    $loc=$_POST['loc'];

    $mabd = connexionBD();
    $mabd->query('SET NAMES utf8;');

    $req = 'INSERT INTO parkings (`park_nom`,`park_loc`) VALUES("'. $nom .'" , "'. $loc.'")';
    $resultat = $mabd->query($req);
    ?>

</body>
</html>
