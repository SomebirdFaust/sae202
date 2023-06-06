<!DOCTYPE html>
<html>
<head>
<title>Suppression d'un parking</title>
</head>
<body>
<a href="gestion.php">retour</a> 	
<hr> <h1>Suppression d'un parking</h1> <hr>

<?php
// recupérer dans l'url l'id du parking à supprimer
$park=$_GET['num'];

//$mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
//$mabd->query('SET NAMES utf8;');

// Connexion à la base de données
$host = 'localhost'; // Votre hôte MySQL
$user = 'sae202admin'; // Votre nom d'utilisateur MySQL
$password = 'WW3dbpasswd202'; // Votre mot de passe MySQL
$database = 'sae202'; // Le nom de votre base de données

$conn = mysqli_connect($host, $user, $password, $database);


// tapez ici la requete de suppression du parking dont l'id est passé dans l'url
$req = 'DELETE FROM parkings WHERE park_id='. $park; 

// cette ligne sert juste pour le debug. à supprimer quand tout marche correctement  
//echo $req;
$resultat = mysqli_query($conn, $req);

// Exécuter la requête pour obtenir park_nom correspondant à park_id
$query = "SELECT park_nom FROM parkings WHERE park_id = '" . mysqli_real_escape_string($conn, $park) . "'";
$result = mysqli_query($conn, $query);

if ($resultat) {
    // Exécuter la requête pour obtenir park_nom correspondant à park_id
    $query = "SELECT park_nom FROM parkings WHERE park_id = '" . mysqli_real_escape_string($conn, $park) . "'";
    $result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    // Afficher park_nom
    echo '<h2>Vous venez de supprimer le '.$row['park_nom'].'.</h2>';
}
}


//echo '<h2>Vous venez de supprimer le parking '.$mabd['park_nom'].'.</h2>';

?>

</body>
</html>