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
