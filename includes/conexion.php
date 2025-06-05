<?php
// ? Database parameters
$usuario = "root";
$pass = "";
$server = "localhost";
$db = "directorio";

// ? Create connection with mysqli
$conn = new mysqli($server, $usuario, $pass, $db);

// ? Establish utfmb4 charset
$conn->set_charset('utf8mb4'); 

// ? Verify connection errors
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    http_response_code(500);
    die("Error en el sistema. Por favor, inténtelo más tarde.");
}

// ? Start secure connection
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_strict_mode', 1);
    
    //  ! Be secure to use on in https production
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', 1);
    }

    session_start();
}


?>
