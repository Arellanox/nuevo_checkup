obtenerContenidoPrecios("listaprecios.php");
function obtenerContenidoPrecios(tabla){
  obtenerTitulo("ListaPrecios"); //Aqui mandar el nombre de la area
  $.post("contenido/"+tabla, function(html){
    var idrow;
    $("#body-js").html(html);

     var tablaUsuarios = $('#TablaListaPrecios').DataTable({
       language: {
         url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
       },
       lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
       columnDefs: [
         { "width": "5px", "targets": 0 },
       ],
     })

    $("#btn-perfil").click(function(){
      alert()
    })

  });
}
