<!doctype html>
 <?php
include ("menu.php");
require_once ("conexion.php");

if(isset($_POST['corregir']))
{
    $departamento = $_POST["departamento"];
    $extension=$_POST["extension"];
	$nombre=$_POST["nombre"];
	
    // search in all table columns
    // using concat mysql function
	if (!$nombre || !$departamento || !$extension)
{
   echo "<script>alert('Tienes que rellenar todos los campos');
   window.location.href='corregir.php';
   </script>";
    
}else{
	$stmt = $conn->prepare("INSERT INTO temporal (nombre,extension,departamento) VALUES (?, ?, ?)");
	$stmt->bind_param("sis", $nombre, $extension, $departamento);
	if ($stmt->execute()) { 
			echo "<script>alert('La solicitud se ha registrado correctamente');
					window.location.href='index.php';
				</script>";
		} else {
			echo "Error al en el registro";
		}
		$stmt->close();  
    
}   
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/w3.css">
	<link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
	

      
    <title>Directorio del Ayuntamiento de Santa Lucia</title>
</head>	
<body>
<div class="w3-container w3-red">
  <p><h4>En esta página podras modificar tus datos del directorio minicipal si son incorrectos, también si tus datos no están en el directorio, los podrás añadir.</h4></p>
</div>

<form name="corregir" action="corregir.php" method="post" align="center" class="w3-container w3-card-4 w3-light-grey w3-text-teal w3-margin" style="width:50%">
        <h3 class="w3-center w3-container w3-teal">DATOS INCORRECTOS</h3>
		        <h4 class="w3-center">Rellena los datos como deberían aparecer en el directorio</h4>

<div class="w3-row w3-section">
			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
			<div class="w3-rest">
			<input class="w3-input w3-animate-input" type="text" name="nombre" placeholder="Nombre" style="width:30%">
			</div>
</div>
		
        
		
<div class="w3-row w3-section">
	<div class="w3-col" style="width:50px"><i class="w3-xlarge fa fa-users"></i></div>
    <div class="w3-rest">
    <input class="w3-input w3-animate-input" type="text" name="departamento" placeholder="Departamento" style="width:30%">
	</div>
</div>
		
		<div class="w3-row w3-section">
			<div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
			<div class="w3-rest">
			<input class="w3-input" type="number" name="extension" maxlength="4" size="4" placeholder="Extensión" style="width:30%">
			</div>
		</div>
      
      
        <div class="w3-row w3-section">  
		
       <button class="w3-button w3-section w3-teal w3-ripple w3-padding w3-large fa fa-file" type="submit" name="corregir" value="Corregir" title="Corregir"> Corregir </button>
	   <button class="w3-button w3-section w3-teal w3-ripple w3-padding w3-large fa fa-refresh" type="reset" value="Reset"> Limpiar</button>
       </div>
        
</form>



</body>
</html>