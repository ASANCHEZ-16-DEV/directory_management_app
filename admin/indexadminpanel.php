<?php
require_once(__DIR__ . '/../includes/auth.php');
requireAdmin();
require_once(__DIR__ . '/../includes/conexion.php');

// Procesar eliminación si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    
    try {
        $stmt = $conn->prepare("DELETE FROM empleados WHERE Id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Empleado eliminado correctamente.";
        } else {
            $_SESSION['error_message'] = "Error al eliminar el empleado: " . $stmt->error;
        }
        
        $stmt->close();
        
        // Redirigir para evitar reenvío del formulario
        header("Location: indexadminpanel.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Error en la base de datos: " . $e->getMessage();
    }
}

// Procesar búsqueda
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = "SELECT e.Id, e.nombre_apellidos, e.extension, 
               e.telefono_fijo, e.telefono_movil, 
               e.email, a.nombre_area 
        FROM empleados e
        LEFT JOIN area a ON e.idArea = a.Id";

// Añadir condición de búsqueda si existe
if (!empty($search)) {
    $sql .= " WHERE e.nombre_apellidos LIKE ?";
    $search_term = "%$search%";
}

$sql .= " ORDER BY e.nombre_apellidos ASC";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
if (!empty($search)) {
    $stmt->bind_param("s", $search_term);
}

$stmt->execute();
$result = $stmt->get_result();
$empleados = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Administración - Directorio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/w3.css"> 
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin-styles.css">
</head>
<body>

<!-- Barra superior de administración -->
<div class="admin-bar">
    <div class="admin-title">Panel de Administración</div>
    <div class="admin-controls">
        <a href="logout.php" class="w3-button w3-red">
            <i class="fa fa-sign-out"></i> Cerrar sesión
        </a>
    </div>
</div>

<!-- Mostrar mensajes de éxito/error -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_message'] ?>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-error">
        <?= $_SESSION['error_message'] ?>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<!-- Barra de búsqueda -->
<div class="search-container">
    <form method="GET" action="indexadminpanel.php" class="w3-container" style="width:100%; display:flex;">
        <input type="text" name="search" class="search-input" 
               placeholder="Buscar por nombre..." 
               value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="search-btn">
            <i class="fa fa-search"></i> Buscar
        </button>
        <?php if (!empty($search)): ?>
            <a href="indexadminpanel.php" class="w3-button w3-small w3-red" 
               style="margin-left:10px; border-radius:25px;">
                <i class="fa fa-times"></i> Limpiar
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Contenedor de la tabla -->
<div class="admin-table-wrapper">
    <div class="admin-table-title">
        <i class="fa fa-users"></i> Gestión de Empleados
    </div>
    
    <!-- Botón para añadir nuevo empleado -->
    <a href="add_employee.php" class="add-btn">
        <i class="fa fa-plus"></i> Añadir Nuevo Empleado
    </a>
    
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Área</th>
                <th>Email</th>
                <th>Teléfono Móvil</th>
                <th>Teléfono Fijo</th>
                <th>Ext</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($empleados) > 0): ?>
                <?php foreach ($empleados as $empleado): ?>
                    <tr>
                        <td><?= htmlspecialchars($empleado['nombre_apellidos']) ?></td>
                        <td><?= htmlspecialchars($empleado['nombre_area'] ?? 'Sin área') ?></td>
                        <td><?= nl2br(htmlspecialchars($empleado['email'])) ?></td>
                        <td><?= htmlspecialchars($empleado['telefono_movil'] ?? '') ?></td>
                        <td><?= htmlspecialchars($empleado['telefono_fijo'] ?? '') ?></td>
                        <td><?= htmlspecialchars($empleado['extension'] ?? '') ?></td>
                        <td>
                            <a href="edit_employee.php?id=<?= $empleado['Id'] ?>" class="action-btn edit-btn">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                            <form method="POST" action="indexadminpanel.php" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?= $empleado['Id'] ?>">
                                <button type="submit" class="action-btn delete-btn" 
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar a <?= htmlspecialchars(addslashes($empleado['nombre_apellidos'])) ?>?')">
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="w3-center w3-text-red">
                        <?= empty($search) ? 'No hay empleados registrados.' : 'No se encontraron resultados.' ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
$conn->close();
include(__DIR__ . "/../footer.html");
?>
</body>
</html>