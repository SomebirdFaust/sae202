<?php
require 'admin/lib.inc.php';
?>

<?php
session_start();

if (isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['message'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($message) && trim($message) !== '') {
        $prenom = ucfirst(mb_strtolower($prenom));
        $nom = ucfirst(mb_strtolower($nom));

        $subject = 'SAE202 : demande de ' . $prenom . ' ' . $nom;
        $headers = "From: $email\r\n";
        $email_dest = 'flore.gaulard@etudiant.univ-reims.fr';

        if (mail($email_dest, $subject, $message, $headers)) {
            $_SESSION['success_message'] = 'Votre message a bien été envoyé !';
            header('Location: contact.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Erreur lors de l\'envoi du message. Veuillez réessayer.';
            header('Location: contact.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Tous les champs sont obligatoires. Veuillez les remplir correctement.';
        header('Location: contact.php');
        exit();
    }
} else {
    $_SESSION['error_message'] = 'Veuillez remplir le formulaire et soumettre votre demande.';
    header('Location: contact.php');
    exit();
}
?>

<?php
header('Location: contact.php');
?>