<?php
    require 'header.php';
?> 

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
        echo '<div id="confirmation_suppr_compte">';
        echo '<p>Êtes-vous sûr(e) de vouloir supprimer votre compte ?</p>';
        echo '</div>';
        echo '<div id="suppr_profil_supprimer">';
        echo '<form action="supprProfilVerif.php" method="post">';
        echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
        echo '<input id="suppr_profil_bouton" class="input" type="submit" value="Supprimer le compte">';
        echo '</form>';
        echo '<form action="profil.php" method="post">';
        echo '<input class="input" type="submit" value="Retour au profil">';
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

<?php
    require 'footer.php';
?>
