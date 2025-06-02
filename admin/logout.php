<?php
require_once('../includes/auth.php');

// Destroy variables
$_SESSION = array();

// Delete actual cookie session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy session
session_destroy();

// Redirect to login
header("Location: login.php");
exit;
?>