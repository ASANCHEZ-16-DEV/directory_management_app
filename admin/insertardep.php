 <?php
require_once ("conexion.php");
include ("menu.php");


if(isset($_POST['insertar']))
{
		$departamento = $_POST["departamento"];
		$stmt = $conn->prepare("INSERT INTO departamentos (departamento) VALUES (?)");
		$stmt->bind_param("s", $departamento);
		$stmt->execute();
		echo "Registro correcto";
		$stmt->close();
}
?>


<!doctype html>
<html>
    
<head>
    
  
    <link rel="stylesheet" href="CSS/styles.css"> 
      
    <title>Insertar</title>
    <link rel="shortcut icon" href="imagenes/favicon.ico" />
</head>
<body>
     <form form name="insertar" action="insertardep.php" method="post" align="center">
	 <fieldset>
            <legend>Insertar:</legend>
  Departamento:<br>
  <input type="text" name="departamento"><br>
   <br>
		<input class="botones" type="submit" name="insertar" value="Insertar" title="Insertar">
		</fieldset>
</form> 
    

 <?php
  $conn->close();           
?>   
<?php
include ("footer.html")
?>  
</body>
</html>