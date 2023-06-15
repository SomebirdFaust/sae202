<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de la réservation</title>
</head>
<body>

<div id="modif_reservation">

<?php

$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    if (isset($_GET['reserv_id'])) {
        $reserv_id = $_GET['reserv_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'annuler') {
            // Supprimer la réservation et toutes ses données de la base de données
            $requeteSuppression = $mabd->prepare("DELETE r.*, t.* FROM reservations AS r
                                                  INNER JOIN trajets AS t ON r._traj_id = t.traj_id
                                                  WHERE r.reserv_id = :reserv_id AND r._user_id = :user_id");
            $requeteSuppression->bindParam(':reserv_id', $reserv_id);
            $requeteSuppression->bindParam(':user_id', $user['user_id']);

            if ($requeteSuppression->execute()) {
                echo '<p id="succes_annul_reservation">La réservation a été annulée avec succès.</p>';
            } else {
                echo '<pid="error_annul_reservation">Erreur lors de l\'annulation de la réservation.</p>';
            }
        }

        // Requête pour récupérer les détails de la réservation
        $requeteReservation = $mabd->prepare("SELECT t.traj_id, t.traj_date, t.traj_heure_depart, p.park_nom, t.traj_arrivee, u.user_car, CONCAT(u.user_nom, ' ', u.user_prenom) AS conducteur 
                                              FROM trajets AS t
                                              INNER JOIN utilisateurs AS u ON t._user_id = u.user_id
                                              INNER JOIN reservations AS r ON t.traj_id = r._traj_id
                                              INNER JOIN parkings AS p ON t._park_id = p.park_id
                                              WHERE r._user_id = :user_id AND r.reserv_id = :reserv_id");
        $requeteReservation->bindParam(':user_id', $user['user_id']);
        $requeteReservation->bindParam(':reserv_id', $reserv_id);
        $requeteReservation->execute();

        $reservation = $requeteReservation->fetch();

        if ($reservation) {
            // Afficher les détails de la réservation
            echo '<div id="modif_reservation">';
            echo "<p>Conducteur : " . $reservation['conducteur'] . "</p><br>";
            echo "<p>Date de départ : " . $reservation['traj_date'] . "</p><br>";
            echo "<p>Heure de départ : " . $reservation['traj_heure_depart'] . "</p><br>";
            echo "<p>Départ : " . $reservation['park_nom'] . "</p><br>";
            echo "<p>Arrivée : " . $reservation['traj_arrivee'] . "</p><br>";
            echo "<p>Modèle de voiture : " . $reservation['user_car'] . "</p><br>";
            echo '</div>';

            // Formulaire d'annulation de la réservation
            echo '<div id="annul_reservation">';
            echo "<form action='modifReservation.php?reserv_id=$reserv_id' method='post'>";
            echo "<input type='hidden' name='action' value='annuler'>";
            echo "<button type='submit'>Annuler la réservation</button>";
            echo "</form>";
            echo '</div>';

            
        }
    }

    deconnexionBD($mabd);
}

?>
    </div>
</body>
</html>

<?php
require 'footer.php';
?>
