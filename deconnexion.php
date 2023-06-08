<?php
require 'admin/lib.inc.php';

deconnecterUtilisateur();

//détruire la session
session_start();
session_destroy();

//rediriger vers la page d'accueil ou une autre page après la déconnexion
header('Location: index.php');
exit();
?>
