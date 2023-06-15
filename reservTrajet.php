<?php
require 'admin/lib.inc.php';

$trajet_id = $_GET['trajet_id'];

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: page_connexion.php');
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    $mabd = connexionBD();

    $req = $mabd->prepare('SELECT COUNT(*) as count FROM reservations WHERE _user_id = :user_id AND _traj_id = :trajet_id');
    $req->execute(array(':user_id' => $user_id, ':trajet_id' => $trajet_id));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        header('Location: erreurTrajet.php');
        exit();
    }

    $req = $mabd->prepare('INSERT INTO reservations (_user_id, _traj_id) VALUES (:user_id, :trajet_id)');
    $req->execute(array(':user_id' => $user_id, ':trajet_id' => $trajet_id));

    $req = $mabd->prepare('UPDATE trajets SET traj_places = traj_places - 1 WHERE traj_id = :trajet_id');
    $req->execute(array(':trajet_id' => $trajet_id));

    $req = $mabd->prepare('SELECT traj_places FROM trajets WHERE traj_id = :trajet_id');
    $req->execute(array(':trajet_id' => $trajet_id));
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['traj_places'] == 0) {
        header('Location: erreurTrajet.php');
    }

    header('Location: succesTrajet.php');
    exit();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>

