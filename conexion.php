<?php
// String de conexión a la base de datos de directorio
$usuario = "root";
$pass = "";
$server = "localhost";
$db = "directorio";

// Creamos la conexión
$conn = new mysqli($server, $usuario, $pass, $db);
$conn->set_charset('utf8');

// Verificar conexión
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    die("Error en el sistema. Por favor, inténtelo más tarde.");
}

// Configuración de sesión segura
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => false,
    'use_strict_mode' => true
]);
?>