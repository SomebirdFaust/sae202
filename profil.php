<?php 
    require 'admin/lib.inc.php';
    require 'header.php';
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>


<?php

$mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
$mabd->query('SET NAMES utf8;');

$req = "SELECT * FROM utilisateurs";
$resultat = $mabd->query($req);

//INFOS PERSONNELLES DE L'UTILISATEUR
//POTENTIELLEMENT UTILISER DES VARIABLES DE SESSION POUR RÉCUPÉRER LES INFOS DE CONNEXION 
//POUR SAVOIR LES INFOS DE QUEL USER AFFICHER (AVEC SON ID)
//MERCI FAUST :)

    echo '<div id="infos_profil">' ;
        echo '<img src="img/avatar.png" alt="avatar">';
        //echo '<p>' . ['user_prenom'] . '</p>';
        //echo '<p>' . ['user_nom'] . '</p>';
        //echo '<p>' . ['user_mail'] . '</p>';
    echo '</div>';

//BIOGRAPHIE DE L'UTILISATEUR
//MEME PRINCIPE
    echo '<div id="bio_profil">' ;
        //echo '<p>' . ['user_bio'] . '</p>';
    echo '</div>' ;

//VOITURE DE L'UTILISATEUR
//TOUJOURS PAREIL
echo '<div id="bio_profil">' ;
    //echo '<p>' . ['user_car'] . '</p>';
echo '</div>' ;

?>

<a href="modifProfil.php" class="button">Modifier le profil</a>
<button onclick="user_deco()">Se déconnecter</button>


<?php
require 'footer.php';
?>

</body>
</html>

   