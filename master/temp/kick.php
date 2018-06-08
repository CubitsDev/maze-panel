<?php

session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();
header("location: login.php?failed=1");
exit;

 ?>
