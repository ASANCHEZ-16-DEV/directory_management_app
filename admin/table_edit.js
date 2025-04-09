JavaScript
$(document).ready(function(){
    $('#data_table').Tabledit({
        deleteButton: false,
        editButton: false,          
        columns: {
          identifier: [0, 'id'],                    
          editable: [[1, 'nombre'], [2, 'extension'], [3, 'departamento']]
        },
        hideIdentifier: true,
        url: 'editarCelda.php'      
    });
});