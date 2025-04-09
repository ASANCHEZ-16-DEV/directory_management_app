<?php
include_once("../conexioninsertar.php")
?>



<html>
<body>

<script src="src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="table_edit.js"></script>
<script type="text/javascript" src="jquery.tabledit.js"></script>
<script type="text/javascript" src="jquery.tabledit.min.js"></script>

<div class="container home">
<h2>Ejemplo tabla editable con PHP, MySQL y jQuery</h2>      
    <table id="data_table" class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Extension</th>
                <th>departamento</th>   
                
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql_query = "SELECT id, nombre, extension, departamento FROM temporal";
            $resultset = mysqli_query($conn, $sql_query) or die("error base de datos:". mysqli_error($conn));
            while( $libro = mysqli_fetch_assoc($resultset) ) {
            ?>
               <tr id="<?php echo $libro ['id']; ?>">
               <td><?php echo $libro ['id']; ?></td>
               <td><?php echo $libro ['nombre']; ?></td>
               <td><?php echo $libro ['extension']; ?></td>
               <td><?php echo $libro ['departamento']; ?></td>   
               </tr>
            <?php } ?>
        </tbody>
    </table>   
</div>
 
</body>
</html>

