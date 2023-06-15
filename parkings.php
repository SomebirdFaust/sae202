<?php
    require 'header.php';
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parkings</title>
</head>
<body>
<?php
    $mabd = connexionBD();
    $requete = $mabd->query("SELECT park_nom FROM parkings");
    while ($park = $requete->fetch()) {
    $parkingNom = $park['park_nom'];
    echo "<option value='$parkingNom'>$parkingNom</option>";
    }
?>

<?php
    require 'footer.php';
?>
</body>
</html>