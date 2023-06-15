<?php
require 'header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de réservation</title>
</head>
<body>

<?php
$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    // Vérifier si l'ID de réservation est présent dans la requête GET
    if (isset($_GET['reserv_id'])) {
        $reserv_id = $_GET['reserv_id'];

        // Requête pour récupérer les détails de la réservation
        $requeteReservation = $mabd->prepare("SELECT t.traj_id, t.traj_date, p.park_nom, t.traj_arrivee, u.user_car, CONCAT(u.user_nom, ' ', u.user_prenom) AS conducteur 
                                              FROM trajets AS t
                                              INNER JOIN utilisateurs AS u ON t._user_id = u.user_id
                                              INNER JOIN reservations AS r ON t.traj_id = r._traj_id
                                              INNER JOIN parkings AS p ON t._park_id = p.park_id
                                              WHERE r._user_id = :user_id AND t.traj_id = :reserv_id");
        $requeteReservation->bindParam(':user_id', $user['user_id']);
        $requeteReservation->bindParam(':reserv_id', $reserv_id);
        $requeteReservation->execute();

        $reservation = $requeteReservation->fetch();

        if ($reservation) {
            // Afficher les détails de la réservation
            echo "Conducteur : " . $reservation['conducteur'] . "<br>";
            echo "Date de départ : " . $reservation['traj_date'] . "<br>";
            echo "Départ : " . $reservation['park_nom'] . "<br>";
            echo "Arrivée : " . $reservation['traj_arrivee'] . "<br>";
            echo "Modèle de voiture : " . $reservation['user_car'] . "<br>";

            // Formulaire de modification de la réservation
            echo "<form action='modifReservationVerif.php' method='post'>";
            echo "<input type='hidden' name='reserv_id' value='" . $reservation['traj_id'] . "'>";
            // Ajoutez ici les champs supplémentaires pour la modification de la réservation
            echo "<button type='submit'>Modifier</button>";
            echo "</form>";
        } else {
            echo "Réservation non trouvée.";
        }
    } else {
        echo "ID de réservation non spécifié.";
    }

    deconnexionBD($mabd);
} else {
    echo "Vous n'êtes pas connecté(e) !";
}

?>

<?php
require 'footer.php';
?>

</body>
</html>
