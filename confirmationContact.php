<?php
require 'admin/lib.inc.php';
?>

<?php
if (empty($_POST)) {
    header('Location: contact.php');
    exit();
}

$erreurs = 0;
$prenom = $nom = $message = $email = '';

if (!empty($_POST['prenom'])) {
    $prenom = ucfirst(mb_strtolower($_POST['prenom']));
} else {
    $erreurs++;
}

if (!empty($_POST['nom'])) {
    $nom = ucfirst(mb_strtolower($_POST['nom']));
} else {
    $erreurs++;
}

if (!empty($_POST['message'])) {
    $message = trim($_POST['message']);
    if (empty($message)) {
        $erreurs++;
    }
} else {
    $erreurs++;
}

if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['email'];
} else {
    $erreurs++;
}

if ($erreurs == 0) {
    $subject = 'SAE202 : demande de ' . $prenom . ' ' . $nom;
    $headers = array(
        'From' => $email,
        'Reply-to' => $email,
        'X-Mailer' => 'PHP/' . phpversion()
    );
    $email_dest = 'flore.gaulard@etudiant.univ-reims.fr';

    $headers = implode("\r\n", $headers);
    if (mail($email_dest, $subject, $message, $headers)) {
        echo 'Votre mail a bien été envoyé :)';
    } else {
        $erreurs++;
    }
} else {
    echo 'Veuillez réessayer.';
}
?>

<?php
header('Location: contact.php');
?>