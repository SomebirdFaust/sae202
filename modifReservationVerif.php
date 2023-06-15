<?php
require 'admin/lib.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mabd = connexionBD();
    $user = grab_user($mabd);

    if ($user) {
        if (isset($_POST['reserv_id'])) {
            $reserv_id = $_POST['reserv_id'];

            if (isset($_POST['action']) && $_POST['action'] === 'annuler') {
                $requeteSuppression = $mabd->prepare("DELETE FROM reservations WHERE reserv_id = :reserv_id AND _user_id = :user_id");
                $requeteSuppression->bindParam(':reserv_id', $reserv_id);
                $requeteSuppression->bindParam(':user_id', $user['user_id']);

                if ($requeteSuppression->execute()) {
                    echo "La réservation a été annulée avec succès.";
                } else {
                    echo "Erreur lors de l'annulation de la réservation.";
                }
            }
        } else {
            echo "ID de réservation non spécifié.";
        }

        deconnexionBD($mabd);
    } else {
        echo "Vous n'êtes pas connecté(e) !";
    }
} else {
    echo "Méthode de requête invalide.";
}

require 'footer.php';
?>
