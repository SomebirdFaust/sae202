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
    echo '<form action="../validModifProfil.php" method="post">';
    echo '<div id="infos_profil">';
    echo '<input type="text" name="prenom" value="' . ucfirst($user['user_prenom']) . '"><br />';
    echo '<input type="text" name="nom" value="' . ucfirst($user['user_nom']) . '"><br />';
    echo '<input type="email" name="email" value="' . $user['user_mail'] . '"><br />';
    echo '</div>';

    echo '<div id="bio_profil">';
    echo '<textarea name="bio">' . ucfirst($user['user_bio']) . '</textarea><br />';
    echo '</div>';

    echo '<div id="voiture_profil">';
    echo '<input type="text" name="voiture" value="' . ucfirst($user['user_car']) . '"><br />';
    echo '</div>';

    echo '<input type="submit" value="Enregistrer les modifications">';
    echo '</form>';
} else {
    echo "Vous n'êtes pas connecté(e) !";
}
?>

<hr />

<?php
require 'footer.php';
?>
</body>
</html>
