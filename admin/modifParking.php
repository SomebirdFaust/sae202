<!DOCTYPE html>
<html>
<head>
    <title>Modification d'un parking</title>
</head>
<body>
<a href="gestion.php" >retour</a> 	
<hr> <h1>Modification d'un parking</h1> <hr>


<form class="formulaire" method="POST" enctype="multipart/form-data" action="modifValideParking.php">
     <?php
    $num = $_GET['num'];
    $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
    $mabd->query('SET NAMES utf8;');
    $req = "SELECT * FROM  parkings WHERE park_id=$num";
    $resultat = $mabd->query($req);
    $park= $resultat->fetch();
    echo $park['park_nom'];
    ?>
    <hr>
    <input type="hidden" name="num"  value="<?php echo $park['park_id']; ?>">
    Nom : <input type="text" name="nom" value="<?php echo $park['park_nom'] ?>"><br>
    Adresse : <input type="text" name="loc" value="<?php echo $park['park_loc'] ?>"><br>
    <br>   
    <input type="submit" name="" value="Enregistrer">

</form>


</body>
</html>