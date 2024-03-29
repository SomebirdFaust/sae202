<?php
require 'header.php';
?> 

    <title>Profil</title>
</head>
<body>


<div id="profil">

<?php
$mabd = connexionBD();
$user = grab_user($mabd); 

if ($user) {
    echo '<div id="infos_profil">';
        echo '<img src="img/avatar.png" alt="avatar">'. '<br />';
        echo '<div id="infos_text_profil">';
            echo '<p>' . ucfirst($user['user_prenom']) . '</p>' . "\n";
            echo '<p>' . ucfirst($user['user_nom'])  . '</p>' . "\n";
            echo '<p>' . ucfirst($user['user_genre'])  . '</p>' . "\n";
            echo '<p>' . $user['user_mail'] . '</p>';
        echo '</div>';
    echo '</div>';

    echo '<div id="bio_profil">';
    echo ucfirst($user['user_bio']) . '<br />' . "\n";
    echo '</div>';

    if($user['user_car']){
        echo '<div id="voiture_profil">';
    echo '<img src="img/voiture.png" alt="icone voiture">';
    }
    echo '<p>' . ucfirst($user['user_car']) . '</p>' . "\n";
    echo '</div>';


    $requeteReserves = $mabd->prepare("SELECT t.traj_id, r.reserv_id, t.traj_date, t.traj_heure_depart, p.park_nom, t.traj_arrivee, u.user_car, CONCAT(u.user_nom, ' ', u.user_prenom) AS conducteur 
                                      FROM trajets AS t
                                      INNER JOIN utilisateurs AS u ON t._user_id = u.user_id
                                      INNER JOIN reservations AS r ON t.traj_id = r._traj_id
                                      INNER JOIN parkings AS p ON t._park_id = p.park_id
                                      WHERE r._user_id = :user_id");
    $requeteReserves->bindParam(':user_id', $user['user_id']);
    $requeteReserves->execute();

    echo '<h3 id="trajets_reserves_profil_h3">Trajets réservés : </h3>';
    $trajetsReserves = $requeteReserves->fetchAll();
    if ($trajetsReserves) {
        foreach ($trajetsReserves as $trajetReserve) {
            echo '<div id="trajets_reserves_profil">';
            echo "<br><p>Conducteur : " . $trajetReserve['conducteur'] . "</p><br>";
            echo "<p>Date de départ : " . $trajetReserve['traj_date'] . "</p><br>";
            echo "<p>Heure de départ : " . $trajetReserve['traj_heure_depart'] . "</p><br>";
            echo "<p>Départ : " . $trajetReserve['park_nom'] . "</p><br>";
            echo "<p>Arrivée : " . $trajetReserve['traj_arrivee'] . "</p><br>";
            echo "<p>Modèle de voiture : " . $trajetReserve['user_car'] . "</p><br>";
            echo "<a href='modifReservation.php?reserv_id=" . $trajetReserve['reserv_id'] . "'>Voir le détail</a> ";
            echo "<br>";
            echo '</div>';
        }
    } else {
        echo '<p class="align">Vous n\'avez pas réservé de trajet.</p>';
    }


    if (!empty($user['user_car'])) {
        $requeteCrees = $mabd->prepare("SELECT t.traj_id, t.traj_date, t.traj_heure_depart, p.park_nom, t.traj_arrivee 
                                       FROM trajets AS t
                                       INNER JOIN parkings AS p ON t._park_id = p.park_id
                                       WHERE t._user_id = :user_id");
        $requeteCrees->bindParam(':user_id', $user['user_id']);
        $requeteCrees->execute();

        echo '<h3 id="trajets_crees_profil_h3">Mes trajets : </h3>';
        $trajetsCrees = $requeteCrees->fetchAll();
        if ($trajetsCrees) {
            foreach ($trajetsCrees as $trajetCree) {
                echo '<div id="trajets_crees_profil">';
                echo "<br><p>Date de départ : " . $trajetCree['traj_date'] . "</p><br>";
                echo "<p>Heure de départ : " . $trajetCree['traj_heure_depart'] . "</p><br>";
                echo "<p>Départ : " . $trajetCree['park_nom'] . "</p><br>";
                echo "<p>Arrivée : " . $trajetCree['traj_arrivee'] . "</p><br>";
                echo "<a href='modifTrajet.php?trajet_id=" . $trajetCree['traj_id'] . "'>Modifier</a> ";
                echo "<br>";
                echo '</div>';
            }
        } else {
            echo '<p class="align">Vous n\'avez pas créé de trajet.</p>';
        }
        }

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

</div>

<?php
deconnexionBD($mabd);
require 'footer.php';
?>

</body>
</html>
