<?php
require_once('../includes/auth.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['login'] ?? '');
    $password = $_POST['passwd'] ?? '';

    if (loginUser($username, $password)) {
        if ($_SESSION['rol'] === 'administrador') {
            header("Location: indexadminpanel.php");
            exit;
        } else {
            $error = "No tienes permisos de administrador";
            session_destroy();
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
    // }
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
        <!-- // ? Barra superior con botón de administración -->
<div class="w3-bar w3-orange">
    <a href="/index.php" class="w3-bar-item w3-button">Directorio del Ateneo</a>
</div>

    <div class="login-container w3-card-4">
        <h2 class="w3-center">Acceso Administrador</h2>
        
        <?php if (!empty($error)): ?>
            <div class="w3-panel w3-red">
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <form method="post" class="w3-container" id="loginForm">
            <div class="w3-section">
                <label><b>Usuario</b></label>
                <input class="w3-input w3-border" type="text" name="login" id="login" required>

                <label><b>Contraseña</b></label>
                <input class="w3-input w3-border" type="password" name="passwd" id="passwd" required>

                <!-- Protección CSRF opcional -->
                <!-- <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>"> -->

                <button class="w3-button w3-block w3-orange w3-section w3-padding" type="submit">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</body>
</html>
