<?php
require 'header.php';
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
</head>
<body>
<?php
$depart = $_POST['depart'];
$destination = $_POST['dest'];
$date = $_POST['date'];

$mabd = connexionBD();

$requete = $mabd->prepare("SELECT t.*, u.user_nom, u.user_prenom FROM trajets AS t
                          INNER JOIN utilisateurs AS u ON t._user_id = u.user_id
                          WHERE t._parking = :_parking AND t.traj_dest = :traj_arrivee AND t.traj_date > :date");
$requete->bindParam(':_parking', $depart);
$requete->bindParam(':traj_arrivee', $destination);
$requete->bindParam(':traj_date', $date);
$requete->execute();

while ($resultat = $requete->fetch()) {
    echo "Nom du conducteur : " . $resultat['user_nom'] . " " . $resultat['user_prenom'] . "<br>";
    echo "Date de départ : " . $resultat['traj_date'] . "<br>";
    echo "Heure de départ : " . $resultat['traj_heure_depart'] . "<br>";
    echo "Nombre de places disponibles : " . $resultat['traj_places'] . "<br>";
    echo "<a href='reservTrajet.php?trajet_id=" . $resultat['traj_id'] . "'>Réserver</a><br>";
}

$mabd = null;

$mabd = null;
?>

</body>
</html>