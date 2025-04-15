<?php
// Usa __DIR__ para obtener la ruta absoluta
require_once(__DIR__ . '/../includes/auth.php');
requireAdmin();

// Aquí iría la lógica específica del panel de administración
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/w3.css">
    <link rel="stylesheet" href="../CSS/styles.css">
</head>
<body>

<!-- Barra de navegación -->
<div class="w3-bar w3-orange">
    <span class="w3-bar-item">Panel de Administración</span>
    <a href="../index.php" class="w3-bar-item w3-button">Ver Directorio</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-right">Cerrar Sesión</a>
</div>

<div class="w3-container w3-margin-top">
    <div class="w3-row-padding">
        <!-- Menú lateral -->
        <div class="w3-col m3">
            <div class="w3-card">
                <div class="w3-container w3-orange">
                    <h4>Menú</h4>
                </div>
                <div class="w3-container w3-padding-16">
                    <a href="?section=dashboard" class="w3-button w3-block w3-left-align">Inicio</a>
                    <a href="?section=users" class="w3-button w3-block w3-left-align">Gestión de Usuarios</a>
                    <a href="?section=employees" class="w3-button w3-block w3-left-align">Gestión de Empleados</a>
                    <a href="?section=areas" class="w3-button w3-block w3-left-align">Gestión de Áreas</a>
                </div>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="w3-col m9">
            <div class="w3-card">
                <div class="w3-container w3-orange">
                    <h4>Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?></h4>
                </div>
                <div class="w3-container w3-padding-16">
                    <?php
                    $section = $_GET['section'] ?? 'dashboard';
                    
                    switch ($section) {
                        case 'users':
                            include('sections/users.php');
                            break;
                        case 'employees':
                            include('sections/employees.php');
                            break;
                        case 'areas':
                            include('sections/areas.php');
                            break;
                        default:
                            echo '<p>Seleccione una opción del menú para comenzar.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>