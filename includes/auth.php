<?php
require_once(__DIR__ . '/../conexion.php');

function loginUser($username, $password) {
    global $conn;
    
    $sql = "SELECT id, login, passwd, rol FROM usuarios WHERE login = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Error preparando consulta: " . $conn->error);
        return false;
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_username, $db_password, $rol);
        $stmt->fetch();
        
        // Verificar contraseña (SHA-256 en tu caso)
        $hashed_password = hash('sha256', $password);
        
        if ($hashed_password === $db_password) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            $_SESSION['user_rol'] = $rol;
            $_SESSION['loggedin'] = true;
            
            // Regenerar ID de sesión para prevenir fixation
            session_regenerate_id(true);
            
            return true;
        }
    }
    
    return false;
}

function isAdmin() {
    return isset($_SESSION['loggedin']) && 
           $_SESSION['loggedin'] === true && 
           $_SESSION['user_rol'] === 'administrador';
}

function requireAdmin() {
    if (!isAdmin()) {
        header("Location: /admin/login.php");
        exit;
    }
}
?>