<?php
require_once('../includes/auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (loginUser($username, $password)) {
        if (isAdmin()) {
            header("Location: index.php");
            exit;
        } else {
            $error = "No tienes permisos de administrador";
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Administrador</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/w3.css">
    <link rel="stylesheet" href="../CSS/styles.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="login-container w3-card-4">
        <h2 class="w3-center">Acceso Administrador</h2>
        
        <?php if (isset($error)): ?>
            <div class="w3-panel w3-red">
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>
        
        <form method="post" class="w3-container">
            <div class="w3-section">
                <label><b>Usuario</b></label>
                <input class="w3-input w3-border" type="text" name="username" required>
                
                <label><b>Contraseña</b></label>
                <input class="w3-input w3-border" type="password" name="password" required>
                
                <button class="w3-button w3-block w3-orange w3-section w3-padding" type="submit">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</body>
</html>