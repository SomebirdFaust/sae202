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
    <title>Modification Profil</title>
</head>
<body>
<div id="img_modif_profil">
    <img src="img/avatar.png" alt="avatar">
</div>

<?php
$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    echo '<div id="modif_profil">';
        echo '<form action="validModifProfil.php" method="post">';
        echo '<div id="infos_profil">';
            echo '<label for="prenom">Prénom</label> <br />'; 
            echo '<input class="input" type="text" name="prenom" value="' . ucfirst($user['user_prenom']) . '"><br />';
            echo '<label for="nom">Nom</label> <br />';
            echo '<input class="input" type="text" name="nom" value="' . ucfirst($user['user_nom']) . '"><br />';
            echo '<label for="genre">Genre</label> <br />';
            echo '<input class="input" type="text" name="genre" value="' . ucfirst($user['user_genre']) . '"><br />';
            echo '<label for="email">Email</label> <br />';
            echo '<input class="input" type="text" name="email" value="' . $user['user_mail'] . '"><br />';
            echo '<label for="vehicule">Véhicule</label> <br />';
            echo '<input class="input" type="text" name="vehicule" value="' . ucfirst($user['user_car']) . '"><br />';
        echo '</div>';

        echo '<div id="bio_profil">';
        echo '<label for="biographie">Biographie</label> <br />';
        echo '<textarea class="input" name="bio">' . ucfirst($user['user_bio']) . '</textarea><br />';
        echo '</div>';

        echo '<div id="voiture_profil">';
        echo 'Votre voiture : <input type="text" name="voiture" value="' . ucfirst($user['user_car']) . '"><br />';
        echo '</div>';

        echo '<input type="submit" value="Enregistrer les modifications">';
        echo '</form>';
        echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
    echo '</div>';

} else {
    echo "Vous n'êtes pas connecté(e) !";
}
?>

<a href="supprProfil.php">Supprimer le compte.</a>

<hr />

<?php
require 'footer.php';
?>
</body>
</html>

