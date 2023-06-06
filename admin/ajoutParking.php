<!DOCTYPE html>
<html>
<head>
<title>Ajout d'un parking</title>
</head>
<body>
<a href="gestion.php">retour</a> 	
    <hr> <h1>Ajout d'un parking</h1> <hr>
<p>Complétez pour ajouter un nouveau parking</p>
<hr>
<form class="formulaire" action="ajoutValideParking.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="num"  value="<?php echo $park['park_id']; ?>">
    Nom du parking : <input type="text" name="nom" required="required"><br>
    Adresse complète : <input type="text" name="loc" required="required"><br>
    <input class="submit" type="submit" name="ajouter">
</form>

</tbody>
</table>
</body>
</html>