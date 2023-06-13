<?php
require 'admin/lib.inc.php';
$_SESSION['information']='';
?>

<?php
session_start();

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['message'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($message)) {
        $prenom = ucfirst(mb_strtolower($prenom));
        $nom = ucfirst(mb_strtolower($nom));
        
        $subject = 'SAE202 : demande de ' . $prenom . ' ' . $nom;
        $headers = "From: $email\r\n";
        $email_dest = 'flore.gaulard@etudiant.univ-reims.fr';

        if (mail($email_dest, $subject, $message, $headers)) {
            echo '<h3>Votre message a bien été envoyé !</h3>';
        } else {
            echo '<h3>Erreur lors de l\'envoi du message. Veuillez réessayer.</h3>';
        }
    } else {
        echo '<h3>Tous les champs sont obligatoires. Veuillez les remplir.</h3>';
    }
} else {
    echo '<h3>Veuillez remplir le formulaire et soumettre votre demande.</h3>';
}
?>

<?php
header('Location: contact.php');
?>