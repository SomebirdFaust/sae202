<?php
require 'admin/lib.inc.php';
require 'header.php';

$_SESSION=array();

session_destroy();

header('location:index.php');

?>