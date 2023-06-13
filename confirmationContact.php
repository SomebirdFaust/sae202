<?php
require 'admin/lib.inc.php';
$_SESSION['information']='';
?>


<?php
if (count($_POST) == 0) {
    header('Location: contact.php');
    exit();
}

$affichage_retour = '';
$erreurs = 0;

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
    $message = $_POST['message'];
} else {
    $erreurs++;
}

if (!empty($_POST['email'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    } else {
        $erreurs++;
    }
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
//    $email_dest = 'leane.berlo@etudiant.univ-reims.fr';
$email_dest = 'flore.gaulard@etudiant.univ-reims.fr';

$headers = implode("\r\n", $headers);
if (mail($email_dest, $subject, $message, $headers)) {
    $_SESSION['ok'] = 'Veuillez réessayer.';
} else {
    $erreurs++;
}
} else {
    $_SESSION['erreur'] = 'Veuillez réessayer.';
}

?>
<?php
header('Location: contact.php');
?>