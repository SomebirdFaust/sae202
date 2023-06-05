<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de modification</title>
</head>
<body>
    <a href="gestion.php">retour</a>
    <h1>Modification du parking</h1>
    <p>La modification a bien été enregistrée!</p>
    
    <?php
    $num=$_POST['num'];
    $nom=$_POST['nom'];
    $loc=$_POST['loc'];


    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
    $mabd->query('SET NAMES utf8;');



    $req = "UPDATE parkings SET park_nom = '$nom' , park_loc = '$loc' WHERE park_id = '$num' ";


    //echo 'juste pour le debug: '. $req;

    // Décommenter une fois la simulation fait
    $resultat = $mabd->query($req);


    ?>
    
</body>
</html>