<?php
require_once("conexion.php");

// TODO : Corregir para que no pida login al entrar a index.php

// Inicializar parámetros
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$dep = isset($_POST['dep']) ? $_POST['dep'] : '';
$ord = isset($_POST['ord']) ? $_POST['ord'] : 'empleados.nombre_apellidos';

// Construir consulta base
$sql = "SELECT empleados.nombre_apellidos, empleados.extension, 
               empleados.telefono_fijo, empleados.telefono_movil, 
               empleados.email, area.nombre_area 
        FROM empleados 
        INNER JOIN area ON empleados.idArea = area.Id";

// Preparar condiciones
$conditions = [];
$params = [];
$types = '';

if (isset($_POST['filtro'])) {
    if (!empty($nombre)) {
        $conditions[] = "empleados.nombre_apellidos LIKE ?";
        $params[] = "%$nombre%";
        $types .= 's';
    }

    if (!empty($dep)) {
        $conditions[] = "area.nombre_area = ?";
        $params[] = $dep;
        $types .= 's';
    }
}

// Añadir condiciones si existen
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Validar ordenación
$allowed_orders = ['empleados.nombre_apellidos', 'empleados.extension', 'area.nombre_area'];
if (!in_array($ord, $allowed_orders)) {
    $ord = 'empleados.nombre_apellidos';
}
$sql .= " ORDER BY $ord";

/**
 * echo "<pre>";
 *echo "SQL final: " . $sql . "\n";
 *echo "Parámetros: " . print_r($params, true) . "\n";
 *echo "Tipos: $types\n";
 *echo "</pre>";
 */
// DEBUG: Mostrar consulta SQL (solo para desarrollo)


try {
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conn->error);
    }

    // Bind de parámetros si los hay
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    if (!$stmt->execute()) {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }

    $stmt->store_result();
    $stmt->bind_result($nombre_apellidos, $extension, $telefono_fijo, $telefono_movil, $email, $nombre_area);

    $hay_resultados = $stmt->num_rows > 0;

} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>


<!doctype html>
<html>
<head>
    <title>Directorio del Ateneo Santa Lucía de Tirajana</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/w3.css"> 
    <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSS/styles.css">
</head>
<body>

<!-- Barra superior con botón de administración -->
<div class="w3-bar w3-orange">
    <a href="index.php" class="w3-bar-item w3-button">Directorio</a>
    <a href="admin/login.php" class="w3-bar-item w3-button w3-right">
        <i class="fa fa-lock"></i> Acceso Administración
    </a>
</div>

<!-- Filtro + logo en contenedor conjunto -->
<div class="filter-logo-container">
    <div class="modern-filter-wrapper">
        <div class="modern-table-title">
            <i class="fa fa-filter"></i> Filtrar Directorio
        </div>
        
        <form name="filtrar" action="index.php" method="post" class="modern-filter-content">
            <!-- TODO el contenido del formulario igual que antes -->
            <!-- Buscar por nombre -->
            <div class="w3-margin-bottom">
                <label class="filter-label"><i class="fa fa-search w3-text-orange"></i> Buscar por Nombre</label>
                <input class="filter-select" type="text" name="nombre" placeholder="Introduce nombre o apellidos"
                    value="<?= isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '' ?>">
            </div>

            <!-- Área -->
            <div class="w3-margin-bottom">
                <label class="filter-label"><i class="fa fa-users w3-text-orange"></i> Seleccionar Área</label>
                <select name="dep" class="filter-select">
                    <option value="" <?= !isset($_POST['dep']) ? 'selected' : '' ?>>Todas las áreas</option>
                    <?php
                        $consulta = "SELECT nombre_area FROM area ORDER BY nombre_area ASC;";
                        $result_area = $conn->query($consulta);
                        while ($lineas = $result_area->fetch_assoc()) {
                            $selected = (isset($_POST['dep']) && $_POST['dep'] == $lineas["nombre_area"]) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($lineas["nombre_area"]) . "' $selected>" . htmlspecialchars($lineas["nombre_area"]) . "</option>";
                        }
                    ?>
                </select>
            </div>

            <!-- Ordenar por -->
            <div class="filter-radio-group">
                <label class="filter-label"><i class="fa fa-sort w3-text-orange"></i> Ordenar por:</label>

                <label class="filter-radio-label">
                    <input class="filter-radio" type="radio" name="ord" value="empleados.nombre_apellidos"
                        <?= (!isset($_POST['ord']) || $_POST['ord'] == 'empleados.nombre_apellidos') ? 'checked' : '' ?>>
                    Nombre (A-Z)
                </label>

                <label class="filter-radio-label">
                    <input class="filter-radio" type="radio" name="ord" value="empleados.extension"
                        <?= (isset($_POST['ord']) && $_POST['ord'] == 'empleados.extension') ? 'checked' : '' ?>>
                    Extensión
                </label>

                <label class="filter-radio-label">
                    <input class="filter-radio" type="radio" name="ord" value="area.nombre_area"
                        <?= (isset($_POST['ord']) && $_POST['ord'] == 'area.nombre_area') ? 'checked' : '' ?>>
                    Área
                </label>
            </div>

            <!-- Botones -->
            <div class="w3-row w3-section" style="margin-top: 25px;">
                <div class="w3-half" style="padding-right: 10px;">
                    <button class="modern-btn w3-block" type="submit" name="filtro" title="Filtrar">
                        <i class="fa fa-filter"></i> Aplicar Filtros
                    </button>
                </div>
                <div class="w3-half" style="padding-left: 10px;">
                    <a href="index.php" class="modern-btn w3-block w3-orange">
                        <i class="fa fa-times"></i> Limpiar Filtros
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Logo a la derecha -->
    <div>
        <img src="imagenes/Ateneologo.jpg" alt="Logo del Ateneo" class="logo-ateneo">
    </div>
</div>



<!-- Tabla moderna -->
<div class="modern-table-wrapper">
    <div class="modern-table-title">Personal interno</div>
    <table class="modern-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ext</th>
                <th>Área</th>
                <th>Email</th>
                <th>Teléfono Móvil</th>
                <th>Teléfono Fijo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($hay_resultados) {
                    while ($stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($nombre_apellidos) . "</td>";
                        echo "<td>" . htmlspecialchars($extension) . "</td>";
                        echo "<td>" . htmlspecialchars($nombre_area) . "</td>";
                        echo "<td>" . htmlspecialchars($email) . "</td>";
                        echo "<td>" . htmlspecialchars($telefono_movil) . "</td>";
                        echo "<td>" . htmlspecialchars($telefono_fijo) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='w3-center w3-text-red'>No se encontraron resultados.</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include("footer.html");
?>
</body>
</html>
