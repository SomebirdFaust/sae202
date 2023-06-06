<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
</head>
<body>
    <a href="../index.php">retour </a>
    <hr> <h1>Gestion des parkings</h1> <hr>
    <a href="ajoutParking.php">Ajouter un parking</a>
    <table border=1 class="table">
    <thead>
        <tr><td>N° d'authentification</td><td>Nom</td><td>Localisation</td><td>Modifier</td><td>Supprimer</td>
    </thead>
    <tbody>
    <?php
    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
    $mabd->query('SET NAMES utf8;');
    $req = "SELECT * FROM parkings";
    $resultat = $mabd->query($req);

    foreach ($resultat as $value) {
        echo '<tr>' ;
        echo '<td>'.$value['park_id'] . '</td>';
        echo '<td>' . $value['park_nom'] . '</td>';
        echo '<td>' . $value['park_loc'] . '</td>';
        echo '<td> <a href="supprParking.php?num='.$value['park_id'].'&park_nom='.$value['park_nom'].'" > supprimer </a> </td>';
        echo '<td> <a href="modifParking.php?num='.$value['park_id'].'&park_nom='.$value['park_nom'].'" > modifier </a> </td>';
        echo '</tr>';
    }
    ?>

        </tbody>
</body>
</html>


<?php
//include '../footer.php';
?>