// * BACKEND DE LA FUNCION DEL BOTON BUSCAR

<?php
require_once ("conexion.php");   
$nombre=$_GET["nombre"];
$departamento=$_GET["departamento"];
$extension=$_GET["extension"];
$ord=$_GET["ord"];


if (!$nombre && !$departamento && !$extension)
{
   echo "<script>alert('Tienes que rellenar al menos un campo para la busqueda');
   window.location.href='index.php';
   </script>";
    
}else{
    if (!$departamento && !$extension){
        $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where usuarios.nombre like '%$nombre%' order by $ord;";
    }else{
        if(!$nombre && !$departamento){
           $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where usuarios.extension like '%$extension%' order by $ord;"; 
        }else{
            if(!$nombre && !$extension){
               $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where departamentos.departamento like '%$departamento%' order by $ord;";  
            }else{
                if (!$extension){
                     $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where usuarios.nombre like '%$nombre%' and departamentos.departamento like '%$departamento%' order by $ord;"; 
                }else{
                    if (!$departamento){
                         $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where usuarios.nombre like '%$nombre%' and usuarios.extension like '%$extension%' order by $ord;"; 
                    }else{
                        if (!$nombre){
                            $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where usuarios.extension like '%$extension%' and departamentos.departamento like '%$departamento%' order by $ord;"; 
                        }else{
                            $consulta="select usuarios.nombre,usuarios.extension,departamentos.departamento from (usuarios inner join departamentos on usuarios.id_departamento=departamentos.id_departamento) where usuarios.nombre like '%$nombre%' and departamentos.departamento like '%$departamento%' and usuarios.extension like '%$extension%' order by $ord;"; 
                        }
                    }
                }
            }
        }
    }
}

?>

<!doctype html>
    <?php
include ("menu.php")
?>
<html>
<head>
    <meta charset="UTF-8">

    <title>Directorio del Ayuntamiento de Santa Lucia</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" />
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/w3.css"> 
	<link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">

</head>

  

 <body>  
 <div> <hr></div>
    <!-- Tabla para mostar los datos de la busqueda -->
 <div>  
<table align="center" width="70%" class="w3-round-large w3-teal">
	<tr>
		<td align="center" width="50%"><h2>Números Internos</h2></td>   
	</tr>    
</table>
</div> 

<table align="center" width="80%">
	<tr class="w3-teal">
		<td width="40%" align="center" valign="top">
			<h3>Nombre</h3>
		</td>
		
		<td width="20%" align="center" valign="top">
			<h3>Ext</h3>
		</td>

		<td width="40%" align="center" valign="top">
			<h3>Departamento</h3>
		</td>
		
		
	</tr>
</table>
<?php
  
		$result=$conn->query($consulta);
        
    
    while($row = $result->fetch_assoc()) {
       /* echo "Nombre: " . $row["nombre"]. " " . $row["apellidos"]. " " . $row["extension"]. " " . $row["email"]. " " . $row["departamento"]. " " . $row["edificio"]."<br>";*/
echo "<table align='center' width='80%' class='w3-hoverable'>";
echo  "<tr class='w3-light-grey w3-hover-red'>";
echo "<td width=40% align='center' valign='top'>";
echo $row["nombre"]; 
echo "</td>";
echo "<td width=20% align='center' valign='top'>";
echo $row["extension"];
echo "</td>";
echo "<td width=40% align='center' valign='top'>";
echo $row["departamento"];
echo "</td>";
echo "</tr>";
            
    }
  
  $conn->close();           

    
?>
</table>
<?php
include ("footer.html")
?> 

</body>
</html>
