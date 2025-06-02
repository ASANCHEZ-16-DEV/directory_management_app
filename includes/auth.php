<?php
require_once(__DIR__ . '/../conexion.php');

function loginUser($username, $password) {
    global $conn;

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