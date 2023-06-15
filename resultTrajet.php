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
$requete->execute([
    ':_park_id' => $depart,
    ':traj_arrivee' => $destination,
    ':traj_date' => $date
]);

// Vérifier si des résultats sont retournés
if ($requete->rowCount() > 0) {
    while ($resultat = $requete->fetch(PDO::FETCH_ASSOC)) {
        echo "Nom du conducteur : " . $resultat['user_nom'] . " " . $resultat['user_prenom'] . "<br>";
        echo "Date de départ : " . $resultat['traj_date'] . "<br>";
        echo "Heure de départ : " . $resultat['traj_heure_depart'] . "<br>";
        echo "Nombre de places disponibles : " . $resultat['traj_places'] . "<br>";
        echo "<a href='reservTrajet.php?trajet_id=" . $resultat['traj_id'] . "'>Réserver</a><br>";
    }
} else {
    echo '<div id="echec_result_trajet">';
    echo '<p>Je n\'ai pas trouvé de trajet correspondant à ta recherche.</p> <br>';
    echo '<p> Essaye d\'ajuster ta recherche ou reviens plus tard.</p>';
    echo '</div>';
    echo '<div id="echec_result_trajet_img">';
    echo '<img src="img/echec.png" alt="poussin tenant une pencarte échec">';
    echo '</div>';
}

$mabd = null;
?>

</body>
</html>

<?php require 'footer.php'; ?>
