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
                          WHERE t._park_id = :_park_id AND t.traj_arrivee = :traj_arrivee AND t.traj_date > :traj_date");
$requete->bindParam(':_park_id', $depart);
$requete->bindParam(':traj_arrivee', $destination);
$requete->bindParam(':traj_date', $date);
$requete->execute();

// Vérifier si des résultats sont retournés
if ($requete->rowCount() > 0) {
    while ($resultat = $requete->fetch()) {
        echo "Nom du conducteur : " . $resultat['user_nom'] . " " . $resultat['user_prenom'] . "<br>";
        echo "Date de départ : " . $resultat['traj_date'] . "<br>";
        echo "Heure de départ : " . $resultat['traj_heure_depart'] . "<br>";
        echo "Nombre de places disponibles : " . $resultat['traj_places'] . "<br>";
        echo "<a href='reservTrajet.php?trajet_id=" . $resultat['traj_id'] . "'>Réserver</a><br>";
    }
} else {
    echo "Aucun trajet correspondant.";
}

$mabd = null;
?>

</body>
</html>