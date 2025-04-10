    <!-- //* FRONTEND DE EL BOTON CON LA PAGINA DE BUSCAR-->

    <!doctype html>
 <?php
include ("menu.php")
?>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/w3.css">
	<link rel="stylesheet" href="CSS/font-awesome/css/font-awesome.min.css">
	

      
    <title>Directorio del Ateneo Santa Lucía de Tirajana </title>
    
</head>
<body>

        <!--Campo de busqueda-->
    <!--Campo de busqueda-->
    <!--Campo de busqueda-->
    <!--Campo de busqueda-->

<form name="mostarbuscar" action="mostarbuscar.php" method="get" class="w3-container w3-card-4 w3-light-grey w3-text-teal w3-margin" style="width:50%">
<h2 class="w3-center" class="w3-container w3-teal">Buscar</h2>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
    <div class="w3-rest">
  
    <input class="w3-input w3-animate-input" type="text" name="nombre_apellidos" placeholder="Nombre" style="width:30%">
	</div>
</div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xlarge fa fa-users"></i></div>
    <div class="w3-rest">
     <input class="w3-input w3-animate-input" type="text" name="area" placeholder="Area" style="width:30%">
	 </div>
</div>
<div class="w3-row w3-section">
  <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-phone"></i></div>
    <div class="w3-rest">
    <input class="w3-input" type="text" name="extension" maxlength="4" size="4" placeholder="Extensión" style="width:30%">
	</div>
</div>

   
      <label class="w3-text-teal fa fa-sort-alpha-asc"><b> Ordenar por:</b></label> 
      <input class="w3-radio" type="radio" name="ord" value="empleados.nombre_apellidos" checked> Nombre
      <input class="w3-radio" type="radio" name="ord" value="area.nombre_area"> Area
      <input class="w3-radio" type="radio" name="ord" value="empleados.extension"> Extensión
          
		  <div class="w3-row w3-section">
    
	<button class="w3-button w3-section w3-teal w3-ripple w3-padding w3-large fa fa-filter" type="submit" name="Buscar" value="Buscar" title="Buscar"> Buscar </button>
	<button class="w3-button w3-section w3-teal w3-ripple w3-padding w3-large fa fa-refresh" type="reset" value="Reset"> Limpiar</button>
    
	</div>
 
</form>

</body>
</html>