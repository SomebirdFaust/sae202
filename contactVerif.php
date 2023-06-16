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
        $headers = "From: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\r\n";
        $email_dest = 'flore.gaulard@etudiant.univ-reims.fr';

        if (mail($email_dest, $subject, $message, $headers)) {
            $_SESSION['success_message'] = '<p class="align">Votre message a bien été envoyé !</p>';
            header('Location: contact.php');
            exit();
        } else {
            $_SESSION['error_message'] = '<p class="align">Erreur lors de l\'envoi du message. Veuillez réessayer.</p>';
            header('Location: contact.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = '<p class="align">Tous les champs sont obligatoires. Veuillez les remplir correctement.</p>';
        header('Location: contact.php');
        exit();
    }
} else {
    $_SESSION['error_message'] = '<p class="align">Veuillez remplir le formulaire et soumettre votre demande.</p>';
    header('Location: contact.php');
    exit();
}
?>

<?php
header('Location: contact.php');
?>