<?php
require 'header.php';
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>

<?php
$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    echo '<div id="infos_profil">';
    echo '<img src="img/avatar.png" alt="avatar">'. '<br />';
    echo '<p>' . ucfirst($user['user_prenom']) . '</p>' . "\n";
    echo '<p>' . ucfirst($user['user_nom'])  . '</p>' . "\n";
    echo '<p>' . $user['user_genre']  . '</p>' . "\n";
    echo '<p>' . $user['user_mail'] . '</p>';
    echo '</div>';

    echo '<div id="bio_profil">';
    echo ucfirst($user['user_bio']) . '<br />' . "\n";
    echo '</div>';

    echo '<div id="voiture_profil">';
    echo '<img src="img/voiture.png" alt="icone voiture">';
    echo '<p>' . ucfirst($user['user_car']) . '</p>' . "\n";
    echo '</div>';

    echo '<div id="bouton_modif">';
    echo '<form action="modifProfil.php" method="post">';
    echo '<button type="submit">Modifier le profil</button>';
    echo '</form>';
    echo '</div>';

    echo '<div id="bouton_deconnexion">';
    echo '<form action="deconnexion.php" method="post">';
    echo '<button type="submit">Se déconnecter</button>';
    echo '</form>';
    echo '</div>';

    // Afficher les trajets réservés par l'utilisateur
    $requeteReserves = $mabd->prepare("SELECT t.traj_id, t.traj_date, p.park_nom, t.traj_arrivee, u.user_car, CONCAT(u.user_nom, ' ', u.user_prenom) AS conducteur 
                                      FROM trajets AS t
                                      INNER JOIN utilisateurs AS u ON t._user_id = u.user_id
                                      INNER JOIN reservations AS r ON t.traj_id = r._traj_id
                                      INNER JOIN parkings AS p ON t._park_id = p.park_id
                                      WHERE r._user_id = :user_id");
    $requeteReserves->bindParam(':user_id', $user['user_id']);
    $requeteReserves->execute();

    echo '<h3>Trajets réservés</h3>';
    $trajetsReserves = $requeteReserves->fetchAll();
    if ($trajetsReserves) {
        foreach ($trajetsReserves as $trajetReserve) {
            echo "Conducteur : " . $trajetReserve['conducteur'] . "<br>";
            echo "Date de départ : " . $trajetReserve['traj_date'] . "<br>";
            echo "Départ : " . $trajetReserve['park_nom'] . "<br>";
            echo "Arrivée : " . $trajetReserve['traj_arrivee'] . "<br>";
            echo "Modèle de voiture : " . $trajetReserve['user_car'] . "<br>";
            echo "<a href='modifReservation.php?trajet_id=" . $trajetReserve['traj_id'] . "'>Modifier</a> ";
            echo "<br>";
        }
    } else {
        echo "Vous n'avez pas réservé de trajet.<br>";
    }

    // Afficher les trajets créés par l'utilisateur s'il a une voiture
    if (!empty($user['user_car'])) {
        $requeteCrees = $mabd->prepare("SELECT t.traj_id, t.traj_date, p.park_nom, t.traj_arrivee 
                                       FROM trajets AS t
                                       INNER JOIN parkings AS p ON t._park_id = p.park_id
                                       WHERE t._user_id = :user_id");
        $requeteCrees->bindParam(':user_id', $user['user_id']);
        $requeteCrees->execute();

        echo '<h3>Trajets créés</h3>';
        $trajetsCrees = $requeteCrees->fetchAll();
        if ($trajetsCrees) {
            foreach ($trajetsCrees as $trajetCree) {
                echo "Date de départ : " . $trajetCree['traj_date'] . "<br>";
                echo "Départ : " . $trajetCree['park_nom'] . "<br>";
                echo "Arrivée : " . $trajetCree['traj_arrivee'] . "<br>";
                echo "<a href='modifTrajet.php?trajet_id=" . $trajetCree['traj_id'] . "'>Modifier</a> ";
                echo "<br>";
            }
        } else {
            echo "Vous n'avez pas créé de trajet.<br>";
        }
    }

    deconnexionBD($mabd);
} else {
    echo '<div id="erreur_connexion_profil">';
    echo '<p>Vous n\'êtes pas connecté(e) !</p>';

    echo '<div id="boutons_profil">';
    echo '<div id="bouton_connexion">';
    echo '<form action="connexion.php" method="post">';
    echo '<button type="submit">Se connecter</button>';
    echo '</form>';
    echo '</div>';

    echo '<div id="bouton_inscription">';
    echo '<form action="inscription.php" method="post">';
    echo '<button type="submit">S\'inscrire</button>';
    echo '</form>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
}

?>

<?php
deconnexionBD($mabd);
require 'footer.php';
?>

</body>
</html>
