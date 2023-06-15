<?php
require 'admin/lib.inc.php';

$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    if (isset($_POST['reserv_id'])) {
        $reserv_id = $_POST['reserv_id'];

        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            if ($action === 'modifier') {
                if (isset($_POST['places'])) {
                    $places = $_POST['places'];

                    $requeteModification = $mabd->prepare("UPDATE reservations SET reserv_places = :places WHERE reserv_id = :reserv_id AND _user_id = :user_id");
                    $requeteModification->bindParam(':places', $places);
                    $requeteModification->bindParam(':reserv_id', $reserv_id);
                    $requeteModification->bindParam(':user_id', $user['user_id']);

                    if ($requeteModification->execute()) {
                        echo "Le nombre de places réservées a été modifié avec succès.";
                    } else {
                        echo "Erreur lors de la modification du nombre de places réservées.";
                    }
                } else {
                    echo "Nombre de places non spécifié.";
                }
            }
            elseif ($action === 'annuler') {
                $requeteSuppression = $mabd->prepare("DELETE FROM reservations WHERE reserv_id = :reserv_id AND _user_id = :user_id");
                $requeteSuppression->bindParam(':reserv_id', $reserv_id);
                $requeteSuppression->bindParam(':user_id', $user['user_id']);

                if ($requeteSuppression->execute()) {
                    echo "La réservation a été annulée avec succès.";
                } else {
                    echo "Erreur lors de l'annulation de la réservation.";
                }
            }
        }
    } else {
        echo "ID de réservation non spécifié.";
    }

    deconnexionBD($mabd);
} else {
    echo "Vous n'êtes pas connecté(e) !";
}

require 'footer.php';
?>
