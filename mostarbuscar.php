
<?php
require_once ("conexion.php");   

$nombre = $_GET["nombre_apellidos"];
$departamento = $_GET["area"];
$extension = $_GET["extension"];
$email = $_GET["email"];
$movil = $_GET["telefono_movil"];
$fijo = $_GET["telefono_fijo"];
$ord = $_GET["ord"];

if (!$nombre && !$departamento && !$extension && !$email && !$movil && !$fijo) {
    echo "<script>alert('Tienes que rellenar al menos un campo para la búsqueda');
    window.location.href='index.php';
    </script>";
} else {
    $consulta = "SELECT empleados.nombre_apellidos, empleados.extension, empleados.email, empleados.telefono_movil, empleados.telefono_fijo, area.nombre_area 
                 FROM empleados 
                 INNER JOIN area ON empleados.idArea = area.Id 
                 WHERE 1=1";

    // Añadir filtros si están presentes
    if ($nombre) {
        $consulta .= " AND empleados.nombre_apellidos LIKE '%$nombre%'";
    }
    if ($departamento) {
        $consulta .= " AND area.nombre_area LIKE '%$departamento%'";
    }
    if ($extension) {
        $consulta .= " AND empleados.extension LIKE '%$extension%'";
    }
    if ($email) {
        $consulta .= " AND empleados.email LIKE '%$email%'";
    }
    if ($movil) {
        $consulta .= " AND empleados.telefono_movil LIKE '%$movil%'";
    }
    if ($fijo) {
        $consulta .= " AND empleados.telefono_fijo LIKE '%$fijo%'";
    }

    $consulta .= " ORDER BY $ord;";
}


?>

<!doctype html>
<?php include("menu.php") ?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Directorio del Ayuntamiento de Santa Lucia</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" />
    <link rel="stylesheet" href="CSS/w3.css"> 
    <link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
</head>

<body>
<div><hr></div>

<!-- Tabla título -->
<div>
    <table align="center" width="70%" class="w3-round-large w3-teal">
        <tr>
            <td align="center" width="50%"><h2>Números Internos</h2></td>   
        </tr>    
    </table>
</div> 


<!-- Cabecera de tabla -->
<table align="center" width="80%">
    <tr class="w3-teal">
        <td width="20%" align="center" valign="top"><h3>Nombre</h3></td>
        <td width="20%" align="center" valign="top"><h3>Area</h3></td>
        <td width="25%" align="center" valign="top"><h3>Email</h3></td>
        <td width="15%" align="center" valign="top"><h3>Móvil</h3></td>
        <td width="15%" align="center" valign="top"><h3>Tlf Fijo</h3></td>
        <td width="30%" align="center" valign="top"><h3>Ext</h3></td>
    </tr>
</table>


<!-- Cuerpo de tabla -->
<?php
$result = $conn->query($consulta);

while($row = $result->fetch_assoc()) {
    echo "<table align='center' width='80%' class='w3-hoverable'>";
    echo "<tr class='w3-light-grey w3-hover-red'>";
    echo "<td width=20% align='center' valign='top'>" . $row["nombre_apellidos"] . "</td>";
    echo "<td width=20% align='center' valign='top'>" . $row["nombre_area"] . "</td>";
    echo "<td width=25% align='center' valign='top'>" . $row["email"] . "</td>";
    echo "<td width=15% align='center' valign='top'>" . $row["telefono_movil"] . "</td>";
    echo "<td width=15% align='center' valign='top'>" . $row["telefono_fijo"] . "</td>";
    echo "<td width=30% align='center' valign='top'>" . $row["extension"] . "</td>";
    echo "</tr>";
    echo "</table>";
}

$conn->close();
?>

<?php include("footer.html") ?> 
</body>
</html>