<?php 
require 'lib.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">
<body>
<?php
$mabd = connexionBD();
$mabd->query('SET NAMES utf8;');
$req = "SELECT COUNT(traj_id) AS nombre_trajets FROM trajets";
$tresult = $mabd->query($req);
$row = $tresult->fetch(PDO::FETCH_ASSOC);
$nombreTrajets = $row['nombre_trajets'];

echo "Nombre de trajets : " . $nombreTrajets;
?>
<br>
<?php
$req = "SELECT COUNT(user_id) AS nombre_utilisateurs FROM utilisateurs";
$uresult = $mabd->query($req);
$row = $uresult->fetch(PDO::FETCH_ASSOC);
$nombreUtilisateurs = $row['nombre_utilisateurs'];

echo "Nombre d'utilisateurs : " . $nombreUtilisateurs;
?>
<br>
<?php
$req = "SELECT COUNT(reserv_id) AS nombre_reserv FROM reservations";
$rresult = $mabd->query($req);
$row = $rresult->fetch(PDO::FETCH_ASSOC);
$nombreReserv = $row['nombre_reserv'];

echo "Nombre d'utilisateurs : " . $nombreReserv;
?>

</body>
</html>