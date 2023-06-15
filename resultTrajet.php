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

try {
    $mabd = connexionBD();

    $requete = $mabd->prepare("SELECT t.*, u.user_nom, u.user_genre, u.user_prenom, u.user_car, p.park_nom FROM trajets AS t
                              INNER JOIN utilisateurs AS u ON t._user_id = u.user_id
                              INNER JOIN parkings AS p ON t._park_id = p.park_id
                              WHERE p.park_nom = :depart AND t.traj_arrivee = :destination AND t.traj_date >= :date");
    $requete->bindParam(':depart', $depart);
    $requete->bindParam(':destination', $destination);
    $requete->bindParam(':date', $date);
    $requete->execute();

    // Vérifier si des résultats sont retournés
    if ($requete->rowCount() > 0) {
        echo '<h3 id="h3_resultat_trajet">Résultat(s) de la recherche : </h3>';
        while ($resultat = $requete->fetch()) {
            echo '<div id="resultat_ok">';
            echo "<p>Nom du conducteur : " . $resultat['user_nom'] . " " . $resultat['user_prenom'] . "</p><br>";
            echo "<p>Pronoms : " . $resultat['user_genre'] . "</p><br>";
            echo "<p>Voiture : " . $resultat['user_car'] . "</p><br>";
            echo "<p>Date de départ : " . $resultat['traj_date'] . "</p><br>";
            echo "<p>Heure de départ : " . $resultat['traj_heure_depart'] . "</p><br>";
            echo "<p>Nombre de places disponibles : " . $resultat['traj_places'] . "</p><br>";
            echo "<p>Lieu de départ : " . $resultat['park_nom'] . "</p><br>";
            echo '<div id="reserver_trajet_bouton">';
            echo "<a href='reservTrajet.php?trajet_id=" . $resultat['traj_id'] . "'>Réserver</a>";
            echo '</div>';
            echo '</div>';
        }
        echo '<br><br><br>';
    } else {
        echo '<div id="echec_result_trajet">';
        echo '<p>Je n\'ai pas trouvé de trajet correspondant à ta recherche.</p> <br>';
        echo '<p> Essaye d\'ajuster ta recherche ou reviens plus tard.</p>';
        echo '</div>';
        echo '<div id="echec_result_trajet_img">';
        echo '<img src="img/echec.png" alt="poussant tenant une pancarte échec">';
        echo '</div>';
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>


</body>
</html>

<?php require 'footer.php'; ?>
