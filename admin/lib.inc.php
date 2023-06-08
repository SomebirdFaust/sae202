<?php
// Vérifier si une session existe déjà, sinon la créer
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si la connexion à la base de données est déjà établie, sinon la connecter
if (!function_exists('connexionBD')) {
    function connexionBD()
    {
        $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
        $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $mabd->query('SET NAMES utf8;');
        return $mabd;
    }
}

// Vérifier si la déconnexion de la base de données est déjà effectuée, sinon la faire
if (!function_exists('deconnexionBD')) {
    function deconnexionBD(&$mabd)
    {
        $mabd = null;
    }
}

// Fonction pour déconnecter l'utilisateur
function deconnecterUtilisateur() {
    // Démarrer la session
    session_start();

    // Détruire toutes les variables de session
    $_SESSION = array();

    // Effacer le cookie de session
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    // Détruire la session
    session_destroy();
}

// Fonction pour récupérer les informations de l'utilisateur connecté
function grab_user($mabd) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $req = $mabd->prepare('SELECT * FROM utilisateurs WHERE user_id = :user_id');
        $req->execute(array(':user_id' => $userId));
        $user = $req->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    return null;
}
?>
