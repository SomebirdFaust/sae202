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
    $requeteReserves = $mabd->prepare("SELECT t.*, u.user_nom, u.user_prenom FROM trajets AS t
                                      INNER JOIN utilisateurs AS u ON t.conducteur_id = u.user_id
                                      INNER JOIN reservations AS r ON t.traj_id = r._traj_id
                                      WHERE r._user_id = :user_id");
    $requeteReserves->bindParam(':user_id', $user['user_id']);
    $requeteReserves->execute();

    echo '<h3>Trajets réservés</h3>';
    $trajetReserve = $requeteReserves->fetch();
    if ($trajetReserve) {
        while ($trajetReserve) {
            echo "Nom du conducteur : " . $trajetReserve['user_nom'] . " " . $trajetReserve['user_prenom'] . "<br>";
            echo "Date de départ : " . $trajetReserve['date'] . "<br>";
            echo "Nombre de places disponibles : " . $trajetReserve['traj_places'] . "<br>";
            echo "<a href='modifierTrajet.php?trajet_id=" . $trajetReserve['traj_id'] . "'>Modifier</a> ";
            echo "<a href='supprimerTrajet.php?trajet_id=" . $trajetReserve['traj_id'] . "'>Supprimer</a><br>";

            $trajetReserve = $requeteReserves->fetch();
        }
    } else {
        echo "Vous n'avez pas réservé de trajet.<br>";
    }

    // Afficher les trajets créés par l'utilisateur s'il a une voiture
    if (!empty($user['user_car'])) {
        $requeteCrees = $mabd->prepare("SELECT t.*, u.user_nom, u.user_prenom FROM trajets AS t
                                        INNER JOIN utilisateurs AS u ON t.conducteur_id = u.user_id
                                        WHERE t.conducteur_id = :user_id");
        $requeteCrees->bindParam(':user_id', $user['user_id']);
        $requeteCrees->execute();

        echo '<h3>Trajets créés</h3>';
        $trajetCree = $requeteCrees->fetch();
        if ($trajetCree) {
            while ($trajetCree) {
                echo "Nom du conducteur : " . $trajetCree['user_nom'] . " " . $trajetCree['user_prenom'] . "<br>";
                echo "Date de départ : " . $trajetCree['date'] . "<br>";
                echo "Nombre de places disponibles : " . $trajetCree['traj_places'] . "<br>";
                echo "<a href='modifierTrajet.php?trajet_id=" . $trajetCree['traj_id'] . "'>Modifier</a> ";
                echo "<a href='supprimerTrajet.php?trajet_id=" . $trajetCree['traj_id'] . "'>Supprimer</a><br>";

                $trajetCree = $requeteCrees->fetch();
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

   
