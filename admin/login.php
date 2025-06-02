<?php
require_once('../includes/auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['login'] ?? '');
    $password = $_POST['passwd'] ?? '';
    
    if (loginUser($username, $password)) {
        if ($_SESSION['rol'] === 'administrador') {  // Verificación de rol
            header("Location: indexadminpanel.php");    // Redirigir al panel
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
        
      <!-- Modifica el formulario cambiando los "name" -->
    <form method="post" class="w3-container" id="loginForm">
        <div class="w3-section">
            <label><b>Usuario</b></label>
            <input class="w3-input w3-border" type="text" name="login" id="login" required>  <!-- Cambiado de username a login -->
            
            <label><b>Contraseña</b></label>
            <input class="w3-input w3-border" type="password" name="passwd" id="passwd" required>  <!-- Cambiado de password a passwd -->
            
            <button class="w3-button w3-block w3-orange w3-section w3-padding" type="submit">
                Iniciar Sesión
            </button>
        </div>
    </form>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            // Actualiza los IDs para coincidir con los nuevos nombres
            const login = document.getElementById('login').value;
            const passwd = document.getElementById('passwd').value;
            
            console.log('Debug Login - Datos introducidos:');
            console.log('Login:', login);
            console.log('Passwd:', passwd);
        });
    </script>
</body>
</html>