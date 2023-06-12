<?php
require 'admin/lib.inc.php';

deconnecterUtilisateur();

session_start();
session_destroy();

header('Location: index.php');
exit();
?>
