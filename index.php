<?php
require_once ("conexion.php");    

if(isset($_POST['filtro'])) {
    $dep = $_POST["dep"];
    $ord = $_POST["ord"];
    $sql = "SELECT empleados.nombre_apellidos, empleados.extension, empleados.telefono_fijo, empleados.telefono_movil, empleados.email, area.nombre_area FROM (empleados INNER JOIN area ON empleados.idArea = area.Id) WHERE area.nombre_area = '$dep' ORDER BY $ord;";
} else {
    $sql = "SELECT empleados.nombre_apellidos, empleados.extension, empleados.telefono_fijo, empleados.telefono_movil, empleados.email, area.nombre_area FROM (empleados INNER JOIN area ON empleados.idArea = area.Id) ORDER BY area.nombre_area;";
}
?>

<?php include("menu.php"); ?>

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

<form name="filtrar" action="index.php" method="post" align="center" class="w3-container w3-card-4 w3-light-grey w3-text-teal w3-margin" style="width:50%">
    <h2 class="w3-center">Filtrar</h2>
    <label class="w3-text-teal w3-xlarge fa fa-users"><b> Área</b></label><br><br>
    <select name="dep" class="w3-select w3-border">
        <option value="" disabled selected>Selecciona un Área</option>
        <?php
            $consulta = "SELECT nombre_area FROM area ORDER BY nombre_area ASC;";
            $result = $conn->query($consulta);
            while($lineas = $result->fetch_assoc()) {
                echo "<option value='".$lineas["nombre_area"]."'>".$lineas["nombre_area"]."</option>";
            }
        ?>
    </select>
    <br><br>

    <label class="w3-text-teal fa fa-sort-alpha-asc"><b> Ordenar por:</b></label>  
    <input class="w3-radio" type="radio" name="ord" value="empleados.nombre_apellidos" checked> Nombre
    <input class="w3-radio" type="radio" name="ord" value="empleados.extension"> Extensión<br><br>

    <div class="w3-row w3-section">  
        <button class="w3-button w3-section w3-teal w3-ripple w3-padding w3-large fa fa-filter" type="submit" name="filtro" value="Filtrar" title="Filtrar"> Filtrar </button>
        <a href="index.php" class="w3-btn w3-teal w3-large fa fa-close"> Quitar Filtro</a>
    </div>
</form>

<!-- Encabezado de la tabla -->
<!-- Tabla moderna con título unificado y efecto Paper -->
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
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nombre_apellidos"] . "</td>";
                echo "<td>" . $row["extension"] . "</td>";
                echo "<td>" . $row["nombre_area"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["telefono_movil"] . "</td>";
                echo "<td>" . $row["telefono_fijo"] . "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php
$conn->close();
include("footer.html");
?>

</body>
</html>
