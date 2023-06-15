<?php
require 'admin/lib.inc.php';

$trajet_id = $_POST['trajet_id'];
$depart = htmlspecialchars($_POST['depart'], ENT_QUOTES, 'UTF-8');
$dest = htmlspecialchars($_POST['dest'], ENT_QUOTES, 'UTF-8');
$date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
$heure = htmlspecialchars($_POST['heure'], ENT_QUOTES, 'UTF-8');
$places = intval($_POST['places']);

try {
    $mabd = connexionBD();

    $requete = $mabd->prepare("SELECT _user_id FROM trajets WHERE traj_id = :trajet_id");
    $requete->bindValue(':trajet_id', $trajet_id, PDO::PARAM_INT);
    $requete->execute();
    $trajet = $requete->fetch(PDO::FETCH_ASSOC);

    if (!$trajet || $trajet['_user_id'] !== $_SESSION['user_id']) {
        header('Location: trajets.php');
        exit();
    }

    $requete = $mabd->prepare("UPDATE trajets SET traj_depart = :depart, traj_arrivee = :dest, traj_date = :date, traj_heure_depart = :heure, traj_places = :places WHERE traj_id = :trajet_id");
    $requete->bindValue(':depart', $depart, PDO::PARAM_STR);
    $requete->bindValue(':dest', $dest, PDO::PARAM_STR);
    $requete->bindValue(':date', $date, PDO::PARAM_STR);
    $requete->bindValue(':heure', $heure, PDO::PARAM_STR);
    $requete->bindValue(':places', $places, PDO::PARAM_INT);
    $requete->bindValue(':trajet_id', $trajet_id, PDO::PARAM_INT);
    $requete->execute();

    header('Location: trajets.php?success=1');
    exit();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
