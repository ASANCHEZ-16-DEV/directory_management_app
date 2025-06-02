<?php
require_once(__DIR__ . '/../conexion.php');

// ? Código para comprobar los hashes de las contraseñas de los usuarios contra la base de datos mediante un input 

$username = 'admin'; // ! Esto son datos ficticios para testing
$password = 'password';

$sql = "SELECT id, login, passwd, rol FROM usuarios WHERE login = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $inputHash = hash('sha256', $password);
    
    echo "Input hash: $inputHash <br>";
    echo "DB hash: " . $user['passwd'] . "<br>";

    if (hash_equals($user['passwd'], $inputHash)) {
        echo "✅ ¡Login exitoso!";
    } else {
        echo "❌ Hashes no coinciden.";
    }
} else {
    echo "❌ Usuario no encontrado.";
}
