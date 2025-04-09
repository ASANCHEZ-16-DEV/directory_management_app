 <?php
require_once ("../conexioninsertar.php");
include ("../menu.php");


if(isset($_POST['insertar']))
{
		$nombre = $_POST["nombre"];
		$extension = $_POST["extension"];
		$dep = $_POST["dep"];
		$externos = $_POST["externos"];
		$stmt = $conn->prepare("INSERT INTO usuarios (nombre, extension, id_departamento, externos) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("siii", $nombre, $extension, $dep, $externos);
		if ($stmt->execute()) { 
			echo "Registro correcto";
		} else {
			echo "Error al en el registro";
		}
		
		$stmt->close();
}


?>


<!doctype html>
<html>
    
<head>
    
  
    <link rel="stylesheet" href="CSS/w3.css"> 
      
    <title>Insertar</title>
    <link rel="shortcut icon" href="../imagenes/favicon.ico" />
</head>
<body>
     <form form name="insertar" action="insertar.php" method="post" align="center">
	 <fieldset>
            <legend>Insertar:</legend>
  Nombre:<br>
  <input type="text" name="nombre"><br>
  Extensión:<br>
  <input type="text" name="extension">
  Departamento:
  <select name="dep" class="campos">
            <?php
                $consulta="select id_departamento, departamento from departamentos order by departamento asc;";
                $result=$conn->query($consulta);
                  while($lineas = $result->fetch_assoc()){
                    echo "<option value='".$lineas["id_departamento"]."'>".$lineas["departamento"]."</option>";
                     }
            ?>
        </select><br>
	Externo:<br>
	<input type="text" name="externos">		
		<input class="botones" type="submit" name="insertar" value="Insertar" title="Insertar">
		</fieldset>
</form> 
    

 <?php
  $conn->close();           
?>   
    
</body>
</html>
