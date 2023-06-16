<?php
require 'header.php';
?>

    <title>Modification de la réservation</title>
</head>
<body>

<?php

$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    if (isset($_GET['reserv_id'])) {
        $reserv_id = $_GET['reserv_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'annuler') {
            $requeteSuppression = $mabd->prepare("DELETE r.*, t.* FROM reservations AS r
                                                  INNER JOIN trajets AS t ON r._traj_id = t.traj_id
                                                  WHERE r.reserv_id = :reserv_id AND r._user_id = :user_id");
            $requeteSuppression->bindParam(':reserv_id', $reserv_id);
            $requeteSuppression->bindParam(':user_id', $user['user_id']);

            if ($requeteSuppression->execute()) {
                echo '<p id="succes_annul_reservation">La réservation a été annulée avec succès.</p>';
            } else {
                echo '<p id="error_annul_reservation">Erreur lors de l\'annulation de la réservation.</p>';
            }
        }

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
            echo '<div id="modif_reservation">';
            echo "<p>Conducteur : " . htmlspecialchars($reservation['conducteur'], ENT_QUOTES, 'UTF-8') . "</p><br>";
            echo "<p>Date de départ : " . htmlspecialchars($reservation['traj_date'], ENT_QUOTES, 'UTF-8') . "</p><br>";
            echo "<p>Heure de départ : " . htmlspecialchars($reservation['traj_heure_depart'], ENT_QUOTES, 'UTF-8') . "</p><br>";
            echo "<p>Départ : " . htmlspecialchars($reservation['park_nom'], ENT_QUOTES, 'UTF-8') . "</p><br>";
            echo "<p>Arrivée : " . htmlspecialchars($reservation['traj_arrivee'], ENT_QUOTES, 'UTF-8') . "</p><br>";
            echo "<p>Modèle de voiture : " . htmlspecialchars($reservation['user_car'], ENT_QUOTES, 'UTF-8') . "</p><br>";
            echo '</div>';

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
</body>
</html>

<?php
require 'footer.php';
?>
