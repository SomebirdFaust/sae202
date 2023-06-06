<?php
require 'lib.inc.php';
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];
$mabd = connexionBD();
$req = '  utilisateurs WHERE user_email LIKE :email';
$req->execute(array(':email'=>$email));
$utilisateur=$req->fetch();

if($utilisateur){
    echo 'Cet email est déjà utilisé !';
}else{
    $req=new PDO("mysql:host=localhost;dbname=sae202",'sae202admin', 'WW3passwd202');
    ->prepare('INSERT INTO utilisateurs (user_name, user_)WHERE email=:email');
    $req->execute(array(':email'=>$email));
    $utilisateur=$req->fetch();
}

deconnexionBD($mabd);
?>

<?php
require 'lib.inc.php';


$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = $_POST['mdp'];

try {
  $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8', 'sae202admin', 'WW3passwd202');
  $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $req = "SELECT COUNT(*) as count FROM utilisateurs WHERE user_mail = '$email'";
  $result = $mabd->query($req)->fetch(PDO::FETCH_ASSOC);

  if ($result['count'] > 0) {
    // Utilisateur déjà existant, afficher un message d'erreur ou rediriger vers une autre page
    echo "Cet email est déjà utilisé, veuillez vous connecter !";
  } else {
    // Insérer les données de l'utilisateur dans la base de données
    $req = "INSERT INTO utilisateurs (nom, prenom, user_mail, user_mdp, user_genre) VALUES ('$nom', '$prenom', '$email', '$mdp', '$genre')";
    $mabd->query($req);

    // Afficher un message de succès ou rediriger vers une autre page
    echo "Inscription réussie !";
  }
} catch (PDOException $e) {
  // Gérer les erreurs de connexion à la base de données
  die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
