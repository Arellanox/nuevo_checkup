

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

     $('#TablaListaPrecios tbody').on('click', 'tr', function () {
        // alert( 'Clicked row id '+idrow );
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            array_paciente = null;
        } else {
            tablaUsuarios.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            array_paciente = tablaPrecios.row( this ).data();

        }
    });

    $("#btn-perfil").click(function(){
      alert()
    })


  });
}
