<?php
if(isset($_POST['trajet_id'])) {
    $trajet_id = $_POST['trajet_id'];

    require 'header.php';
    $mabd = connexionBD();

    $requete = $mabd->prepare("SELECT * FROM trajets WHERE traj_id = :trajet_id");
    $requete->bindParam(':trajet_id', $trajet_id);
    $requete->execute();
    $trajet = $requete->fetch();

    if($trajet) {
        $requeteSupprimer = $mabd->prepare("DELETE FROM trajets WHERE traj_id = :trajet_id");
        $requeteSupprimer->bindParam(':trajet_id', $trajet_id);
        $requeteSupprimer->execute();

        header('Location: contact.php');
    }

    deconnexionBD($mabd);
}
?>
