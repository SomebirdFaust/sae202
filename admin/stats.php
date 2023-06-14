<?php 
require 'lib.inc.php';
?>
<?php
$mabd = connexionBD();
$mabd->query('SET NAMES utf8;');
$req = "SELECT COUNT(traj_id) AS nombre_trajets FROM trajets";
$resultat = $mabd->query($req);
$row = $resultat->fetch(PDO::FETCH_ASSOC);
$nombreTrajets = $row['nombre_trajets'];

echo "Nombre de trajets : " . $nombreTrajets;

?>

