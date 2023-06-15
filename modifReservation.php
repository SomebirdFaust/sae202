<?php
require 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// Vérifier si l'ID de la réservation a été transmis
if(isset($_GET['reserv_id'])) {
    $reservation_id = $_GET['reserv_id'];

    $mabd = connexionBD();

    // Récupérer les informations de la réservation
    $requeteReservation = $mabd->prepare("SELECT * FROM reservations WHERE reserv_id = :reserv_id");
    $requeteReservation->bindParam(':reserv_id', $reservation['_reserv_id']);
    $requeteReservation->execute();
    $reservation = $requeteReservation->fetch();

    if($reservation) {
        // Récupérer le trajet correspondant à la réservation
        $requeteTrajet = $mabd->prepare("SELECT * FROM trajets WHERE traj_id = :trajet_id");
        $requeteTrajet->bindParam(':trajet_id', $reservation['_traj_id']);
        $requeteTrajet->execute();
        $trajet = $requeteTrajet->fetch();

        if($trajet) {
            // Vérifier si l'utilisateur souhaite annuler la réservation
            if(isset($_POST['annuler'])) {
                // Annuler la réservation et libérer les places réservées
                $places_dispo = $trajet['traj_places'] + $reservation['places_res'];

                // Mettre à jour le nombre de places disponibles dans le trajet
                $requeteMajPlaces = $mabd->prepare("UPDATE trajets SET traj_places = :places_dispo WHERE traj_id = :trajet_id");
                $requeteMajPlaces->bindParam(':places_dispo', $places_dispo);
                $requeteMajPlaces->bindParam(':trajet_id', $trajet['traj_id']);
                $requeteMajPlaces->execute();

                // Supprimer la réservation de la base de données
                $requeteSupprimer = $mabd->prepare("DELETE FROM reservations WHERE reserv_id = :reserv_id");
                $requeteSupprimer->bindParam(':reserv_id', $reservation_id);
                $requeteSupprimer->execute();

                echo "La réservation a été annulée avec succès.";
            }
        }
    } else {
        echo "Réservation non trouvée.";
    }

    // Fermer la connexion à la base de données
    deconnexionBD($mabd);
} else {
    echo "ID de réservation non spécifié.";
}
?>
<?php
require 'footer.php';
?>
</body>
</html>
