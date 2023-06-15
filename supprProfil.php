<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression Profil</title>
</head>
<body>
<?php
require 'admin/lib.inc.php';

$user_id = $_POST['user_id'];

try {
    $mabd = connexionBD();
    $req = $mabd->prepare('SELECT COUNT(*) as count FROM utilisateurs WHERE user_id = :user_id');
    $req->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $req->execute();
    $result = $req->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        echo '<div id="modif_profil_supprimer">';
        echo '<form action="supprProfilVerif.php" method="post">';
        echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
        echo '<input type="submit" value="Supprimer le compte">';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<div>Utilisateur non trouvé.</div>';
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
</body>
</html>
