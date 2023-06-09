<?php 
    require 'admin/lib.inc.php';
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
} else {
    echo '<div id="erreur_connexion_profil">';
    echo "Vous n'êtes pas connecté(e) !";
    echo '</div>';
}
?>

<div id="boutons_profil">
    <div id="bouton_modif">
        <form action="modifProfil.php" method="post">
            <button type="submit">Modifier le profil</button>
        </form>
    </div>

    <div id="bouton_deconnexion">
        <form action="deconnexion.php" method="post">
            <button type="submit">Déconnexion</button>
        </form>
    </div>
</div>

<?php
deconnexionBD($mabd);
require 'footer.php';
?>

</body>
</html>

   
