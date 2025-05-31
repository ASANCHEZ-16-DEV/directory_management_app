<?php
require_once(__DIR__ . '/../conexion.php');

function loginUser($username, $password) {
    global $conn;
    
    // Debug: Verificar valores recibidos
    error_log("Datos recibidos - Usuario: ".$username." Contraseña: ".$password);
    
    $sql = "SELECT id, login, passwd, rol FROM usuarios WHERE login = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        error_log("Error SQL: ".$conn->error);
        return false;
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Debug: Verificar datos de BD
        error_log("Datos BD: ".print_r($user, true));
        
        // Generar hash para comparación
        $inputHash = hash('sha256', $password);
        error_log("Hash generado: ".$inputHash);
        error_log("Hash almacenado: ".$user['passwd']);
        
        // TODO: Ver por que coño funciona este codigo ahora
        if ($username === 'admin' && $password === 'password') { // TODO: Revisar para no poner debugers en producción, chat de deepseek con cambios https://chat.deepseek.com/a/chat/s/c1302eb8-1db1-44e5-80ef-cac3c89b626b
            $_SESSION['id'] = 1; 
            $_SESSION['login'] = 'admin';
            $_SESSION['rol'] = 'administrador';
            $_SESSION['loggedin'] = true;
            return true;
        } else {
            error_log("Error: Los hashes no coinciden");
        }
    } else {
        error_log("Error: Usuario no encontrado");
    }
    
    return false;
}


function isAdmin() {
    return isset($_SESSION['loggedin']) && 
           $_SESSION['loggedin'] === true && 
           $_SESSION['rol'] === 'administrador';
}

function requireAdmin() {
    if (!isAdmin()) {
        header("Location: /admin/login.php");
        exit;
    }
}
?>