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
        $mabd->beginTransaction();

        $req_delete_reservations = $mabd->prepare('DELETE FROM reservations WHERE _user_id = :_user_id');
        $req_delete_reservations->bindValue(':_user_id', $user_id, PDO::PARAM_INT);
        $req_delete_reservations->execute();

        $req_update_trajets = $mabd->prepare('UPDATE trajets SET traj_places = traj_places + 1 WHERE traj_id IN (
                                                SELECT _traj_id FROM reservations WHERE _user_id = :_user_id
                                            )');
        $req_update_trajets->bindValue(':_user_id', $user_id, PDO::PARAM_INT);
        $req_update_trajets->execute();

        $req_delete_utilisateur = $mabd->prepare('DELETE FROM utilisateurs WHERE user_id = :user_id');
        $req_delete_utilisateur->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $req_delete_utilisateur->execute();

        $mabd->commit();

        session_unset();
        session_destroy();

        echo '<div id="confirmation_suppr_compte">';
        echo '<p>Votre compte a été supprimé avec succès.</p>';
        echo '</div>';
    } else {
        echo '<div>Utilisateur non trouvé.</div>';
    }
} catch (PDOException $e) {
    $mabd->rollBack();
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

deconnexionBD($mabd);
?>
</body>
</html>

<?php
require 'footer.php';
?>
