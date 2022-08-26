
// obtenerContenido o cambiar
obtenerContenido("registro.php");
function obtenerContenido(tabla){
  $.post("contenido/"+tabla, function(html){
     $("#body-js").html(html);

     // Datatable
     var tablaPrincipal = $('#TablaEjemplo').DataTable({
       language: {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       },
       lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
       columnDefs: [
         { "width": "5px", "targets": 0 },
       ]
     })
  });
}
