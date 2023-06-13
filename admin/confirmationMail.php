<?php
session_start();
$_SESSION['information']='';
?>

<?php
if (count($_POST)==0) {
    header('location: ../contact.php');
}
        $affichage_retour = '';														
        $erreurs=0;
            if (!empty($_POST['prenom'])) {
                $prenom=$_POST['prenom'];
                $prenom=mb_strtolower(($prenom)) ;
                $prenom=ucfirst($prenom);
            } 
            else {
                $_SESSION['prenom']='Le champ PRÉNOM est obligatoire';
                $erreurs++;
            }
            if (!empty($_POST['nom'])) {
                $nom=$_POST['nom'];
                $nom=mb_strtolower(($nom)) ;
                $nom=ucfirst($nom);
            } 
            else {
                $_SESSION['nom']='Le champ NOM est obligatoire';
                $erreurs++;
            }
            if (!empty($_POST['message'])) {
                $message=$_POST['message'] ;
            } 
            else {
                $_SESSION['message']='Le champ MESSAGE est obligatoire';
                $erreurs++;
            }
            if (!empty($_POST['email'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    
                    $email=$_POST['email'];
                } 

                } else  {
                    $_SESSION['email']='Le champ EMAIL est obligatoire';
                    $erreurs++;
                    
                }
                if ($erreurs == 0) {
                    $subject='SAE202 : demande de '.$prenom.' '.$nom;
                    $headers['From']=$email;
                    $headers['Reply-to']=$email;
                    $headers['X-Mailer']='PHP/'.phpversion();
                    $email_dest="leane.berlo@etudiant.univ-reims.fr";
                                
                    if (mail($email_dest,$subject,$message,$headers)) {
                        $erreurs=0;
                        echo 'Votre mail a bien été envoyé :)';
                    } else {
                        $erreurs++;
                    }
                }

header('location: ../contact.php');


    
?>
                    
