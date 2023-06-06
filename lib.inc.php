<?php
session_start();
require 'secretxyz123.php';

function connexionBD()

{

$mabd=null;


$mabd = new PDO('mysql:host=localhost;dbname=sae202;charset=UTF8;', 'sae202admin', 'WW3dbpasswd202');
$mabd->query('SET NAMES utf8;');

return $mabd;

}

function deconnexionBD(&$mabd) {

   unset ($mabd);

}
?>