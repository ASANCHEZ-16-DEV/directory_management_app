<?php
require_once(__DIR__ . '/../includes/auth.php');
requireAdmin();
require_once(__DIR__ . '/../includes/conexion.php');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$areas = [];
$error = '';
$success = '';
$empleado = null;

// Get areas
$sql_areas = "SELECT Id, nombre_area FROM area ORDER BY nombre_area ASC";
$result_areas = $conn->query($sql_areas);
if ($result_areas) {
    $areas = $result_areas->fetch_all(MYSQLI_ASSOC);
}

// Get employee data
if ($id > 0) {
    $sql_empleado = "SELECT * FROM empleados WHERE Id = ?";
    $stmt = $conn->prepare($sql_empleado);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $empleado = $result->fetch_assoc();
    $stmt->close();
    
    if (!$empleado) {
        $error = 'Empleado no encontrado';
        $_SESSION['error_message'] = $error;
        header('Location: indexadminpanel.php');
        exit();
    }
} else {
    $error = 'ID de empleado no válido';
    $_SESSION['error_message'] = $error;
    header('Location: indexadminpanel.php');
    exit();
}

// Process form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate data
    $empleado['nombre_apellidos'] = trim($_POST['nombre_apellidos'] ?? '');
    $empleado['email'] = trim($_POST['email'] ?? '');
    $empleado['telefono_movil'] = trim($_POST['telefono_movil'] ?? '');
    $empleado['telefono_fijo'] = trim($_POST['telefono_fijo'] ?? '');
    $empleado['extension'] = trim($_POST['extension'] ?? '');
    $empleado['idArea'] = $_POST['idArea'] ?? null;
    
    // More validations
    if (empty($empleado['nombre_apellidos'])) {
        $error = 'El nombre es obligatorio';
    } elseif (empty($empleado['email'])) {
        $error = 'El email es obligatorio';
    } elseif (!filter_var($empleado['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'El email no es válido';
    } else {
        try {
            // Update database
            $stmt = $conn->prepare("UPDATE empleados SET 
                nombre_apellidos = ?,
                email = ?,
                telefono_movil = ?,
                telefono_fijo = ?,
                extension = ?,
                idArea = ?
                WHERE Id = ?");
                
            $telefono_movil = !empty($empleado['telefono_movil']) ? $empleado['telefono_movil'] : null;
            $telefono_fijo = !empty($empleado['telefono_fijo']) ? $empleado['telefono_fijo'] : null;
            $extension = !empty($empleado['extension']) ? $empleado['extension'] : null;
            $idArea = !empty($empleado['idArea']) ? $empleado['idArea'] : null;
            
            $stmt->bind_param("sssssii", 
                $empleado['nombre_apellidos'],
                $empleado['email'],
                $telefono_movil,
                $telefono_fijo,
                $extension,
                $idArea,
                $id
            );
            
            if ($stmt->execute()) {
                $_SESSION['success_message'] = 'Empleado actualizado correctamente';
                header('Location: indexadminpanel.php');
                exit();
            } else {
                $error = 'Error al actualizar el empleado: ' . $stmt->error;
            }
        } catch (Exception $e) {
            $error = 'Error en la base de datos: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Empleado - Panel de Administración</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/w3.css"> 
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/admin-styles.css">
</head>
<body>

<!-- Top administrator feature -->
<div class="admin-bar">
    <div class="admin-title">Editar Empleado</div>
    <div class="admin-controls">
        <a href="indexadminpanel.php" class="w3-button w3-orange">
            <i class="fa fa-arrow-left"></i> Volver
        </a>
    </div>
</div>

<!-- Show error messages -->
<?php if ($error): ?>
    <div class="alert alert-error">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!-- Form -->
<div class="admin-form-container">
    <h2 class="admin-form-title">
        <i class="fa fa-user-edit"></i> Editar Empleado: <?= htmlspecialchars($empleado['nombre_apellidos']) ?>
    </h2>
    
    <form method="POST" class="admin-form">
        <div class="form-group full-width">
            <label class="form-label">Nombre y Apellidos*</label>
            <input type="text" name="nombre_apellidos" class="form-input" 
                   value="<?= htmlspecialchars($empleado['nombre_apellidos']) ?>" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Email*</label>
            <input type="email" name="email" class="form-input" 
                   value="<?= htmlspecialchars($empleado['email']) ?>" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Teléfono Móvil</label>
            <input type="tel" name="telefono_movil" class="form-input" 
                   value="<?= htmlspecialchars($empleado['telefono_movil']) ?>">
        </div>
        
        <div class="form-group">
            <label class="form-label">Teléfono Fijo</label>
            <input type="tel" name="telefono_fijo" class="form-input" 
                   value="<?= htmlspecialchars($empleado['telefono_fijo']) ?>">
        </div>
        
        <div class="form-group">
            <label class="form-label">Extensión</label>
            <input type="number" name="extension" class="form-input" 
                   value="<?= htmlspecialchars($empleado['extension']) ?>">
        </div>
        
        <div class="form-group">
            <label class="form-label">Área/Departamento</label>
            <select name="idArea" class="form-input">
                <option value="">Seleccione un área...</option>
                <?php foreach ($areas as $area): ?>
                    <option value="<?= $area['Id'] ?>" 
                        <?= ($empleado['idArea'] == $area['Id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($area['nombre_area']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="add-btn">
                <i class="fa fa-save"></i> Guardar Cambios
            </button>
            <a href="indexadminpanel.php" class="action-btn delete-btn">
                <i class="fa fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<?php
$conn->close();
include(__DIR__ . "/../footer.html");
?>
</body>
</html>