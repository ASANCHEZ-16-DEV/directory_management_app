<?php
require_once(__DIR__ . '/../includes/auth.php');
requireAdmin();

// * Code for administrator features web
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Administración</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet"> 
    <style>
        .logout-btn {
            display: inline-block;
            margin: 20px;
            padding: 10px 15px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <p>Página cargada correctamente tras inicio de sesión</p>

    <a href="logout.php" class="logout-btn">Cerrar sesión</a>
</body>
</html>
