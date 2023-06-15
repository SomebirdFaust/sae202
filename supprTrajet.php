<?php
// Vérifier si l'ID du trajet a été transmis
if(isset($_POST['trajet_id'])) {
    $trajet_id = $_POST['trajet_id'];

    // Connexion à la base de données
    require 'header.php';
    $mabd = connexionBD();

    // Vérifier si le trajet existe
    $requete = $mabd->prepare("SELECT * FROM trajets WHERE traj_id = :trajet_id");
    $requete->bindParam(':trajet_id', $trajet_id);
    $requete->execute();
    $trajet = $requete->fetch();

    if($trajet) {
        // Supprimer le trajet de la base de données
        $requeteSupprimer = $mabd->prepare("DELETE FROM trajets WHERE traj_id = :trajet_id");
        $requeteSupprimer->bindParam(':trajet_id', $trajet_id);
        $requeteSupprimer->execute();

        echo "Le trajet a été supprimé avec succès.";
    }

    // Fermer la connexion à la base de données
    deconnexionBD($mabd);
}
?>
