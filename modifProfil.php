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
<?php
$mabd = connexionBD();
$user = grab_user($mabd);

if ($user) {
    echo '<form action="validModifProfil.php" method="post">';
    echo '<div id="infos_profil">';
    echo 'Prenom : <input type="text" name="prenom" value="' . ucfirst($user['user_prenom']) . '"><br />';
    echo 'Nom : <input type="text" name="nom" value="' . ucfirst($user['user_nom']) . '"><br />';
    echo 'Email : <input type="email" name="email" value="' . $user['user_mail'] . '" readonly><br />';
    echo 'Mot de Passe : <input type="password" name="mdp" value=""><br />';
    echo '</div>';

    echo '<div id="bio_profil">';
    echo 'Votre Bio : <textarea name="bio">' . ucfirst($user['user_bio']) . '</textarea><br />';
    echo '</div>';

    echo '<div id="voiture_profil">';
    echo 'Votre voiture : <input type="text" name="voiture" value="' . ucfirst($user['user_car']) . '"><br />';
    echo '</div>';

    echo '<input type="submit" value="Enregistrer les modifications">';
    echo '</form>';
    echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';

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

