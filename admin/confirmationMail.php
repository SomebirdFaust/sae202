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

   

            // test prenom
            if (!empty($_POST['prenom'])) {
                $prenom=$_POST['prenom'];
                $prenom=mb_strtolower(($prenom)) ;
                $prenom=ucfirst($prenom);
            } 
            else {
                $_SESSION['prenom']='Le champ PRÉNOM est obligatoire';
                $erreurs++;
            }

            // test nom
            if (!empty($_POST['nom'])) {
                $nom=$_POST['nom'];
                $nom=mb_strtolower(($nom)) ;
                $nom=ucfirst($nom);
            } 
            else {
                $_SESSION['nom']='Le champ NOM est obligatoire';
                $erreurs++;
            }

            // test message
            if (!empty($_POST['message'])) {
                $message=$_POST['message'] ;
            } 
            else {
                $_SESSION['message']='Le champ MESSAGE est obligatoire';
                $erreurs++;
            }
    
            // test email
            if (!empty($_POST['email'])) {

                // Verification du format de l'email
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    
                    $email=$_POST['email'];
                } 

                } else  {
                    // Si l'email est incorrect on retourne au formulaire  
                    $_SESSION['email']='Le champ EMAIL est obligatoire';
                    $erreurs++;
                    
                }

                if ($erreurs == 0) {
            
                    //Préparation des variables pour l'envoi du mail de contact
                    $subject='SAE202 : demande de '.$prenom.' '.$nom;
                    $headers['From']=$email;							// Pour pouvoir répondre à la demande de contact
                    $headers['Reply-to']=$email;						// On donne l'adresse de l'utilisateur comme adresse de réponse
                    $headers['X-Mailer']='PHP/'.phpversion();			// On précise quel programme à généré le mail
                    // On fixe l'adresse du destinataire - Pour ce Mail il s'agit de notre adresse MMI@mmi-troyes.fr
                    $email_dest="leane.berlo@etudiant.univ-reims.fr";
                                
                    //Envoi du mail avec confirmation d'envoi (ou pas)
                    if (mail($email_dest,$subject,$message,$headers)) {
                        $erreurs=0;
                        echo 'Votre mail a bien été envoyé :)';
                    } else {
                        $erreurs++;
                    }
                }

header('location: ../contact.php');


    
?>
                    