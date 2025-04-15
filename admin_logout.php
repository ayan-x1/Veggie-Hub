<?php
session_start();

// Clear all session variables
$_SESSION = array();
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: admin_login.php");
exit;
?>