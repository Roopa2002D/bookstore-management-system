<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to logout.html
header("Location: logout.html");
exit();
?>
