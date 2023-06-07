<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('connexionBD')) {
    function connexionBD()
    {
        $mabd = null;
        $mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
        $mabd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $mabd->query('SET NAMES utf8;');
        return $mabd;
    }
}

if (!function_exists('deconnexionBD')) {
    function deconnexionBD(&$mabd)
    {
        unset($mabd);
    }
}
?>

<?php

function user_deco()
{
    $_SESSION=array();

    session_destroy();

    header('location:index.php');
}
?>