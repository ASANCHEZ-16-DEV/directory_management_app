<?php
require_once('../includes/conexion.php');

function loginUser($username, $password) {
    global $conn;

    if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => isset($_SERVER['HTTPS']), // True only on HTTPS
        'use_strict_mode' => true
    ]);
}


    $sql = "SELECT id, login, passwd, rol FROM usuarios WHERE login = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) return false;

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $inputHash = hash('sha256', $password);

       if (hash_equals($user['passwd'], $inputHash)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['rol'] = $user['rol'];
            $_SESSION['loggedin'] = true;
        return true;

    } else {
        error_log("Error: Los hashes no coinciden");
    }


    }

    return false;
}



// !? Function to verify if the user is logged in as a administrator role
function isAdmin() { 
    return isset($_SESSION['loggedin']) && 
           $_SESSION['loggedin'] === true && 
           $_SESSION['rol'] === 'administrador';
}

// !? Function to require active administrator session, and disconnect automaticaly after 10 minutes of inactivity
function requireAdmin() {
    error_log("DEBUG: Ejecutando requireAdmin()");

    // Max inactivity time
    define('MAX_INACTIVIDAD', 600); // 600 segundos = 10 minutos

    // Verify active session
    if (!isAdmin()) {
        error_log("DEBUG: Usuario no autorizado, redirigiendo...");
        header("Location: /admin/login.php");
        exit;
    }

    // Verify inactivity
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > MAX_INACTIVIDAD) {
        error_log("DEBUG: Sesión expirada por inactividad");
        session_unset();
        session_destroy();
        header("Location: /admin/login.php?expired=1");
        exit;
    }

    $_SESSION['LAST_ACTIVITY'] = time();
}



?>