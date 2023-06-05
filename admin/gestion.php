<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles.css">
    <title>Gestion</title>
</head>
<body>
    <a href="../index.php">retour </a>
    <hr> <h1>Gestion des parkings</h1> <hr>
    <thead>
        <tr><td>N° d'authentification</td><td>Nom</td><td>Localisation</td>
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
        echo '</tr>';
    }
    ?>

        </tbody>
</body>
</html>


<?php
//include '../footer.php';
?>