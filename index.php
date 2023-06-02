<?php
$mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
$mabd->query('SET NAMES utf8;');
$req = "SELECT * FROM  utilisateur ";
$resultat = $mabd->query($req);
//
?>