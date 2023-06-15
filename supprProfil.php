<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression Profil</title>
</head>
<body>
<?php
echo '<div id="modif_profil_supprimer">';
    echo '<form action="supprProfilVerif.php" method="post">';
    if (isset($user) && $user !== null) {
        echo '<input type="hidden" name="user_id" value="' . $user['user_id'] . '">';
    } else {
        echo '<input type="hidden" name="user_id" value="">';
    }
    echo '</form>';
echo '</div>';
?>

</body>
</html>