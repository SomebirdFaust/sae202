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
$requete = $mabd->query("SELECT park_nom, park_loc, park_img FROM parkings");
echo '<div id="parking">';
echo '<h3>Les parkings :</h3>';
while ($park = $requete->fetch()) {
    $parkingNom = $park['park_nom'];
    $parkingAdresse = $park['park_loc'];
    $parkingImage = $park['park_img'];

    echo "<option value='$parkingNom'>$parkingNom</option>";
    echo "<option value='$parkingAdresse'>$parkingAdresse</option>";

    if (!empty($parkingImage)) {
        echo "<img src='$parkingImage' alt='Image du parking'>";
    }
}
echo '</div>';

deconnexionBD($mabd);
?>

</body>
</html>

<?php
    require 'footer.php';
?>