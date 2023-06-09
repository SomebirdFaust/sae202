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
    echo '<img src="img/avatar.png" alt="avatar">';
    echo ucfirst($user['user_prenom']) . '<br />' . "\n";
    echo ucfirst($user['user_nom']) . '<br />' . "\n";
    echo $user['user_mail'] . '<br />';
    echo '</div>';

    echo '<div id="bio_profil">';
    echo ucfirst($user['user_bio']) . '<br />' . "\n";
    echo '</div>';

    echo '<div id="voiture_profil">';
    echo ucfirst($user['user_car']) . '<br />' . "\n";
    echo '</div>';
} else {
    echo "Vous n'êtes pas connecté(e) !";
}
?>

    <h3 href="modifProfil.php">Modifier le profil</h3>
    
<form action="deconnexion.php" method="post">
    <button type="submit">Déconnexion</button>
</form>


<?php
deconnexionBD($mabd);
require 'footer.php';
?>

</body>
</html>

   
