<?php
require_once ("conexion.php");    

// *REQUIERE LA CONEXIÓN DE LA BASE DE DATOS
// TODO: Continuar con la migracion de campos de la base de datos anterior

if(isset($_POST['filtro']))
{
    $dep = $_POST["dep"];
    $ord=$_POST["ord"];
    // search in all table columns
    // using concat mysql function
    // ? empleados.idArea is an inner join on area.Id to make references
    $sql="select empleados.nombre_apellidos,empleados.extension,empleados.telefono_fijo,empleados.telefono_movil,empleados.email,area.nombre_area from (empleados inner join area on empleados.idArea=area.Id) where area.nombre_area='$dep' order by $ord;";
} 
else {
     //SQL para mostrar la tabla usuarios
    $sql="select empleados.nombre_apellidos,empleados.extension,empleados.telefono_fijo,empleados.telefono_movil,empleados.email,area.nombre_area from (empleados inner join area on empleados.idArea=area.Id) order by area.nombre_area;";
}
?>
 <?php
 // * LLAMA A LA FUNCION MENU QUE MUESTRA EL BOTON DE INICIO Y DE BUSCAR
include ("menu.php")
?>
<!doctype html>
<html>
    
<head>
    <title>Directorio del Ateneo Santa Lucía de Tirajana </title>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="CSS/w3.css"> 
	<link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
</head>
<body>

    <form name="filtrar" action="index.php" method="post" align="center" class="w3-container w3-card-4 w3-light-grey w3-text-teal w3-margin" style="width:50%">
        <h2 class="w3-center">Filtrar</h2>
       <label class="w3-text-teal w3-xlarge fa fa-users"><b> Area</b></label>
       <br><br>

        <select name="dep"  class="w3-select w3-border">
			<option value="" disabled selected>Selecciona un Area</option>
            <?php
                $consulta="select nombre_area from area order by nombre_area asc;";
                $result=$conn->query($consulta);
                while($lineas = $result->fetch_assoc()){
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
    <br>  

<!--Mostrar todos los datos-->
<div>
<table align="center" width="70%" class="w3-round-large w3-teal">
	<tr>
		<td align="center" width="50%"><h2>Personal interno</h2></td>   
	</tr>    
</table>
</div>  

<!--Tabla de resultados-->
<table align="center" width="80%">
	<tr class="w3-teal">
		<td width="25%" align="center" valign="top">
			<h3>Nombre</h3>
		</td>
		
		<td width="5%" align="center" valign="top">
			<h3>Ext</h3>
		</td>

		<td width="25%" align="center" valign="top">
			<h3>Area</h3> 
		</td>

        <td width="15%" align="center" valign="top">
			<h3>Email</h3>
		</td>
		
		<td width="15%" align="center" valign="top">
			<h3>Teléfono Móvil</h3>
		</td>
		
		<td width="15%" align="center" valign="top">
			<h3>Tlf Fijo</h3>
		</td>
	</tr>
</table>

<?php
  // Subfuncion para rellenar la tabla con los datos de la query
  $result=$conn->query($sql);
  while($row = $result->fetch_assoc()) {
    echo "<table align='center' width='80%' class='w3-hoverable'>";
    echo  "<tr class='w3-light-grey w3-hover-red'>";
    echo "<td width=25% align='center' valign='top'>" . $row["nombre_apellidos"] . "</td>";
    echo "<td width=5% align='center' valign='top'>" . $row["extension"] . "</td>";
    echo "<td width=25% align='center' valign='top'>" . $row["nombre_area"] . "</td>";
    echo "<td width=15% align='center' valign='top'>" . $row["email"] . "</td>";
    echo "<td width=15% align='center' valign='top'>" . $row["telefono_movil"] . "</td>";
    echo "<td width=15% align='center' valign='top'>" . $row["telefono_fijo"] . "</td>";
    echo "</tr>";
  }
?>

</table>

<?php
  $conn->close();           
?>

<?php
include ("footer.html")
?>   

</body>
</html>
