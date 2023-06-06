<!DOCTYPE html>
<html>
<head>
    <title>Confirmation d'ajout</title>
</head>
<body>
    <a href="gestion.php">retour</a> 	
    <hr> <h1>Confirmation d'ajout</h1> <hr>
    <h2>Vous venez d'ajouter un parking</h2>
    <hr>
    <?php
    $num=$_POST['num'];
    $nom=$_POST['nom'];
    $loc=$_POST['loc'];



    //$mabd = new PDO('mysql:host=localhost;dbname=sae203Base;charset=UTF8;', 'sae203User', 'cleMDPdmaBAZ203');
    //$mabd->query('SET NAMES utf8;');

    // Connexion à la base de données
    $host = 'localhost'; // Votre hôte MySQL
    $user = 'sae202admin'; // Votre nom d'utilisateur MySQL
    $password = 'WW3dbpasswd202'; // Votre mot de passe MySQL
    $database = 'sae202'; // Le nom de votre base de données

    $conn = mysqli_connect($host, $user, $password, $database);


    $req = 'INSERT INTO parkings (`park_nom`,`park_loc`) VALUES("'. $nom .'" , "'. $loc.'")';
    //echo $req;
    $resultat = mysqli_query($conn, $req);

    // Exécuter la requête pour obtenir park_nom correspondant à park_id
    $query = "SELECT park_nom FROM parkings WHERE park_id = '" . mysqli_real_escape_string($conn, $num) . "'";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        // Afficher park_nom
        echo '<h2>Vous venez d\'ajouter le '.$row['park_nom'].'.</h2>';
    }

    ?>
</tbody>
</table>
</body>
</html>