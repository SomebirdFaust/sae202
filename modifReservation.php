<?php
// Vérifier si l'ID de la réservation a été transmis
if(isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];

    // Connexion à la base de données
    require 'header.php';
    $mabd = connexionBD();

    // Récupérer les informations de la réservation
    $requeteReservation = $mabd->prepare("SELECT * FROM reservations WHERE reservation_id = :reservation_id");
    $requeteReservation->bindParam(':reservation_id', $reservation_id);
    $requeteReservation->execute();
    $reservation = $requeteReservation->fetch();

    if($reservation) {
        // Vérifier si l'utilisateur est autorisé à modifier ou annuler la réservation
        if($_SESSION['user_id'] == $reservation['_user_id']) {
            // Récupérer le trajet correspondant à la réservation
            $requeteTrajet = $mabd->prepare("SELECT * FROM trajets WHERE traj_id = :trajet_id");
            $requeteTrajet->bindParam(':trajet_id', $reservation['_traj_id']);
            $requeteTrajet->execute();
            $trajet = $requeteTrajet->fetch();

            if($trajet) {
                // Vérifier si l'utilisateur souhaite augmenter le nombre de places réservées
                if(isset($_POST['places_res'])) {
                    $places_res = $_POST['places_res'];

                    // Vérifier si le nombre de places demandées est inférieur ou égal aux places disponibles
                    if($places_res <= $trajet['traj_places']) {
                        // Mettre à jour le nombre de places réservées dans la base de données
                        $requeteModifier = $mabd->prepare("UPDATE reservations SET places_res = :places_res WHERE reservation_id = :reservation_id");
                        $requeteModifier->bindParam(':places_res', $places_res);
                        $requeteModifier->bindParam(':reservation_id', $reservation_id);
                        $requeteModifier->execute();

                        echo "La réservation a été modifiée avec succès.";
                    } else {
                        echo "Nombre de places demandées supérieur aux places disponibles.";
                    }
                } elseif(isset($_POST['annuler'])) {
                    // Annuler la réservation et libérer les places réservées
                    $places_dispo = $trajet['traj_places'] + $reservation['places_res'];

                    // Mettre à jour le nombre de places disponibles dans le trajet
                    $requeteMajPlaces = $mabd->prepare("UPDATE trajets SET traj_places = :places_dispo WHERE traj_id = :trajet_id");
                    $requeteMajPlaces->bindParam(':places_dispo', $places_dispo);
                    $requeteMajPlaces->bindParam(':trajet_id', $trajet['traj_id']);
                    $requeteMajPlaces->execute();

                    // Supprimer la réservation de la base de données
                    $requeteSupprimer = $mabd->prepare("DELETE FROM reservations WHERE reservation_id = :reservation_id");
                    $requeteSupprimer->bindParam(':reservation_id', $reservation_id);
                    $requeteSupprimer->execute();

                    echo "La réservation a été annulée avec succès.";
                }
            } else {
                echo "Trajet non trouvé.";
            }
        } else {
            echo "Vous n'êtes pas autorisé(e) à modifier cette réservation.";
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
