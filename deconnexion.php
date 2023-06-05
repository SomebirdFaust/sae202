<?php

require 'lib.inc.php';

$_SESSION=array();

session_destroy();

header('location:index.php');

?>