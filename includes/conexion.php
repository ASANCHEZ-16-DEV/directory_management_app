<?php
// Parámetros de conexión a la base de datos
$usuario = "root";
$pass = "";
$server = "localhost";
$db = "directorio";

// Crear la conexión usando MySQLi orientado a objetos
$conn = new mysqli($server, $usuario, $pass, $db);

// Establecer el charset a UTF-8
$conn->set_charset('utf8mb4'); // Establecemos utf8mb4 al igual que en la base de datos

// Verificar errores de conexión
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    http_response_code(500);
    die("Error en el sistema. Por favor, inténtelo más tarde.");
}

// Iniciar sesión segura
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    
    //  ! Asegurarse de usar HTTPS en producción antes de activar esto
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', 1);
    }

    session_start();
}


?>
